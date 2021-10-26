@extends('layouts.nav')

@section('title', 'Edicion Curso')

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
                <h1 class="font-weight-light">Editar Curso</h1>
                <div class="row">
                    <div class="col-md-10">

                        <form method="POST" action="{{route('cursos.update', $curso->id)}} ">
                            @method('PUT')
                            @csrf
                            <div class=" card-body">
                          
                                <div class="form-group">
                                    <label for="nombre">Curso</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                        value="{{$curso->nombre}}" placeholder="Edición del Curso">
                                </div>                                          
                                <br>
                                <label>Estado del Curso</label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" @if($curso['estado']=="on" ) checked @elseif(old('estado')=="on" )
                                        checked @endif>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                        value="off" @if($curso['estado']=="off" ) checked @elseif(old('estado')=="off" )
                                        checked @endif>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                                <br><br><br>
                               
                                <a href="{{url()->previous()}}" class="btn btn-primary">Regesar</a>
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