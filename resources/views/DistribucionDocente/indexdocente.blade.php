@extends('layouts.nav')


@section('title', ' SmartMoodle')



@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif




<section class="content">
    <div class="container">
        <div class="btn-group float-right" role="group" aria-label="Basic example">

            <a class="btn btn-info float-right" href="{{route('distribuciondos.create')}}"><i class="fas fa-plus"></i>
                Asignar Docente</a>
        </div>
        <h1 class="font-weight-light">Gestión de Asignación de Docentes</h1>

        <table id="myTable" class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center" scope="col">Unidad Educativa</th>
                    <th class="text-center" scope="col">Docente</th>
                    <th class="text-center" scope="col">Curso</th>
                    <th class="text-center" scope="col">Materia</th>
                    <th class="text-center" scope="col">Paralelos</th>
                    <th class="text-center" scope="col" width="75">Estado</th>
                    <th scope="col" class="text-center">Tools</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($distribucions as $dis)

                <tr>
                    <td>{{$dis->instituto->nombre}} </td>
                    <td>
                        {{$dis->user->name}}
                        {{$dis->user->apellido}}
                    </td>
                    <td>
                        @foreach($dis->materia->distribucionmacus as $c)
                        {{$c->curso->nombre}}
                        @endforeach
                    </td>
                    <td class="text-center">
                        {{$dis->materia->nombre}}
                    </td>
                    <td class="text-center">
                        @if($dis->paralelos != null)
                        @foreach($dis->paralelos as $dismacu)
                        <span class="badge badge-success">
                            {{$dismacu->nombre}}
                        </span>

                        @endforeach
                        @endif
                    </td>
                    <td class="text-center">

                        {{ $dis['estado']}}


                    </td>
                    <td class="table-button text-center">
                        <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                        <form method="POST" action="{{route('distribuciondos.destroy', $dis->id)}}}">
                            @method('DELETE')
                            @csrf
                            <a class="btn btn-info " href="{{route('distribuciondos.show', $dis->id)}}"><i
                                    class="fas fa-eye"></i></a>
                            <a class="btn btn-success btn" href="{{route('distribuciondos.edit',  $dis->id)}}"><i
                                    class=" fas fa-pencil-alt"></i></a>
                            <button type="submit" class="btn btn-danger "><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
            <!--Table body-->

        </table>

        <!--Table-->
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
            $(this).html('<input type="text" placeholder="Buscar..." class="form-control" />');

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