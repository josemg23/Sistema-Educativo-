@extends('layouts.nav')

@section('title', 'Unidades Docente | SmartMoodle')




@section('title', 'Administracion - Docente')

@section('content')


<section class="content">
    <div class="container">


        <h1 class="font-weight-light" style="color:red;"> @isset ( auth()->user()->instituto->nombre)
            {{ auth()->user()->instituto->nombre}}
            @endisset</h1>

        <h2 class="font-weight-light">
            @foreach(auth()->user()->roles as $role)
            {{$role->name}} | {{ auth()->user()->name, }}
            {{ auth()->user()->apellido, }}
            @endforeach</h2>
    </div>



</section>


<div class="container">
    <div class="card gedf-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="ml-2">
                        <div class="h5 m-0">Documentos Docente <td align="center" width="20">
                                <a class="btn btn-dark float-right " href="{{route('documentacion.docentecrear')}}"> <i
                                        class="fas fa-plus"></i>
                                </a>
                            </td>
                        </div>
                        <div class="h7 text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <table id="myTable" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Materia</th>
                        <th scope="col">Paralelo</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Descripcion</th>

                        <th scope="col" coldspan="3">Tools</th>

                    </tr>
                </thead>
                <tbody>
               
                    @foreach ($doc as $d)
                    <tr>
                        <td>{{ $d->materia->nombre}}</td>
                        <td>{{ $d->nivel->nombre}}</td>
                        <td>{{ $d['nombre']}}</td>
                        <td>{{ $d['descripcion']}}</td>

                        <td class="table-button ">
                            <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                            <form method="POST" action="{{route('documentaciondoc.destroy',$d->id)}}}"
                                enctype="multipart/form-data">
                                @method('DELETE')
                                @csrf

                                <a class="btn btn-success btn" href="{{route('documentaciondoc.show', $d->id)}}"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-warning btn" href="{{route('documentaciondoc.edit', $d->id)}}"><i
                                        class=" fas fa-pencil-alt"></i></a>
                                <button type="submit" onclick="return confirm('¿Desea Borrar?');"
                                    class="btn btn-danger "><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                
                </tbody>
                <!--Table body-->
            </table>


        </div>
    </div>
</div>




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