@extends('layouts.nav')


@section('title', 'Administracion - Inicio')


@section('content')
<section class="content" id="reporte">
    <div class="container-fluid">
        <div class="container">
            <div class="card border-0 shadow my-5">
                <div class="card-body p-5">
                    <h1 class="font-weight-light">Reportes</h1>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Unidad Educativa</label>
                                <select class="form-control select" v-model="instituto" @change="onUnidad()"
                                    name="instituto" style="width: 99%;">
                                    <option selected disabled>Elija una Unidad educativa...</option>
                                    @foreach($institutos as $instituto)
                                    <option value="{{$instituto->id}}">{{$instituto->nombre}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Seleccionar Curso</label>
                                <select class="form-control select" name="fcurso" v-model="fcurso"
                                    @change="onfiltrocurso()" style="width: 99%;">
                                    <option v-for="dist in curso" :value="dist.id">
                                        @{{dist.nombre}}</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="card-body">
            <table id="myTable" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Unidad Educativa</th>
                        <th scope="col">Curso</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Promedio</th>
                    </tr>
                </thead>
                <template v-if="!instituto " v-if="!fcurso">
                    <tbody>
                        @foreach($alldist as $all)
                        @foreach($all->materias as $materia)
                        <tr>
                            <td width="10px">{{$all->id}}</td>
                            <td>{{$all->instituto->nombre}}</td>
                            <td>{{$all->curso->nombre}}</td>
                            <td>{{$materia->nombre}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </template>
                <template  v-if="!fcurso && instituto" >
                    <tbody v-for="un in curso">
                        <tr v-for="mate in un.materia">
                            <td width="10px">@{{un.id}}</td>
                            <td>@{{un.instituto}}</td>
                            <td>@{{un.nombre}}</td>
                            <td>@{{mate.nombre}} </td>
                            <td></td>
                        </tr>
                    </tbody>
                </template>
                <template  v-else="!instituto" v-else="fcurso ">
                    <tbody v-for="filc in filcur">
                        <tr v-for="ma in filc.materia">
                            <td width="10px">@{{filc.id}}</td>
                            <td>@{{filc.instituto}}</td>
                            <td>@{{filc.nombre}}</td>
                            <td>@{{ma.nombre}}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </template>
              
            </table>
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
const inst = new Vue({
    el: '#reporte',
    data: {
        instituto: '', //filtro de instituto
        fcurso: '', //v-model para el filtro de curso 
        //   und: [], //array de unidades educativas filtradas
        curso: [], //todos los cursos de la unidad educativa
          filcur: [], //curso filtrado por medio del select de curso


    },
    mounted: function() {

        this.onUnidad();
       this.onfiltrocurso();

    },
    methods: {
        onUnidad() {
            var set = this;
            set.curso = [];
            axios.post('/sistema/distinst1', {
                id: set.instituto
            }).then(response => {
                set.curso = response.data;
                console.log(set.curso);
            }).catch(e => {
                console.log(e);
            });

            // var set = this;
            // set.filcur = [];
            // axios.post('/sistema/cursoall', {
            //     id: set.fcurso
            // }).then(response => {
            //     set.filcur = response.data;
            // });

        },
        onfiltrocurso() {
            var set = this;
          
             set.filcur = [];
            axios.post('/sistema/cursoall', {
                id: set.fcurso
            }).then(response => {
                set.filcur = response.data;
            });
        },

    }
});
</script>

<script>
$(function() {
    $(document).ready(function() {
        $('#myTable').DataTable({

                "info": false,
                "autoWidth": true,
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "autoWidth": false,
                "responsive": true,

                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            }
        );
    });
});
</script>
@stop