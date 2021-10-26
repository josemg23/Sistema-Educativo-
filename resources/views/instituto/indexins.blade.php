@extends('layouts.nav')

@section('title', 'Unidad Educativa')



@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<section class="content">
    <div class="container">

        <div class="btn-group float-right" role="group" aria-label="Basic example">

            <a class="btn btn-info float-right " href="{{route('institutos.create')}}"><i class="fas fa-plus"></i></i>
                UND EDUCATIVA</a>
        </div>

        <h1 class="font-weight-light"> Gestión de Unidad Educativa</h1>

        <div class="row justify-content-center">

            <table id="myTable" class="table table-hover">

                <!--Table head-->
                <thead>
                    <tr>

                        <th scope="col">Nombre</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Correo </th>
                        <th scope="col">Estado</th>
                        <th scope="col" coldspan="3">Tools</th>
                    </tr>
                </thead>
                <!--Table head-->

                <!--Table body-->
                <tbody>
                    @foreach ($institutos as $instituto)
                    <tr>
                        <td>{{$instituto->nombre}}</td>
                        <td>{{$instituto->telefono}}</td>
                        <td>{{$instituto->email}}</td>
                        <td>{{$instituto->estado}}</td>

                        <td class="table-button ">
                            <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                            <form method="POST" action="{{route('institutos.destroy', $instituto->id)}}}">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-info " href="institutos/{{ $instituto['id']}}"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-success" href="institutos/{{ $instituto['id']}}/edit"><i
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