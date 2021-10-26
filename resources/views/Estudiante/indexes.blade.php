@extends('layouts.nav')

@section('title', 'Inicio | SmartMoodle')



@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> Parece que hay porblemas o Malas decisiones <br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<section class="content">
    <div class="container">
        <h1 class="font-weight-light" style="color:red;"> @isset ( auth()->user()->instituto->nombre)
            {{ auth()->user()->instituto->nombre}}
            <h2 class="font-weight-light" style="color:blue;"> {{ auth()->user()->name, }}
                {{ auth()->user()->apellido, }}
                @endisset
        </h1>

        @isset (auth()->user()->curso->nombre)
        <h2 class="font-weight-light"> <strong> PÁGINA PRINCIPAL|{{auth()->user()->curso->nombre}} </strong>
        </h2>
        @endisset
    </div>
</section>
@foreach($p as $key => $post)
<div class="container-fluid gedf-wrapper">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6 gedf-main">


            <!--- \\\\\\\Post-->
            <div class="card gedf-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="ml-2">
                                <div class="h5 m-0">{{$post->user->name}} {{$post->user->apellido}}
                                
                                </div>
                                <div class="h7 text-muted"></div>
                            </div>
                        </div>
                        <div>
                            @if($post->user_id == Auth::id())
                            <div class="dropdown">
                                <button class="btn btn-link-dark dropdown-toggle" type="button" id="gedf-drop1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                    {!! Form::open(['route'=>['deletepost',$post->id], 'method'=>'DELETE']) !!}
                                    <button class="dropdown-item" title="Eliminar">
                                        Eliminar
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>Publicado el
                        {{$post->updated_at->format('d/m/y')}}</div>

                    <h5 class="card-title">{{$post->nombre}}</h5>


                    <p class="card-text">
                        @isset($post->image->url)
                        <img class="img-fluid rounded" src="{{$post->image->url}}" width="850" height="800" alt="">
                        @endisset
                    <div>
                        <p class="lead">{{$post->abstract}}</p>
                    </div>
                    <p class="card-text">
                        {!!htmlspecialchars_decode($post->body)!!}
                    </p>
                    </p>
                </div>
                <div class="card-footer">

                    <a class="card-link" data-toggle="collapse" href="#collapseExample{{$key}}" role="button"
                        aria-expanded="false" aria-controls="collapseExample{{$key}}">
                        Comentarios
                    </a>
                </div>
                <div class="collapse" id="collapseExample{{$key}}">
                    <div class="card-body">
                        {!! Form::open(['route'=>'comment.add', 'method'=>'POST']) !!}
                        <form class="form-horizontal">
                            @csrf
                            <div class="input-group input-group-sm mb-0">
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <textarea class="form-control" name="body" rows="2"></textarea>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-dark">Comentar</button>
                                </div>
                            </div>

                        </form>
                        {!! Form::close() !!}
                        @include('Post._replies',['comments'=>$post->comments, 'post_id'=>$post->id])
                    </div>

                </div>
            </div>
            <!-- Post /////-->
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>
@endforeach

<div class="row justify-content-center">
 {{ $p->links() }}
</div>







@stop
@section('css')
@stop
@section('js')

@stop