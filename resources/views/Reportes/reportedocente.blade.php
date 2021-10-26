@extends('layouts.nav')
@section('title', 'Administracion - Inicio')
@section('content')


<section class="content-fluid">
    <div class="container-fluid">
        <h1 class="font-weight-light" style="color:dark;"> Reportes Generales</h1>

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                    aria-controls="nav-home" aria-selected="true">Reporte Unidad Educatva/Materia</a>
                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                    aria-controls="nav-profile" aria-selected="false">Reporte Docente</a>
                <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                    aria-controls="nav-contact" aria-selected="false">Reporte Estudiantes</a>
                <a class="nav-link" id="nav-users-tab" data-toggle="tab" href="#nav-users" role="tab"
                    aria-controls="nav-users" aria-selected="false">Reporte Usuarios</a>
                <a class="nav-link" id="nav-vigencia-tab" data-toggle="tab" href="#nav-vigencia" role="tab"
                    aria-controls="nav-vigencia" aria-selected="false">Docente/Estudiante</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <!--aqui esta la seccion del reporte de la unidad educativa-->
                <br>
                <div class="btn-group float-right" role="group" aria-label="Basic example">

                    <a class="btn btn-dark float-right" href="{{route('distribucion.excel')}}"> <i
                            class="fas fa-save"></i>
                        Generar Reporte</a>
                </div>
                <br>
                <br>
                <table id="myTable" class="table table-hover">
                    <thead >
                        <tr>
                            <th scope="col">Unidad Educativa</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Materia</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Taller</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dist as $dis)
                        @if($dis->materias != null)
                        @foreach($dis->materias as $ma)
                        @if($ma->contenidos != null)
                        @foreach($ma->contenidos as $contenido)
                        @if($contenido->tallers != null)
                        @foreach($contenido->tallers as $tl)
                        <tr>
                            <td>{{$dis->instituto->nombre}}</td>
                            <td>{{$dis->curso->nombre}}</td>
                            <td class="text-left">{{$ma->nombre}}</td>
                            <td>{{$contenido->nombre}}</td>
                            <td>{{$tl->nombre}}</td>

                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <!--aqui esta la seccion del reporte de docente-->
                <br>
                <div class="btn-group float-right" role="group" aria-label="Basic example">
                    <a class="btn btn-dark float-right" href="{{route('docente.excel')}}"> <i class="fas fa-save"></i>
                        Generar Reporte</a>
                </div>
                <br>
                <br>
                <table id="myTable1" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Unidad Educativa</th>
                            <th scope="col">Docente</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Materia</th>
                            <th scope="col">Paralelo</th>
                            <th scope="col">Fecha Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doc as $do)

                        <tr>
                            <td>{{$do->instituto->nombre}}</td>
                            <td>{{$do->user->name}} {{$do->user->apellido}}</td>
                            <td>
                                @foreach($do->materia->distribucionmacus as $c)
                                {{$c->curso->nombre}}
                                @endforeach
                            </td>
                            <td class="text-left">
                                {{$do->materia->nombre}}
                            </td>
                            <td class="text-center">
                                @if($do->paralelos != null)
                                @foreach($do->paralelos as $dismacu)
                                <span class="badge badge-success">
                                    {{$dismacu->nombre}}
                                </span>

                                @endforeach
                                @endif
                            </td>
                            <td> {{$do->user->created_at->diffForHumans()}}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                <!--aqui esta la seccion del reporte de estudiante-->
                <br>
                <div class="btn-group float-right" role="group" aria-label="Basic example">

                    <a class="btn btn-dark float-right" href="{{route('asignacion.excel')}}"> <i
                            class="fas fa-save"></i>
                        Generar Reporte</a>
                </div>
                <br>
                <br>
                <table id="myTable2" class="table table-hover">
                    <thead >
                        <tr>
                            <th scope="col">Unidad Educativa</th>
                            <th scope="col">Estudiante</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Paralelo</th>
                            <th scope="col">Materia</th>
                            <th scope="col">Fecha Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($est as $es)
                        @if($es->materias != null)
                        @foreach($es->materias as $ma)
                        @if($ma->distribucionmacus != null)
                        @foreach($ma->distribucionmacus as $cur)
                        <tr>
                            <td>{{$es->instituto->nombre}}</td>
                            <td>{{$es->user->name}} {{$es->user->apellido}}</td>
                            <td>{{$cur->curso->nombre}}</td>
                            <td>{{$es->user->nivel->nombre}}</td>
                            <td class="text-left">{{$ma->nombre}}</td>
                            <td> {{$es->user->created_at->diffForHumans()}}</td>
                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab">

                <!--aqui esta la seccion del reporte de usuarios-->
                <br>
                <div class="btn-group float-right" role="group" aria-label="Basic example">

                    <a class="btn btn-dark float-right" href="{{route('users.excel')}}"> <i class="fas fa-save"></i>
                        Generar Reporte</a>
                </div>
                <br>
                <br>
                <table id="myTable3" class="table table-hover">
                    <thead >
                        <tr>
                            <th scope="col">Unidad Educativa</th>
                            <th scope="col">Nombre/Apellido</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Fecha Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                @isset($user->instituto->nombre)
                                {{$user->instituto->nombre}}
                                @endisset
                            </td>
                            <td>{{$user->name}} {{$user->apellido}}</td>
                            <td>
                                @foreach($user->roles as $role)
                                <span class="badge badge-primary"> {{$role->name}}
                                </span>
                                @endforeach
                            </td>
                            <td> {{$user->created_at->diffForHumans()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-vigencia" role="tabpanel" aria-labelledby="nav-vigencia-tab">
                <!--aqui esta la seccion del reporte de docente-->
                <br>
                <div class="btn-group float-right" role="group" aria-label="Basic example">
                    <a class="btn btn-dark float-right" href="{{route('curso.excel')}}"> <i class="fas fa-save"></i>
                        Generar Reporte</a>
                </div>
                <br>
                <br>
                <table id="myTable4">
                    <thead >
                        <tr>
                            <th scope="col">Und. Educativa</th>
                            <th scope="col">Docente</th>
                            <th scope="col">Materia</th>
                            <th scope="col">Estudiante</th>
                            <th scope="col" align="center">Curso/Paralelo</th>
                            <th scope="col">Fecha Creación</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doc as $do)
                        @foreach($do->materia->assignments as $asig)
                        <tr>
                            <td>{{$do->instituto->nombre}}</td>
                            <td>{{$do->user->name}} {{$do->user->apellido}}</td>
                            <td class="text-left">
                                {{$do->materia->nombre}}
                            </td>
                            <td>{{$asig->user->name}} {{$asig->user->apellido}}</td>
                            <td>{{$asig->user->distribucionmacu->curso->nombre}}-({{$asig->user->nivel->nombre}})</td>
                            <td> {{$asig->user->created_at->diffForHumans()}}</td>
                        </tr>
                      
                        @endforeach
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- hasta aqui los tab -->
        </div>
    </div>
</section>
@stop
@section('css')

@stop
@section('js')

<script>
$(function() {
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            "fixedHeader": true,
            "orderCellsTop": true,
            "info": true,
            "autoWidth": true,
            "searching": true,
            "responsive": true,

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });

        $('#myTable thead tr').clone(true).appendTo('#myTable thead');
        $('#myTable thead tr:eq(1) th').each(function(i) {

            var title = $(this).text(); //es el nombre de la columna
            $(this).html('<input type="text" placeholder="Buscar..." class="form-control-sm" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

    });
});
</script>
<script>
$(function() {
    $(document).ready(function() {
        var table = $('#myTable1').DataTable({
            "fixedHeader": true,
            "orderCellsTop": true,
            "info": true,
            "autoWidth": true,
            "searching": true,
            "responsive": true,

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });

        $('#myTable1 thead tr').clone(true).appendTo('#myTable1 thead');
        $('#myTable1 thead tr:eq(1) th').each(function(i) {

            var title = $(this).text(); //es el nombre de la columna
            $(this).html('<input type="text" placeholder="Buscar..." class="form-control-sm" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

    });
});
</script>

<script>
$(function() {
    $(document).ready(function() {
        var table = $('#myTable2').DataTable({
            "fixedHeader": true,
            "orderCellsTop": true,
            "info": true,
            "autoWidth": true,
            "searching": true,
            "responsive": true,


            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });

        $('#myTable2 thead tr').clone(true).appendTo('#myTable2 thead');
        $('#myTable2 thead tr:eq(1) th').each(function(i) {

            var title = $(this).text(); //es el nombre de la columna
            $(this).html('<input type="text" placeholder="Buscar..." class="form-control-sm" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

    });
});
</script>

</script>

<script>
$(function() {
    $(document).ready(function() {
        var table = $('#myTable3').DataTable({
            "fixedHeader": true,
            "orderCellsTop": true,
            "info": true,
            "autoWidth": true,
            "searching": true,
            "responsive": true,

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });

        $('#myTable3 thead tr').clone(true).appendTo('#myTable3 thead');
        $('#myTable3 thead tr:eq(1) th').each(function(i) {

            var title = $(this).text(); //es el nombre de la columna
            $(this).html('<input type="text" placeholder="Buscar..." class="form-control-sm" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

    });
});
</script>

<script>
$(function() {
    $(document).ready(function() {
        var table = $('#myTable4').DataTable({
            "fixedHeader": true,
            "orderCellsTop": true,
            "info": true,
            "autoWidth": true,
            "searching": true,
            "responsive": true,

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });

        $('#myTable4 thead tr').clone(true).appendTo('#myTable4 thead');
        $('#myTable4 thead tr:eq(1) th').each(function(i) {

            var title = $(this).text(); //es el nombre de la columna
            $(this).html('<input type="text" placeholder="Buscar..." class="form-control-sm" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

    });
});
</script>



@stop