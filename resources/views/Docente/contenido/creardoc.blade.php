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


<section class="content" id="dd">
    <div class="container">
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

        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="font-weight-light">Subir Archivo</h1>
                <div class="row">
                    <div class="col-md-10">
                        <form method="POST" action="{{route('documentacion.docentestore')}} "
                            enctype="multipart/form-data">
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
                                    <label for="materia">Seleccionar Materia</label>
                                    <select class="form-control select2" name="materia" style="width: 99%;"
                                         @change="onMateria()">
                                        <option selected disabled>Elija la Materia...</option>
                                        @foreach($materias as $a)
                                        <option value="{{$a->materia_id}}">
                                            {{$a->nombre_curso}}-{{$a->nombre_materia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione el Paralelos</label>
                                    <select class="paralelos form-control" name="paralelos"
                                        data-placeholder="Selecciona los paralelo" style="width: 100%;">
                                        <option v-for="paralelo in paralelos" :value="paralelo.id">@{{ paralelo.nombre}}
                                        </option>
                                    </select>
                                </div>
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

                            <a href="{{route('documentacion.docente')}}" class="btn btn-primary">Atras</a>
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
const inst = new Vue({
    el: '#dd',
    data: {
        materia: '',
        paralelos: [],
    },

    methods: {
        onMateria(id) {

            var set = this;
            set.paralelos = [];
            axios.post('/sistema/buscarparalelo', {
                id: id,
            }).then(response => {
                set.paralelos = response.data;
                console.log(set.paralelos);
            }).catch(e => {
                console.log(e);
            });
        }
    },

});
</script>

<script>
$(function() {
    var $eventSelect = $(".select2");

    $eventSelect.select2();
    $eventSelect.on("select2:select", function(e) {
        var select_val = $(e.currentTarget).val();

        inst.onMateria(select_val);
    });




})
</script>

@stop