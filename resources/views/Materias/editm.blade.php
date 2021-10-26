@extends('layouts.nav')

@section('title', 'Editar Materias')


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
                <h1 class="font-weight-light">Editar Materias</h1>
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" action="{{route('materias.update', $materias->id)}} ">
                            @method('PUT')
                            @csrf
                            <div class=" card-body">
                                <div class="form-group">
                                    <label>Unidad Educativa</label>
                                    <select class="form-control select" name="instituto" style="width: 99%;">
                                        @foreach($institutomate as $instumate)
                                        <option selected disabled value="{{ $instumate->id }}">
                                            {{ $instumate->nombre }}
                                        </option>
                                        @endforeach
                                        @foreach($institutos as $instituto)
                                        <option value="{{$instituto->id}}">{{$instituto->nombre}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                        value="{{$materias->nombre}}" placeholder="Edición de Materia">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug Materia</label>
                                    <input type="text" class="form-control" name="slug" tag="slug" id="slug"
                                        placeholder="Slug Materia" value="{{$materias->slug}}">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion"
                                        value="{{$materias->descripcion}}" placeholder="Descripción">
                                </div>
                                <label for="nombre">Estado</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" @if($materias['estado']=="on" ) checked @elseif(old('estado')=="on" )
                                        checked @endif>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                        value="off" @if($materias['estado']=="off" ) checked
                                        @elseif(old('estado')=="off" ) checked @endif>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                                <br><br><br>
                                <a href="{{route('materias.index')}}" class="btn btn-primary">Atras</a>
                                <input type="submit" class="btn btn-dark " value="Guardar">

                            </div>
                        </form>
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
    $('#nombre').keyup(function(e) {
        var str = $('#nombre').val();
        str = str.replace(/\W+(?!$)/g, '-').toLowerCase(); // remplazamos el estdo de dashe
        $('#slug').val(str);
        $('slug').attr('placeholder', str);
    });

});
</script>

<script>
$(function() {
    //Initialize Select2 Elements
    $(".select2").select2({

    });

})
</script>
@stop