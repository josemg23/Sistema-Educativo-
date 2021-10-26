@extends('layouts.nav')

@section('title', 'Contenido | SmartMoodle')

@section('content')

@section('css')
<style type="text/css">
    :root {
  /* Not my favorite that line-height has to be united, but needed */
  --lh: 1.4rem;
}
.truncate-overflow {
  --max-lines: 3;
  position: relative;
  max-height: calc(var(--lh) * var(--max-lines));
  overflow: hidden;
  padding-right: 1rem; /* space for ellipsis */
}
.truncate-overflow::before {
  position: absolute;
  /*content: "...";*/
  /* tempting... but shows when lines == content */
  /* top: calc(var(--lh) * (var(--max-lines) - 1)); */
  
  /*
  inset-block-end: 0;
  inset-inline-end: 0;
  */
  bottom: 0;
  right: 0;
}
.truncate-overflow::after {
  content: "";
  position: absolute;
  /*
  inset-inline-end: 0;
  */
  right: 0;
  /* missing bottom on purpose*/
  width: 1rem;
  height: 1rem;
  background: white;
}
</style>
@endsection

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
                <a class="btn btn-info float-right" href="{{route('admin.create')}}"><i class="fas fa-plus"></i>Crear
                        Talleres</a>
                <h1 class="font-weight-light"> Unidad</h1>
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
                                        value="{{$contenido->nombre}}" placeholder="Añadir nombre del contenido"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion"
                                        value="{{$contenido->descripcion}}" placeholder="Añadir una Descripción"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label> Materia</label>
                                    <select class="form-control select" name="materia" style="width: 99%;" disabled>
                                        @foreach($materiacontenido as $materiac)
                                        <option selected disabled value="{{ $materiac->id }}">{{ $materiac->nombre }}
                                        </option>
                                        @endforeach
                                      
                                    </select>
                                </div>

                          
                                <!-- fin de la prueba imagen en laravel  -->

                                <div class="form-group">
                                    <label for="nombre">Estado </label>
                                    <br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                            value="on" @if($contenido['estado']=="on" ) checked
                                            @elseif(old('estado')=="on" ) checked @endif disabled>
                                        <label class="custom-control-label" for="estadoon">Activo</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                            value="off" @if($contenido['estado']=="off" ) checked
                                            @elseif(old('estado')=="off" ) checked @endif disabled>
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
                                aria-controls="nav-home" aria-selected="true">Talleres</a>
                                <a class="nav-link " id="nav-documento-tab" data-toggle="tab" href="#nav-documento" role="tab"
                                aria-controls="nav-documento" aria-selected="true">Documentos</a>

                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <br>

                            <!-- Inicio de Talleres -->
                            <div class="card card-gray-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Talleres</h3>
                                </div>
                                <div class="card-body">
                                @livewire('unidades',[$contenido])

                                </div>
                            </div>
                            <!-- fin de talleres -->
                        </div>
                        <div class="tab-pane fade show" id="nav-documento" role="tabpanel"
                            aria-labelledby="nav-documento-tab">
                                <br>
                        <!-- Inicio de documentacion -->
                        <div class="card card-gray-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Documentación</h3>
                                </div>
                                <div class="card-body">
                                <table id="myTable3" class="table table-hover">
                        <thead>
                            <tr>
                                <th width="100" scope="col">Unidad</th>
                                <th scope="col">Nombre del Documento</th>
                                <th width="300" scope="col">Descripción</th>
                                <th scope="col">Acción</th>
                                <th width="125" scope="col" coldspan="1">Ver Documento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doc as $c)
                            <tr>
                                <td> {{$c->contenido->nombre}}</td>
                                <td> {{$c->nombre}}</td>
                                <td > {{$c->descripcion}}</td>
                                <td>@if($c['accion']== '1')
                                    <span class="badge-success badge">Descargable</span>
                                    @else
                                    <span v-else class="badge-info badge">No Descargable</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($c['accion']== '1')
                                    <!-- descarganle -->
                                    <a class="btn btn-dark btn" href="{{route('Contenido3.alumno', $c->id)}}"><i
                                    class="fas fa-file-pdf"></i></a>
                                    @else
                                    <!-- no descarganle -->
                                    <a class="btn btn-dark btn" href="{{route('Contenido.alumno', $c->id)}}"><i
                                    class="fas fa-file-pdf"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                                </div> 
                          </div>
                        <!-- fin de documentacion -->
                            </div>
                    </div>
                </div>

            </div>
            <a href="{{route('contenidos.index')}}" class="btn btn-primary">Atras</a>
        </div>
    </div>
</section>






@stop

@section ('css')
@stop

@section('js')


<script type="text/javascript">

    Livewire.on('postAdded', function () {
         toastr.info('Taller Eliminado Correctamente', "Smarmoddle", {
                    "timeOut": "3000"

                });
    })
        Livewire.on('Estado', function () {
         toastr.info('Estado cambiado correctamente', "Smarmoddle", {
                    "timeOut": "3000"

                });
    })
{{-- let talleres = @json($tallers); --}}
const taller = new Vue({
    el: "#dataTable",
    data: {
        // tallers: talleres
    },
    mounted: function() {


    },
    methods: {
        Cambiar: function(id) {
            let taller = id;
            var _this = this;
            var url = '/sistema/admin/cambiarestado';
            axios.post(url, {
                id: taller,
            }).then(response => {
                toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                });
                 // Livewire.emit('render')
            }).catch(function(error) {

            });

        },
        Eliminar: function(id) {
            let taller = id;
            var _this = this;
            var url = '/sistema/delete';
            axios.post(url, {
                id: taller,
            }).then(response => {
                toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"

                });
                location.reload();
            }).catch(function(error) {

            });

        }
    }


});
</script>
@stop