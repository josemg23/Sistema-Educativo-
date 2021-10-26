@extends('layouts.nav')

@section('title', 'Documentación | SmartMoodle')


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
        <a class="btn btn-info float-right " href="{{route('documentos.create')}}"><i class="fas fa-plus"></i>
            Crear</a>
        <h1 class="font-weight-light">Gestión de Documentos</h1>

        <table id="myTable" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Materia</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acción</th>
                    <th scope="col" coldspan="3">Tools</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($documentos as $d)
                <tr>

                    <td>{{ $d->contenido->materia->nombre}}</td>
                    <td>{{ $d->contenido->nombre}}</td>
                    <td>{{ $d['nombre']}}</td>
                    <td>{{ $d['descripcion']}}</td>
                    <td>{{ $d['estado']}}</td>
                    <td>@if($d['accion']== '1')
                        <span class="badge-success badge">Descargable</span>
                        @else
                        <span v-else class="badge-info badge">No Descargable</span>
                        @endif
                    </td>
                    <td class="table-button ">
                        <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                        <form method="POST" action="{{route('documentos.destroy',$d->id)}}}"
                            enctype="multipart/form-data">
                            @method('DELETE')
                            @csrf

                            <a class="btn btn-info btn" href="{{route('documentos.show', $d->id)}}"><i
                                    class="fas fa-eye"></i></a>
                            <a class="btn btn-success btn" href="{{route('documentos.edit', $d->id)}}"><i
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