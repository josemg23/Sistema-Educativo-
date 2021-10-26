@extends('layouts.nav')

@section('title', 'Materias')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<section class="content">
    <div class="container">
        <a class="btn btn-info float-right" href="{{route('materias.create')}}"><i class="fas fa-plus"></i>
            Crear</a>
        <h1 class="font-weight-light">Gestión de Materia</h1>
       
            <!-- left column -->
            <table id="myTable" class="table table-hover">
                <thead>
                    <tr>       
                        <th scope="col">Unidad Educativa</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Tools</th>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($materias as $materia)
                        <td>
                            @if($materia->instituto != null)
                            {{$materia->instituto->nombre}}
                            @endif
                        </td>
                        <td>{{ $materia['nombre']}}</td>
                        <td>{{ $materia['descripcion']}}</td>
                        <td>{{ $materia['estado']}}</td>
                        <td class="table-button ">
                            <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                            <form method="POST" action="{{route('materias.destroy', $materia->id)}}}">
                                @method('DELETE')
                                @csrf
                                <a class="btn btn-info " href="{{route('materias.show', $materia->id)}}"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-success btn" href="{{route('materias.edit', $materia->id)}}"><i
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
            fixedHeader: true,

            "info": true,
            "autoWidth": true,
            "paging": true,
            "searching": true,
            "ordering": true,
            "responsive": true,
            "orderCellsTop": true,

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });

        $('#myTable thead tr').clone(true).appendTo('#myTable thead');
        $('#myTable thead tr:eq(1) th').each(function(i) {

            var title = $(this).text(); //es el nombre de la columna
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