@extends('layouts.nav')


@section('title', 'Editar Asignación')

@section('content')

<section class="content" id="asignacion">
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="font-weight-light">Editar Asignación de Alumno</h1>
                <div class="row">
                    <div class="col-md-10">
                        <form method="POST" action="{{route('distrimas.update', $distrima->id)}} ">
                            @method('PUT')
                            @csrf
                            <div class=" card-body">
                                <div class="form-group">
                                    <label>Unidad Educativa</label>
                                    <select class="form-control select" name="instituto" disabled style="width: 99%;">
                                        <option value="{{$instituto->id}}">{{$instituto->nombre}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Estudiante</label>
                                    <select class="form-control select" name="user" disabled style="width: 99%;">

                                        <option selected disabled value="{{ $user->id }}">
                                            {{ $user->name }}
                                        </option>


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Actualización de Asignacion</label>
                                    <select class="form-control select" name="asignacion" style="width: 99%;">
                                        <option selected value="{{$distribucion->id}}">{{$distribucion->curso->nombre}}
                                        </option>
                                        <option v-for="asig in newAsignacion" :value="asig.id">@{{asig.nombre}}
                                        </option>

                                    </select>
                                </div>
                                <div class="form-group">
                                        <label>Actualizar Paralelo</label>
                                        <select class="form-control select" name="paralelo" style="width: 99%;">
                                            @foreach($niveldis as $niveld)
                                            <option selected disabled value="{{ $niveld->id }}">
                                                {{ $niveld->nombre }}
                                            </option>
                                            @endforeach
                                            @foreach($nivels as $nivel)
                                            <option value="{{$nivel->id}}">{{$nivel->nombre}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                            </div>
                            <label for="nombre">Estado</label><br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="estadoon" name="estado" class="custom-control-input" value="on"
                                    @if($distrima['estado']=="on" ) checked @elseif(old('estado')=="on" ) checked
                                    @endif>
                                <label class="custom-control-label" for="estadoon">Activo</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                    value="off" @if($distrima['estado']=="off" ) checked @elseif(old('estado')=="off" )
                                    checked @endif>
                                <label class="custom-control-label" for="estadooff">No Activo</label>
                            </div>
                            <br><br><br>

                            <a href="{{url()->previous()}}" class="btn btn-primary">Regesar</a>
                            <input type="submit" class="btn btn-dark " value="Guardar">

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
$(function() {
    //Initialize Select2 Elements
    $(".select2").select2({

    });

})
</script>
<script>
var distribucion = @json($distribucion);
var distribucion_all = @json($distribucion_all);
var cursos = @json($cursos);
var curso = @json($curs);

const asignaciones = new Vue({

    el: '#asignacion',
    data: {
        distri: distribucion,
        all_distribucion: distribucion_all,
        curso: cursos,
        curs: curso,
        newAsignacion: [],
    },
    mounted() {
        this.onAsignacion();
    },
    methods: {
        onAsignacion() {
            let asig = this.curso;
            let asi = this.curs;
            //let arr = [];
            const results = asig.filter(({
                id: id1
            }) => !asi.some(({
                id: id2
            }) => id2 === id1));
            this.newAsignacion = results;
        }
    }
});
</script>

@stop