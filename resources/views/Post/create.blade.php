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
                <h1 class="font-weight-bold text-center text-danger">CREAR PUBLICACION</h1>

                <div class="row">
                    <div class="col-md-12">

                        {!! Form::open(['route'=>'posts.store', 'method'=>'POST','files' => true]) !!}
                        <div class="card-body ">
                            @include('Post.form.form')

                            <div class="form-group">
                                <label>Unidad Educativa</label>
                                <select class="form-control select" name="instituto" style="width: 99%;">
                                    <option selected disabled>Elija una Unidad educativa...</option>
                                    @foreach($institutos as $instituto)
                                    <option value="{{$instituto->id}}">{{$instituto->nombre}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <a href="{{route('posts.index')}}" class="btn btn-primary">Atras</a>
                        <input type="submit" class="btn btn-dark " value="Guardar">
                        {!!Form::close()!!}
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
<script type="text/javascript" src="{{asset('plugins/customfileinputs/js/custom-file-input.js')}}"></script>

{!! Html::script('vendor/ckeditor/ckeditor.js') !!}
<script>
    CKEDITOR.replace('body');
       $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
</script>
@stop