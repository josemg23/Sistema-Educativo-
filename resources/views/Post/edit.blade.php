@extends('layouts.nav')

@section('title', 'Unidad Educativa')

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
        <div class="card border-0 shadow my-5">

            <div class="card-body p-5">
                <h1 class="font-weight-light">Edicion de la Publicacion</h1>

                <div class="row">
                    <div class="col-md-10">

                        {!! Form::model($post, ['route'=>['posts.update',$post->id],'method'=>'PUT','files' => true])
                        !!}
                        <div class="card-body ">
                            @include('Post.form.form')
                            
                            <div class="form-group">
                                    <label>Instituto</label>
                                    <select class="form-control select" name="instituto" style="width: 99%;">
                                        @foreach($institutopost as $instuser)
                                        <option selected disabled value="{{ $instuser->id }}">
                                            {{ $instuser->nombre }}
                                        </option>
                                        @endforeach
                                        @foreach($institutos as $instituto)
                                        <option value="{{$instituto->id}}">{{$instituto->nombre}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="{{$post->image->url}}" alt="Card image">
                                <div class="card-img-overlay">
                                   
                                </div>
                            </div>

                        </div>

                      
                        <a href="{{route('posts.index')}}" class="btn btn-primary">Atras</a>
                        <input type="submit" class="btn btn-dark " value="Actualizar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@stop

@section('css')

@stop

@section('js')


<script>
CKEDITOR.replace('body');
</script>



@stop