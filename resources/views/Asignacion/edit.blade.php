@extends('layouts.nav')
@section('title', 'Smartmoodle')
@section('content')




<section class="content" id="mate">
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="font-weight-light">Editar Asignación Estudiante</h1>
                <div class="row">
                    <div class="col-md-10">
                        <form method="POST" action="{{route('assignments.update', $assignment->id)}} ">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label>Unidad Educativa</label>
                                <select class="form-control select" name="instituto" disabled style="width: 99%;">
                                    <option value="{{$instituto->id}}">{{$instituto->nombre}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Estudiante</label>
                                <select class="form-control select" name="estudiante" disabled style="width: 99%;">

                                    <option selected disabled value="{{ $user->id }}">
                                    {{ $user->name }} {{ $user->apellido }}
                                    </option>


                                </select>
                            </div>

                            <div class="form-group">
                                <label>Actualización Materias</label>
                                <select class="select2" :materias="2" multiple="multiple" name="materia[]"
                                    data-placeholder="Select a State" style="width: 100%;">
                                    @foreach($materias_user as $materia)
                                    <option selected value="{{$materia->id}}">{{$materia->nombre}}</option>
                                    @endforeach
                                    <option v-for="mate in newMateria" :value="mate.id">@{{mate.nombre}}</option>

                                </select>
                            </div>

                            <label for="nombre">Estado</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" @if($assignment['estado']=="on" ) checked
                                        @elseif(old('estado')=="on" ) checked @endif>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                        value="off" @if($assignment['estado']=="off" ) checked
                                        @elseif(old('estado')=="off" ) checked @endif>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                                <br><br><br>

                                <a href="{{route('assignments.index')}}" class="btn btn-primary">Atras</a>
                                <input type="submit" class="btn btn-dark " value="Guardar">

                        </form>
                    </div>
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
var materias = @json($materias_user);
var materias_all = @json($materias);
const materi = new Vue({
    el: '#mate',
    data: {
        materia: materias,
        all_materia: materias_all,
        newMateria: [],
    },
    mounted() {
        this.onMateria();
    },
    methods: {
        onMateria() {
            let mate = this.all_materia;
            let mat = this.materia;
            let arr = [];
            const results = mate.filter(({
                id: id1
            }) => !mat.some(({
                id: id2
            }) => id2 === id1));
            this.newMateria = results;

        }
    }
});
</script>

@stop