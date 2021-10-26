@extends('layouts.nav')

@section('title', 'Paralelo '.$paralelo->nombre.' | SmartMoodle')
@section('css')
<style type="text/css">
    :root {
  /* Not my favorite that line-height has to be united, but needed */
  --lh: 1.4rem;
}
.truncate-overflow {
  --max-lines: 3;
  position: relative;
  max-height: calc(var(--lh) * var(--max-lines));
  overflow: hidden;
  padding-right: 1rem; /* space for ellipsis */
}
.truncate-overflow::before {
  position: absolute;
  /*content: "...";*/
  /* tempting... but shows when lines == content */
  /* top: calc(var(--lh) * (var(--max-lines) - 1)); */
  
  /*
  inset-block-end: 0;
  inset-inline-end: 0;
  */
  bottom: 0;
  right: 0;
}
.truncate-overflow::after {
  content: "";
  position: absolute;
  /*
  inset-inline-end: 0;
  */
  right: 0;
  /* missing bottom on purpose*/
  width: 1rem;
  height: 1rem;
  background: white;
}
</style>
@endsection

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
        <h2 class="font-weight-bold"> PARALELO {{ $paralelo->nombre }}</h2>
        <h3 class="font-weight-light"> {{ $materia->nombre }}</h3>
    </div>
</section>
 <div class="container">
    <div class="card gedf-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="ml-2">
                        <div class="h5 m-0">Talleres por calificar</div>
                        <div class="h7 text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="myTable" class="table table-hover">
                <thead>
                    <tr>
                        <th width="100">Curso</th>
                        <th width="100">Unidad</th>
                        <th width="75">Materia</th>
                        <th width="100"> Taller </th>
                        <th >Alumno </th>
                        <th >Enunciado </th>
                        <th width="50">Vista Taller</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $taller)
                    <tr>
                        <td>{{$taller->cur_nombre}} - {{ $taller->nivel_nombre }}</td>
                        <td>{{$taller->conte_name}}</td>
                        <td>{{$taller->mate_nombre}}</td>
                        <td>{{$taller->nombre}}</td>
                        <td>{{$taller->alumno}} {{ $taller->apelli }}</td>
                        <td>
                            <div class="truncate-overflow">
                                {!!$taller->enunciado!!}
                                
                            </div>
                        </td>
                        <td class="table-button " width="50">
                            <a class="btn btn-info"
                                href="{{route('taller.docente',['plant'=>$taller->plantilla_id,'id'=>$taller->taller_id, 'user'=>$taller->user_id])}}"><i
                            class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container">
    <div class="card gedf-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="ml-2">
                        <div class="h5 m-0">Talleres Calificados</div>
                        <div class="h7 text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="myTable2" class="table table-hover">
                <thead>
                    <tr>
                        <th width="100">Curso</th>
                        <th width="100">Unidad</th>
                        <th width="75">Materia</th>
                        <th width="100"> Taller </th>
                        <th >Alumno </th>
                        <th>Enunciado </th>
                        <th width="50">Vista Taller</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($calificado as $taller)
                    <tr>
                        <td>{{$taller->cur_nombre}} - {{ $taller->nivel_nombre }}</td>
                        <td>{{$taller->conte_name}}</td>
                        <td>{{$taller->mate_nombre}}</td>
                        <td>{{$taller->nombre}}</td>
                        <td>{{$taller->alumno}} {{ $taller->apelli }}</td>
                        <td>
                            <div class="truncate-overflow">
                                {!!$taller->enunciado!!}
                                
                            </div>
                            
                        </td>
                        <td class="table-button ">
                            <a class="btn btn-info"
                                href="{{route('taller.docente',['plant'=>$taller->plantilla_id,'id'=>$taller->taller_id, 'user'=>$taller->user_id])}}"><i
                            class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row justify-content-center">
                
            </div>
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
       var table1 = $('.myTable').DataTable({
"fixedHeader": true,
"orderCellsTop": false,
"info": true,
"autoWidth": true,
"paging": true,
"searching": true,
"ordering": true,
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
if (table1.column(i).search() !== this.value) {
table1
.column(i)
.search(this.value)
.draw();
}
});
});
var table = $('#myTable2').DataTable({
"fixedHeader": true,
"orderCellsTop": false,
"info": true,
"autoWidth": true,
"paging": true,
"searching": true,
"ordering": true,
"responsive": true,
"scrollX": true,

"language": {
"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
}
});
$('#myTable2 thead tr').clone(true).appendTo('#myTable2 thead');
$('#myTable2 thead tr:eq(1) th').each(function(i) {
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