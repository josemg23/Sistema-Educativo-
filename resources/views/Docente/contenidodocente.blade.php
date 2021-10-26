{{-- @extends('layouts.docapp') --}}

@extends('layouts.nav')
@section('title', 'Unidades | SmartMoodle')
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
    padding-right: 1rem;
    /* space for ellipsis */
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
        <h2 class="font-weight-light" style="color:blue;"> {{ auth()->user()->name, }} {{ auth()->user()->apellido, }}
        </h2>




        <!-- <a class="btn btn-dark btn" href="{{route('Alumnos', $materia->id)}}" ><i class="fas fa-users"></i>
            Estudiantes</i></a> -->
        <a class="btn btn-info btn" href="{{ route('contenido.talleres', $materia->id) }}"><i
                class="fas fa-book-open"></i>
            Talleres</i></a>
            <h3 class="text-center"> RECURSOS EDUCATIVOS DIGITALES</h3>

    </div>
</section>

<br>
<div class="container">
    <div class="card gedf-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="ml-2">
                        <div class="h5 m-0">{{$materia->nombre}}</div>
                        <div class="h7 text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
     
            <table id="myTable3" class="table table-hover">
                <thead>
                    <th scope="col">Unidad</th>
                    <th scope="col">Nombre del Documento</th>
                    <th width="500" scope="col">Descripcion</th>
                    <th scope="col">Acción</th>
                    <th width="125" scope="col" coldspan="1">Ver Documento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cons as $c)
                    <tr>
                        <td> {{$c->nombre_c}}</td>
                        <td> {{$c->nombre}}</td>
                        <td> {{$c->descripcion}}</td>
                        <td>@if($c['accion']== '1')
                            <span class="badge-success badge">Descargable</span>
                            @else
                            <span v-else class="badge-info badge">No Descargable</span>
                            @endif
                        </td>
                        <td>
                            @if($c['accion']== '1')
                            <!-- descarganle -->
                            <a class="btn btn-dark btn" href="{{route('Contenido2.docente', $c->id)}}"><i
                                    class="fas fa-eye"></i></a>

                            @else
                            <!-- no descarganle -->
                            <a class="btn btn-dark btn" href="{{route('Contenido.docente', $c->id)}}"><i
                                    class="fas fa-eye"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
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
                        <div class="h5 m-0">PARALELOS</div>
                        <div class="h7 text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">

            @isset ($paralelos)
            <div class="row">
                @forelse($paralelos as $paralelo)
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            {{-- <h5 class="text-center"> <strong> {{$paralelo['paralelo']}}</strong></h5> --}}
                            <p>PARALELO</p>
                            <h2 class="text-center font-weight-bold">{{ $paralelo['nivel_nombre'] }} </h2>
                        </div>
                        <div class="icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <a href="{{ route('paralelo', ['id' => $materia->id, 'nivel' => $paralelo['nivel_id']] ) }}"
                            class="small-box-footer">
                            Acceder <i class="fas fa-arrow-circle-right"></i>
                        </a>

                    </div>
                </div>
                @empty
                <h1>No tienes cursos asignados</h1>

                @endforelse

                @endisset
            </div>
        </div>
    </div>



    {{-- <div class="container">
    <div class="card gedf-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="ml-2">
                        <div class="h5 m-0">Talleres Por Calificar</div>
                        <div class="h7 text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="myTable" class="table table-hover">
                <thead>
                    <tr>
                        <th  width="100" scope="col">Curso</th>
                        <th  width="75" scope="col">Materia</th>
                        <th  width="75" scope="col"> Taller </th>
                        <th  width="100" scope="col">Alumno </th>
                        <th  scope="col">Enunciado </th>
                        <th  scope="col">Vista Taller</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $taller)
                    <tr>
                        <td>{{$taller->cur_nombre}} - {{ $taller->nivel_nombre }}</td>
    <td>{{$taller->mate_nombre}}</td>
    <td>{{$taller->nombre}}</td>
    <td>{{$taller->alumno}}</td>
    <td>
        <div class="truncate-overflow">
            {!!$taller->enunciado!!}

        </div>
        @if ($taller->plantilla_id == 37)
        Taller de Modulos Contable
        @else
        {!!$taller->enunciado!!}
        @endif
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

</div>
</div>
</div>

--}}
{{-- 
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
                        <th width="100" scope="col">Curso</th>
                        <th width="75" scope="col">Materia</th>
                        <th width="75" scope="col"> Taller </th>
                        <th width="100" scope="col">Alumno </th>
                        <th scope="col">Enunciado </th>
                        <th scope="col">Vista Taller</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($calificado as $taller)
                    <tr>
                        <td>{{$taller->cur_nombre}} - {{ $taller->nivel_nombre }}</td>
<td>{{$taller->mate_nombre}}</td>
<td>{{$taller->nombre}}</td>
<td>{{$taller->alumno}}</td>
<td>
    <div class="truncate-overflow">
        {!!$taller->enunciado!!}

    </div>
    @if ($taller->plantilla_id == 37)
    Taller de Modulos Contable
    @else
    {!!$taller->enunciado!!}
    @endif
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

</div>
</div>
</div>

--}}


@stop
@section('css')
@stop
@section('js')
<script>
$(function() {
    $(document).ready(function() {
        $('#myTable').DataTable({
            "info": true,
            "autoWidth": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });

        $('#myTable2').DataTable({
            "info": true,
            "autoWidth": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });

        $('#myTable3').DataTable({
            "info": true,
            "autoWidth": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });


        $('#myTable3 thead tr').clone(true).appendTo('#myTable3 thead');
        $('#myTable3 thead tr:eq(1) th').each(function(i) {

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