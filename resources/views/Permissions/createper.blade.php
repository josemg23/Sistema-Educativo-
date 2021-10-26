@extends('layouts.nav')


@section('title', 'Crear Menú')



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
                <h1 class="font-weight-light">Crear Permiso de Acceso </h1>
                <div class="row">

                    <div class="col-md-8">

                        <form method="POST" action="{{route('permissions.index')}} ">
                            @csrf

                            <div class=" card-body">
                                <div class="form-group">
                                    <label for="namep"> Nombre del Menú</label>
                                    <input type="text" class="form-control" name="namep" id="namep" placeholder="Nombre"
                                        value="{{old('namep')}}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug del Menú</label>
                                    <input type="text" class="form-control" name="slug" tag="slug" id="slug"
                                        placeholder="Slug" value="{{old('slug')}}">
                                </div>
                                <div class="form-group">
                                    <label for="descripcionp">Descripcion</label>
                                    <input type="text" class="form-control" name="descripcionp" tag="descripcionp"
                                        id="descripcionp" placeholder="Descripcion" value="{{old('descripcionp')}}">
                                </div>

                                <label for="nombre">Estado </label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" @if(old('estado')=="on" ) checked @endif @if(old('estado')===null)
                                        checked @endif>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                        value="off" @if(old('estado')=="off" ) checked @endif>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                                <br>
                                <br>
                                <a href="{{route('permissions.index')}}"  class="btn btn-primary">Atras</a>
                                <input type="submit" class="btn btn-dark " value="Guardar">
                                
                             
                            </div>
                            
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
$(document).ready(function() {

    $('#namep').keyup(function(e) {
        var str = $('#namep').val();
        str = str.replace(/\W+(?!$)/g, '-').toLowerCase(); // remplazamos el estdo de dashe
        $('#slug').val(str);
        $('slug').attr('placeholder', str);
    });

});
</script>
@stop