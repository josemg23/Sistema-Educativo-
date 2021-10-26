@extends('layouts.nav')

@section('title', ' Materias')


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
                <h1 class="font-weight-light"> Materias</h1>
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" action="{{route('materias.update', $materia->id)}} ">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Instituto</label>
                                    <select class="form-control select" name="instituto" style="width: 99%;" disabled>
                                        @foreach($institutomate as $instumate)
                                        <option selected disabled value="{{ $instumate->id }}">
                                            {{ $instumate->nombre }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Materia</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                        value="{{$materia->nombre}}" placeholder="Edición de Materia" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Descripción</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                        value="{{$materia->descripcion}}" placeholder="Descripción" readonly>
                                </div>
                                <label for="nombre">Estado</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" @if($materia['estado']=="on" ) checked @elseif(old('estado')=="on" )
                                        checked @endif disabled>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                        value="off" @if($materia['estado']=="off" ) checked @elseif(old('estado')=="off"
                                        ) checked @endif disabled>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                                aria-controls="nav-home" aria-selected="true">Unidades</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <br>

                            <div class="card card-gray-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Unidades</h3>
                                </div>
                                <div class="card-body">
                                    <table id="dataTable" class="table table-hover-sm">

                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Materia</th>
                                                <th scope="col">Unidad</th>
                                                <th scope="col">Descripción </th>
                                                <th scope="col">Estado</th>
                                              {{--   <th scope="col">Acción</th>
                                                <th scope="col">Vista Unidad</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($contenidos as $contenido)
                                            <tr>
                                                <th scope="row">{{$contenido['id']}}</th>
                                                <td>{{$contenido->materia->nombre}}</td>
                                                <td>{{$contenido['nombre']}}</td>
                                                <td>{{$contenido['descripcion']}}</td>
                                                <td>{{$contenido['estado']}}</td>
                                           {{--      <td>@if($contenido['accion']== '1')
                                                    <span class="badge-success badge">Descargable</span>
                                                    @else
                                                    <span v-else class="badge-info badge">No Descargable</span>
                                                    @endif
                                                </td>
                                        
                                              <td>
                                                    @if($contenido['accion']== '1')
                                                    
                                                    <a class="btn btn-success btn"
                                                        href="{{route('Unidad2.contenido', $contenido->id)}}"><i
                                                            class="fas fa-eye"></i></a>

                                                    @else
                                                    
                                                    <a class="btn btn-info btn"
                                                        href="{{route('Unidad.contenido', $contenido->id)}}"><i
                                                            class="fas fa-eye"></i></a>
                                                    @endif
                                                </td> --}} 
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- fin de Contenidos -->
                        </div>

                    </div>
                </div>
                <a href="{{route('materias.index')}}" class="btn btn-primary">Atras</a>
            </div>
        </div>
</section>







@stop

@section('css')

@stop

@section('js')
<script>
console.log('Hi!');
</script>
@stop