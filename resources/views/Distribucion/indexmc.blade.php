@extends('layouts.nav')


@section('title', 'Asignación')



@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<section class="content">
    <div class="container">
        <a class="btn btn-info float-right" href="{{route('distribucionmacus.create')}}"><i class="fas fa-plus"></i>
            Crear Curso</a>
        <h1 class="font-weight-light">Gestión de Curso</h1>

        <table id="myTable" class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Unidad Educativa</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Materia(s)</th>
                    <th scope="col" width="75" class="text-center">Estado</th>
                    <th scope="col" class="text-center">Tools</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($distribucionmacus as $distribucionmacu)
                <tr>
                    <td>{{$distribucionmacu->instituto->nombre}} </td>
                    <td>{{$distribucionmacu->curso->nombre}} </td>
                    <td>
                        @if($distribucionmacu->materias != null)
                        @foreach($distribucionmacu->materias as $dismacu)
                        <span class="badge badge-success">
                            {{$dismacu->nombre}}
                        </span>
                        @endforeach
                        @endif
                    </td>
                    <td class="text-center">
                      {{ $distribucionmacu['estado']}}
                        
                    </td>
                    <td class="table-button text-center">
                        <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                        <form method="POST" action="{{route('distribucionmacus.destroy', $distribucionmacu->id)}}}">
                            @method('DELETE')
                            @csrf
                            <a class="btn btn-info " href="{{route('distribucionmacus.show',$distribucionmacu->id)}}"><i
                                    class="fas fa-eye"></i></a>
                            <a class="btn btn-success btn"
                                href="{{route('distribucionmacus.edit', $distribucionmacu->id)}}"><i
                                    class=" fas fa-pencil-alt"></i></a>

                            <button type="submit" class="btn btn-danger "><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <!--Table body-->
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

            var title = $(this).text(); //es el nombre de la columna
            $(this).html('<input type="text" placeholder="Buscar..." class="form-control"/>');

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