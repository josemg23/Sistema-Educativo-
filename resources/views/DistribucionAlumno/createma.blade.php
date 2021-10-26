@extends('layouts.nav')


@section('title', 'Crear Asignación')

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
<section class="content" id="materias">
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="font-weight-light">Crear Asignación de Alumno</h1>
                <div class="row">
                    <div class="col-md-10">

                        <form method="POST" action="{{route('distrimas.index')}} ">
                            @csrf
                            <div class=" card-body">



                                <div class="form-group">
                                    <label>Unidad Educativa</label>
                                    <select class="form-control select" v-model="instituto" @change="onAsignacion()"
                                        name="instituto" style="width: 99%;">
                                        <option selected disabled>Elija una Unidad educativa...</option>
                                        @foreach($institutos as $instituto)
                                        <option value="{{$instituto->id}}">{{$instituto->nombre}}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Estudiante</label>
                                    <select class="form-control select2" name="estudiante" style="width: 99%;">
                                        <option selected disabled>Elija al Estudiante...</option>
                                        <option v-for="estuden in users" :value="estuden.id">@{{estuden.name}}
                                            @{{estuden.apellido}}
                                        </option>


                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Asignación Curso</label>
                                    <select class="form-control select2" name="asignacion" style="width: 99%;">
                                        <option selected disabled>Elija el Curso...</option>

                                        <option v-for="dist in distribucion" :value="dist.id">
                                            @{{dist.nombre}}</option>


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Paralelo</label>
                                    <select class="form-control select" name="paralelo" style="width: 99%;">
                                        <option selected disabled>Seleccione el Paralelo...</option>
                                        @foreach($nivels as $nivel)
                                        <option value="{{$nivel->id}}">{{$nivel->nombre}}
                                        </option>
                                        @endforeach
                                    </select>
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
                                <br>
                                <input type="submit" class="btn btn-dark " value="Guardar">
                                <a href="{{url()->previous()}}" class="btn btn-primary">Regesar</a>
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
$(function() {
    //Initialize Select2 Elements
    $(".select2").select2({
    });

})
</script>

<!-- script para select dinamico prueba 2  -->

<script>
const inst = new Vue({
    el: '#materias',
    data: {
        instituto: '',
        distribucion: [],
        users: []
    },
    methods: {
        onAsignacion() {

            var set = this;
            set.users = [];
            axios.post('/sistema/userinst', {
                id: set.instituto
            }).then(response => {
                set.users = response.data;
                console.log(set.users); //no es necesario
            }).catch(e => {
                console.log(e);
            });

            set.distribucion = [];
            axios.post('/sistema/distinst', {
                id: set.instituto
            }).then(response => {
                set.distribucion = response.data;
                console.log(set.distribucion); //no es necesario
            }).catch(e => {
                console.log(e);
            });


        }
    }
});
</script>




@stop