@extends('layouts.nav')


@section('title', 'Dashboard | SmartMoodle')

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
                <h1 class="font-weight-light">Añadir Asignación Docente/Materia</h1>
                <div class="row">
                    <div class="col-md-10">

                        <form method="POST" action="{{route('distribuciondos.index')}} ">
                            @csrf
                            <div class=" card-body">



                                <div class="form-group">
                                    <label>Unidad Educativa</label>
                                    <select class="form-control select" v-model="instituto" @change="onMateria()"
                                        name="instituto" required style="width: 99%;">
                                        <option selected disabled>Elija una Unidad educativa...</option>
                                        @foreach($institutos as $instituto)
                                        <option value="{{$instituto->id}}">{{$instituto->nombre}}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Docente</label>
                                    <select class="form-control usuario" name="docente" style="width: 99%;">
                                        <option selected disabled>Elija al Docente...</option>
                                        <option v-for="doce in users" :value="doce.id">@{{doce.name}} @{{doce.apellido}}
                                        </option>


                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Materias</label>
                                    <select class="form-control paralelos"  name="materia" style="width: 100%;">
                                        <option selected disabled>Elija una materia...</option>
                                        <optgroup v-for="(curso, index) in materias" :label="curso.nombre">
                                            <option v-for="mater in materias[index].materias" :value="mater.id">@{{ mater.nombre}}</option>
                                        </optgroup>
                                    </select>
                                </div>
                                   <div class="form-group">
                                    <label>Paralelos</label>
                                    <select class="select2" multiple="multiple" name="paralelos[]"
                                        data-placeholder="Selecciona los paralelo" style="width: 100%;">
                                       
                                        <option v-for="paralelo in paralelos" :value="paralelo.id">@{{ paralelo.nombre}}</option>
                                       
                                       
                                    </select>
                                </div>
                               
                               
                             
                                <div class="form-group">
                                    <label for="nombre">Estado</label>
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
                              <a href="{{route('distribuciondos.index')}}" class="btn btn-primary">Atras</a>
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



</script>
<!-- script para select dinamico prueba 2  -->

<script>
const inst = new Vue({
    el: '#materias',
    data: {
        instituto: '',
        materias: [],
        users:[],
        materia:'',
        paralelos:[]
    },
    methods: {
        onMateria() {

            var set = this;

            set.users = [];
            axios.post('/sistema/docinst', {
                id: set.instituto
            }).then(response => {
                set.users = response.data;
                console.log(set.users); //no es necesario
            }).catch(e => {
                console.log(e);
            });


        },
        onMaterias(user){
            var set = this;
             set.materias = [];
            axios.post('/sistema/materiasdocentes', {
                id: set.instituto,
                user_id: user
            }).then(response => {
                set.materias = response.data;
                console.log(set.materias);
            }).catch(e => {
                console.log(e);
            });
        },
        obtenerParalelos(materia){
            let set = this;
            set.paralelos = [];
            axios.post('/sistema/paralelosinst', {
                id: materia
            }).then(response => {
                set.paralelos = response.data;
                console.log(response.data);
            }).catch(e => {
                console.log(e);
            });
        }
    }
});


</script>
<script>
$(function() {
    //Initialize Select2 Elements
    $(".select2").select2({

    });
var $eventSelect = $(".paralelos");

$eventSelect.select2();
$eventSelect.on("select2:select", function (e) { 
  var select_val = $(e.currentTarget).val();
  inst.obtenerParalelos(select_val)
});

let $usuarioid = $(".usuario");

$usuarioid.select2();
$usuarioid.on("select2:select", function (e) { 
  var userid = $(e.currentTarget).val();
  inst.onMaterias(userid)
});




})

</script>

@stop