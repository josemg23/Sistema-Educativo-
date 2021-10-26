{{-- @extends('layouts.docapp') --}}

@extends('layouts.nav')
@section('title', 'Unidades | SmartMoodle')

@section('content')

<section class="content">
    <div class="container">
        <h1 class="font-weight-light" style="color:red;"> @isset ( auth()->user()->instituto->nombre)
            {{ auth()->user()->instituto->nombre}}
                
            @endisset</h1>
        <h1>Cursos</h1>
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th scope="col">Curso</th>
                    <th scope="col">Paralelo</th>
                    <th scope="col">Materia</th>
                    <th scope="col">Nombre/Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Ultimo Acceso</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materia->assignments as $ass)
                <tr>
                    <td> {{$ass->user->distribucionmacu->curso->nombre}}</td>
                    <td>{{$ass->user->nivel->nombre}}</td>
                    <td> {{$materia->nombre}}</td>
                    <td> {{$ass->user->name}} {{$ass->user->apellido}}</td>
                    <td>{{$ass->user->email}}</td>
                    <td> {{$ass->user->created_at->diffForHumans()}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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

            let title = $(this).text(); //es el nombre de la columna
            $(this).html('<input type="text" placeholder="Buscar..." />');

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