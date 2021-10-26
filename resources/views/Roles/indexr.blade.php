@extends('layouts.nav')

@section('title', 'Roles | SmartMoodle')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<section class="content">
    <div class="container">

        <a class="btn btn-info float-right" href="{{route('roles.create')}}"><i class="fas fa-plus"></i>
            ROLES</a>
        <h1 class="font-weight-light">Gestion de Roles</h1>



        <table id="myTable" class="table table-hover">
            <thead>
                <tr>

                    <th scope="col">Rol</th>
                    <th scope="col">Detalle</th>
                    <th scope="col">Acceso Completo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Tools</th>
                </tr>
            </thead>
            <!--Table head-->

            <!--Table body-->
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{$role['name']}}</td>
                    <td>{{$role['descripcion']}}</td>
                    <td>{{ $role['full-access']}}</td>
                    <td>{{$role['estado']}}</td>
                    <td class="table-button ">
                        <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                        <form method="POST" action="{{route('roles.destroy', $role->id)}}}">
                            @csrf
                            @method('DELETE')

                            <a class="btn btn-info" href="roles/{{ $role['id']}}"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-success " href="roles/{{ $role['id']}}/edit"><i
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
            "orderCellsTop": false,
            "info": true,
            "autoWidth": true,
            "paging": true,
            "searching": true,
            "ordering": true,
            "responsive": true,


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