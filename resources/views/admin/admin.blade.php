@extends('layouts.nav')
@section('class', 'no-js')
@section('titulo', 'Creador de plantillas')
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/customfileinputs/css/component.css') }}">
<link rel="stylesheet" href="{{asset('css/bootstrap-tagsinput.css')}}">
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
@endsection
@section('content')
<h1 class="text-center mt-5 text-danger display-4 font-weight-bold">Administrador de Talleres</h1>
<div id="tallerlist">
    <div class="container">
        <a class="btn btn-info " href="{{route('materias.index')}}"> <i class="fas fa-eye"> </i> Materias</a>
        <a class="btn btn-info " href="{{route('contenidos.index')}}"> <i class="fas fa-eye"> </i> Unidad</a>
        <div class="row justify-content-center mt-3">
            <div class="col-md-12 col-sm-12" >
                <div class="card text-center">
                    <div class="card-header bg-primary">
                        <h1 class="font-weight-bold">Elija la plantilla a utilizar</h1>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Seleccione:</h5>
                        <select class="custom-select" v-model="numbreTaller" name="taller" id="">
                            <option disabled value="">SELECCIONE UNA PLANTILLA</option>
                            @foreach ($plantillas = App\Plantilla::where('plantilla', 'si')->whereNotIn('id',[37])->get() as $plantilla)
                            <option class="text-uppercase" value="#taller{{ $plantilla->id }}">{{ $plantilla->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-footer text-muted">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                        :data-target="numbreTaller">
                        Cargar Plantilla
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12" >
                <div class="accordion" id="accordionExample">
                    <div class="card text-center">
                        <div class="card-header bg-danger row">
                            <h2 class="mb-0 font-weight-bold col-11">
                                       Plantilla Preconfigurada
                            </h2>
                            <button class="btn btn-block text-left font-weight-bold text-light col-1 " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-sort-down"></i>
                            </button>

                            {{-- <h1 class="font-weight-bold"></h1> --}}
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <form action="{{ route('admin.tallerprecon') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Enunciado:</label>
                                                {{-- <input required="" type="hidden" value="49" name="id_plantilla"> --}}
                                                <textarea required="" name="enunciado" class="form-control" rows="5"></textarea>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label for="recipient-name" class="col-form-label">Institucion:</label>
                                                    <select name="contenido_id" v-model="instituto" class="custom-select select2" @change="onMateria()">
                                                        <option v-if="materias.length == 0" selected disabled="">@{{ instituto }}</option>
                                                        @foreach ($institutos = App\Instituto::get() as $instituto)
                                                        <option value="{{ $instituto->id }}">{{ $instituto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="recipient-name" class="col-form-label">Materia:</label>
                                                    <select name="contenido_id" v-model="materia" class="custom-select" @change="onContenido()">
                                                        <option v-if="contenido.length == 0" disabled>@{{ materia }}</option>
                                                        <option v-for="mate in materias" :value="mate.id">@{{mate.nombre}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="recipient-name" class="col-form-label">Unidad:</label>
                                                    <select name="contenido_id" class="custom-select">
                                                        
                                                        <option v-for="conte in contenido" :value="conte.id">@{{conte.nombre}}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="recipient-name" class="col-form-label">Plantilla Preconfigurada:</label>
                                                    <select class="custom-select" name="id_plantilla" id="">
                                                        <option disabled selected="" value="">SELECCIONE UNA PLANTILLA</option>
                                                        @foreach ($plantillas = App\Plantilla::where('plantilla', 'no')->get() as $plantilla)
                                                        <option class="text-uppercase" value="{{ $plantilla->id }}">{{ $plantilla->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row justify-content-center">
                                                <input type="submit" value="Crear Taller" class="btn p-2 mt-3 btn-danger">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- <button type="button" class="btn btn-outline-primary " data-toggle="modal"
                                data-target="#tallerprecon">
                                Selecionar Plantilla
                                </button> --}}
                            </div>
                        </div>
                   {{--      <div class="card-footer text-muted">
                            
                        </div> --}}
                    </div>
                </div>
            </div>
            {{--        <div class="col-md-6">
                <form action="{{ route('admin.plantilla') }}" method="POST">
                    @csrf
                    <div class="card text-center">
                        <div class="card-header bg-danger">
                            <h1>Crear plantilla</h1>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Completa el formulario para registrar una nueva plantilla</h3>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Nombre del taller</label>
                                <input type="hidden" value="si" name="plantilla">
                                <input class="form-control" name="nombre"></input>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Descripcion</label>
                                <textarea class="form-control" name="descripcion" required=""></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <input type="submit" value="Crear Plantilla" class="btn btn-outline-danger">
                        </div>
                    </div>
                </form>
            </div> --}}
        </div>
        <div class="row justify-content-start">
            <div class="col-3">
                <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-outline-danger">Atras</a>
            </div>
        </div>
    </div>
</div>
<div id="ejercicios">
    @include('layouts.modal')
</div>
@section('js')
{{-- <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admintalleres.js') }}"></script>
<script type="text/javascript" src="{{asset('plugins/customfileinputs/js/custom-file-input.js')}}"></script>
<div id="js">
    <script async = true src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
</div>
<script>
$(function() {
//Initialize Select2 Elements
$('.select3').select2({
})
});
</script>
@endsection
@endsection