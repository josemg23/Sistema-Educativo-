@extends('layouts.nav')

@section('title', 'Unidades Docente | SmartMoodle')




@section('title', 'Administracion - Docente')

@section('content')


<section class="content">
    <div class="container">


        <h1 class="font-weight-light" style="color:red;"> @isset ( auth()->user()->instituto->nombre)
            {{ auth()->user()->instituto->nombre}}
            @endisset</h1>

        <h2 class="font-weight-light">
            @foreach(auth()->user()->roles as $role)
            {{$role->name}} | {{ auth()->user()->name, }}
            {{ auth()->user()->apellido, }}
            @endforeach</h2>
    </div>
</section>



<section class="content">
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="font-weight-light"> Documentación Docente</h1>
                <div class="row">
                    <div class="col-md-10">

                        <form method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class=" card-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                        value="{{$archivodocente->nombre}}" placeholder="Añadir nombre del contenido"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion"
                                        value="{{$archivodocente->descripcion}}" placeholder="Añadir una Descripción"
                                        disabled>
                                </div>

                                <div class="form-group">
                                    <label> Materia</label>
                                    <select class="form-control select" name="materia" style="width: 99%;" disabled>
                                        <option value="{{$archivodocente->materia_id}}">
                                            {{$archivodocente->materia->nombre}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Paralelo</label>
                                    <select class="form-control select" name="materia" style="width: 99%;" disabled>
                                        <option value="{{$archivodocente->nivel_id}}">{{$archivodocente->nivel->nombre}}
                                        </option>
                                    </select>
                                </div>

                                <!-- subir imagen en laravel prueba 1 -->

                                <div class="form-group">
                                    <label for="documentod">

                                        Vizualizar Documento <a class="btn btn-dark btn"
                                            href="{{route('Documentover.docente', $archivodocente->id)}}"><i
                                                class="fas fa-eye"></i></a>
                                        <br>                                   
                                    </label>
                                </div>
                                <!-- fin de la prueba imagen en laravel  -->
                                <div class="form-group">
                                    <a href="{{route('documentacion.docente')}}" class="btn btn-primary">Atras</a>
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