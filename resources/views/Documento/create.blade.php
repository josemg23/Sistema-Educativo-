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
<section class="content" id="contenidos">
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="font-weight-light">Añadir un Documento</h1>
                <div class="row">
                    <div class="col-md-10">
                        <form method="POST" action="{{route('documentos.index')}} " enctype="multipart/form-data">
                            @csrf
                            <div class=" card-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                    value="{{ old('nombre') }}" placeholder="Añadir nombre del contenido">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion"
                                    value="{{ old('descripcion') }}" placeholder="Añadir una Descripción">
                                </div>
                                <div class="form-group">
                                    <label>Instituto</label>
                                    <select class="form-control select" v-model="instituto"  name="instituto" style="width: 99%;" @change="getContenidos">
                                        <option selected disabled value="">Elija una Unidad educativa...</option>
                                        @foreach($institutos as $instituto)
                                        <option value="{{$instituto->id}}">{{$instituto->nombre}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccionar la Unidad</label>
                                    <select class="form-control select2" name="unidad" style="width: 99%;">
                                        <option selected disabled value="">Elija la Unidad...</option>
                                        <option v-for="contenido in contenidos" :value="contenido.id">@{{contenido.nombre_mate }} - @{{contenido.nombre }}</option>
                                    </select>
                                </div>
                                
                                <!-- subir imagen en laravel prueba 1 -->
                                <div class="form-group">
                                    <label for="archivo">Añadir Documento(s)</label>
                                    <input type="file" class="form-control-file" name="archivo" id="archivo">
                                    {!! $errors->first('documento','<span style="color:red">:message</span>')!!}
                                    <small class="form-text text-muted">
                                    Limite de 50MB por Documento
                                    </small>
                                </div>
                                <!-- fin de la prueba imagen en laravel  -->
                            </div>
                            <div class="form-group">
                                <label for="cuenta">Documento Descargable</label>
                                <input type="checkbox" value="1" name="accion" class="custom-checkbox">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Estado </label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                    value="on" @if(old('estado')=="on" ) checked @endif
                                    @if(old('estado')===null) checked @endif>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                    value="off" @if(old('estado')=="off" ) checked @endif>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                            </div>
                            <a href="{{route('documentos.index')}}" class="btn btn-primary">Atras</a>
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
<script type="text/javascript">
var random = new Vue({
    el: "#contenidos",
    data: {
        contenidos:[],
        instituto:'',
    },

    methods: {
  
        getContenidos(){
            let set = this;
            set.contenidos = [];
            axios.post('/sistema/getcontenidos', {
                id: set.instituto
            }).then(response => {
                set.contenidos = response.data;
                console.log(set.contenidos);
            }).catch(e => {
                console.log(e);
            });
        }



    }


})
</script>

<script>
$(function() {
//Initialize Select2 Elements
$(".select2").select2({
});
})
</script>
@stop