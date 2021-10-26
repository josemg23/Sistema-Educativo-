@extends('layouts.nav')

@section('title', 'Contenido | SmartMoodle')

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
                <h1 class="font-weight-light">Editar una Unidad</h1>
                <div class="row">
                    <div class="col-md-10">

                        <form method="POST" action="{{route('contenidos.update', $contenido->id)}} "
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class=" card-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                        value="{{$contenido->nombre}}" placeholder="Añadir nombre del contenido">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion"
                                        value="{{$contenido->descripcion}}" placeholder="Añadir una Descripción">
                                </div>

                                <div class="form-group">
                                    <label>Editar Materia</label>
                                    <select class="form-control select" name="materia" style="width: 99%;">
                                        @foreach($materiacontenido as $materiac)
                                        <option selected disabled value="{{ $materiac->id }}">{{ $materiac->nombre }}
                                        </option>
                                        @endforeach
                                        @foreach($materias as $materia)
                                        <option value="{{$materia->id}}">{{$materia->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- subir imagen en laravel prueba 1 -->
                    {{--             <div class="form-group">
                                    <label for="documentod">

                                        Vizualizar Documento
                                        <br>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                                            data-target="#modalYT">{{ $contenido['nombre']}}</button>
                                        <input type="file" class="form-control-file" name="archivo" id="archivo">
                                        {!! $errors->first('documento','<span style="color:red">:message</span>')!!}

                                        <small class="form-text text-muted">
                                            Limite de 50MB por Documento
                                        </small>
                                    </label>

                                </div>

                            </div>
                            <div class="form-group">
                                <label for="cuenta">Documento Descargable</label>
                                <input type="checkbox" value="1" @if($contenido['accion']=="1" ) checked
                                    @else($contenido['accion']=="0" ) @endif name="accion" class="custom-checkbox">
                            </div>

 --}}
                            <!-- fin de la prueba imagen en laravel  -->

                            <div class="form-group">
                                <label for="nombre">Estado </label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" @if($contenido['estado']=="on" ) checked @elseif(old('estado')=="on"
                                        ) checked @endif>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                        value="off" @if($contenido['estado']=="off" ) checked
                                        @elseif(old('estado')=="off" ) checked @endif>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                                <br><br><br>
                                <a href="{{route('contenidos.index')}}" class="btn btn-primary">Atras</a>
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

@stop