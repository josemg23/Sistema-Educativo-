@extends('layouts.nav')

@section('title', 'Post | SmartMoodle')



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
                <h1 class="font-weight-bold text-center text-danger">Crear de Publicacion</h1>

                <div class="row">
                    <div class="col-md-12">

                        {!! Form::open(['route'=>'storepost', 'method'=>'POST','files' => true]) !!}
                        <div class="card-body ">
                            @include('Post.form.form')
                        </div>
                     
                        <a href="{{ url('/sistema/homees') }}" class="btn btn-primary">Atras</a>
                        <input type="submit" class="btn btn-dark " value="Guardar">
                        {!! Form::close() !!}
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