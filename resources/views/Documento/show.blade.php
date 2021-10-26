@extends('layouts.nav')

@section('title', 'Documentación | SmartMoodle')

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
                <h1 class="font-weight-light"> Documentación</h1>
                <div class="row">
                    <div class="col-md-10">

                        <form method="POST" action="{{route('documentos.update', $documento->id)}} "
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class=" card-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                        value="{{$documento->nombre}}" placeholder="Añadir nombre del contenido" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion"
                                        value="{{$documento->descripcion}}" placeholder="Añadir una Descripción" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Actualizar la Unidad</label>
                                    <select class="form-control select" name="unidad" style="width: 99%;" disabled="">
                                        @foreach($cdoc as $cd)     
                                        <option selected disabled value="{{ $cd->id }}">{{$cd->materia->nombre}}-{{ $cd->nombre }}
                                        </option>          
                                        @endforeach
                                      
                                    </select>
                                </div>

                                <!-- subir imagen en laravel prueba 1 -->
                                <div class="form-group">
                                    <label for="documentod">

                                        Vizualizar Documento
                                        <br>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                                            data-target="#modalYT">{{ $documento['nombre']}}</button>
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
                                <input type="checkbox" value="1" @if($documento['accion']=="1" ) checked
                                    @else($documento['accion']=="0" ) @endif name="accion" class="custom-checkbox" disabled>
                            </div>

 
                            <!-- fin de la prueba imagen en laravel  -->

                            <div class="form-group">
                                <label for="nombre">Estado </label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" @if($documento['estado']=="on" ) checked @elseif(old('estado')=="on"
                                        ) checked @endif disabled>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                        value="off" @if($documento['estado']=="off" ) checked
                                        @elseif(old('estado')=="off" ) checked @endif disabled>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                                <br><br><br>
                                <a href="{{route('documentos.index')}}" class="btn btn-primary">Atras</a>
                              
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>


<!--Modal: Name-->
<div class="modal fade" id="modalYT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <!--Content-->
        <div class="modal-content">

            <!--Body-->
            <div class="modal-body mb-0 p-0">

                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                    <iframe class="embed-responsive-item" width="1000" height="1000" src="{{$documento->archivo->url}}"
                        allowfullscreen></iframe>
                </div>

            </div>

            <div class="modal-footer justify-content-center">
                <span class="mr-4">{{ $documento['nombre']}}</span>

                <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4"
                    data-dismiss="modal">Close</button>

            </div>

        </div>
        <!--/.Content-->

    </div>
</div>
<!--Modal: Name-->



@stop

@section('css')

@stop

@section('js')

@stop