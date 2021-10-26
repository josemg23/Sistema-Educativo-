@extends('layouts.nav')


@section('title', 'Smartmoodle')




@section('content')



@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<section class="content">
    <div class="container">
        <a class="btn btn-info float-right" href="{{route('assignments.create')}}"><i class="fas fa-plus"></i>
            Crear</a>
        <h1 class="font-weight-light">Gestión de Asignación de Estudiantes</h1>

        <table id="myTable" class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Unidad Educativa</th>
                    <th scope="col">Estudiante</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Paralelo</th>
                    <th scope="col">Materia(s)</th>
                    <th  scope="col" width="75">Estado</th>
                    <th scope="col" class="text-center">Tools</th>
                </tr>
            </thead>
            <tbody>

                @foreach($as as $a)
                <tr>
                    <td>{{$a->instituto->nombre}} </td>
                    <td>
                        {{$a->user->name}}
                        {{$a->user->apellido}}
                    </td>
                    <td>
                       {{$a->user->distribucionmacu->curso->nombre}}
                   </td>
                    <td>
                        {{$a->user->nivel->nombre}}
                    </td>
                    <td>
                        @if($a->materias != null)
                        @foreach($a->materias as $e)
                        <span class="badge badge-success">
                            {{$e->nombre}}
                        </span>
                        @endforeach
                        @endif
                    </td>
                    <td class="text-center">
                       {{ $a['estado']}}
                        
                    </td>
                    <td class="table-button text-center">
                        <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                        <form method="POST" action="{{route('assignments.destroy', $a->id)}}}">
                            @method('DELETE')
                            @csrf

                            <a class="btn btn-info " href="{{route('assignments.show',$a->id)}}"><i
                                    class="fas fa-eye"></i></a>
                            <a class="btn btn-success btn" href="{{route('assignments.edit', $a->id)}}"><i
                                    class=" fas fa-pencil-alt"></i></a>

                            <button type="submit" class="btn btn-danger "><i class="fas fa-trash"></i></button>

                        </form>
                    </td>
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

<script type="text/javascript">
$(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
})
</script>




<script>
$(function() {
    $(document).ready(function() {
     var table= $('#myTable').DataTable({
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