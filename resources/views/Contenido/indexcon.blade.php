@extends('layouts.nav')

@section('title', 'Contenido | SmartMoodle')


@section('encabezado')



<!-- la referencia que hace este boton es al Rolecontroller en el 
                       cual esta llamando al metodo create y nos redirecciona al crud Roles.createroler...-->



@stop

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<section class="content">
    <div class="container">
        <a class="btn btn-info float-right " href="{{route('contenidos.create')}}"><i class="fas fa-plus"></i>
            Crear</a>
        <h1 class="font-weight-light">Gestión de Unidades</h1>

        <table id="myTable" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                <th scope="col">Unidad Educativa</th> 
                   <th scope="col">Materia</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Estado</th>
                 
                    <th scope="col" coldspan="3">Tools</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($contenidos as $contenido)
                <tr>
                <td>{{ $contenido->materia->instituto->nombre}}</td>   
                   <td>{{ $contenido->materia->nombre}}</td>
                    <td>{{ $contenido['nombre']}}</td>
                    <td>{{ $contenido['descripcion']}}</td>
                    <td>{{ $contenido['estado']}}</td>
                  
                    <td class="table-button ">
                        <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                        <form method="POST" action="{{route('contenidos.destroy',$contenido->id)}}}"
                            enctype="multipart/form-data">
                            @method('DELETE')
                            @csrf

                            <a class="btn btn-info btn" href="{{route('contenidos.show', $contenido->id)}}"><i
                                    class="fas fa-eye"></i></a>
                            <a class="btn btn-success btn" href="{{route('contenidos.edit', $contenido->id)}}"><i
                                    class=" fas fa-pencil-alt"></i></a>
                            <button type="submit" onclick="return confirm('¿Desea Borrar?');" class="btn btn-danger "><i
                                    class="fas fa-trash"></i></button>
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
            "scrollX": true,

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