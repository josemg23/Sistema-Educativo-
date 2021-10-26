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
        <h1 class="font-weight-light" style="color:red;">  
          @isset ( auth()->user()->instituto->nombre)
            {{ auth()->user()->instituto->nombre}}
                
            @endisset</h1>
        <h2 class="font-weight-light" style="color:blue;"> {{ auth()->user()->name, }} {{ auth()->user()->apellido, }}
           
        </h2>
         <h3 class="  font-weight-bold text-success">{{ $materia->nombre }}</h3>
            {{-- <h2 class="font-weight-bold text-dark">Talleres Resueltos por mi</h2> --}}
        <br>
        <br>
        <h2 class="text-center font-weight-bold">TALLERES</h2>
        <div class="container accordion"  id="talleres_pendientes">
<div class="card gedf-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="ml-2">
                    <div class="h5 m-0"> <strong>Talleres Pendientes</strong></div>
                    <div class="h7 text-muted"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @foreach($contenidos->where('materia_id', $materia->id) as $key => $contenido)
        <!-- Inicio de Talleres -->
        <div class="card card-gray-dark">
            <div>
                <button class="btn btn-link btn-block text-left text-danger font-weight-bold" type="button" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
                {{$contenido->nombre}}
                </button>
                {{-- <h3 class="card-title"></h3> --}}
            </div>
            <div id="collapse{{ $key }}" class="collapse @if ($key == 0)
                show
                @endif " aria-labelledby="headingOne" data-parent="#talleres_pendientes">
                <div class="card-body">
                    <table class="table table-hover myTable">
                        <thead>
                            <tr>
                                <th scope="col" width="100">Unidad</th>
                                <th scope="col" width="100">Taller </th>
                                <th scope="col">Enunciado </th>
                                {{-- <th scope="col">Fecha Entrega </th> --}}
                                <th scope="col">Vista Taller</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tallers->where('contenido_id', $contenido->id)->where('estado', 1) as
                            $taller)
                            <tr>
                                <td>{{$taller->contenido->nombre}}</td>
                                <td>{{$taller->nombre}}</td>
                                
                                <td>
                                    <div class="truncate-overflow">
                                        {!!$taller->enunciado!!}
                                    </div>
                                    {{--  @if ($taller->plantilla_id == 37)
                                    Taller de Modulos Contable
                                    @else
                                    {!!$taller->enunciado!!}
                                    @endif --}}
                                </td>
                               {{--  <td class="text-center">
                                    {{Carbon\Carbon::parse($taller->fecha_entrega)->formatLocalized('%d, %B %Y ') }}
                                </td> --}}
                                <td class="table-button ">
                                    <a class="btn btn-info"
                                        href="{{route('taller',['plant'=>$taller->plantilla_id, 'id'=>$taller->id])}}"><i
                                    class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
        <!-- fin de talleres -->
        @endforeach
    </div>
</div>
</div>
        <div class="container accordion" id="talleres_calificados">
<div class="card gedf-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="ml-2">
                    <div class="h5 m-0"> <strong>Talleres Completados</strong></div>
                    <div class="h7 text-muted"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        @foreach($contenidos->where('materia_id', $materia->id) as  $key1 => $contenido)
        <!-- Inicio de Talleres -->
        <div class="card card-gray-dark">
            <div>
                <button class="btn btn-link btn-block text-left text-info font-weight-bold" type="button" data-toggle="collapse" data-target="#collapse{{ $key1 }}calificados" aria-expanded="true" aria-controls="collapse{{ $key1 }}calificados">
                {{$contenido->nombre}}
                </button>
            </div>
            <div id="collapse{{ $key1 }}calificados" class="collapse @if ($key1 == 0)
                show
                @endif " aria-labelledby="headingOne" data-parent="#talleres_calificados">
                <div class="card-body">
                    <table class="table table-hover myTable">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col" width="100">Unidad</th>
                                <th class="text-center" scope="col" width="80"> Taller </th>
                                <th class="text-center" scope="col">Enunciado </th>
                                {{-- <th class="text-center" scope="col">Estado </th> --}}
                                <th class="text-center" scope="col">Resuelto </th>
                                {{-- <th class="text-center" scope="col">Vista Taller</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->tallers->where('contenido_id', $contenido->id) as
                            $taller)
                            <tr>
                                <td>{{$taller->contenido->nombre}}</td>
                                <td>{{$taller['nombre']}}</td>
                                <td>
                                    <div class="truncate-overflow">
                                        {!!$taller->enunciado!!}
                                    </div>
                                    {{--   @if ($taller->plantilla_id == 37)
                                    Taller de Modulos Contable
                                    @else
                                    {!!$taller->enunciado!!}
                                    @endif --}}
                                </td>
                               
                            </td>
                            <td class="text-center"> 
                                <a class="btn btn-info"
                                    href="{{route('taller.resuelto',['plant'=>$taller->plantilla_id,'id'=>$taller->id])}}"><i
                                class="fas fa-eye"></i></a></span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- fin de talleres -->
@endforeach
</div>
</div>
</div>


</section>
@stop
@section('css')
@livewireStyles
@stop
@section('js')
@livewireScripts}
<script>
$(function() {
    $(document).ready(function() {
        $('.myTable').DataTable({
            "info": true,
            "autoWidth": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
})
  });
        </script>
<script type="text/javascript">
    window.addEventListener('activado', event => {
     $('#'+event.detail.modal).modal('hide');
      toastr.success(event.detail.mensaje, "Smarmoddle", {
        "timeOut": "3000"
    });
})
 

// const taller = new Vue({
//     el: "#myTabContent",
//     data: {
//         materia_id: materia,
//         tallers: talleres,
//         talleres: talleress,
//         taller_id: '',
//         fecha_entrega: '',
//         estado: '',
//         ruta: '/sistema/taller/'
//     },
//     mounted: function() {


//     },
//     methods: {
//         Cambiar(index, id) {
//             let taller_id = id;
//             // console.log(index)
//             let estado = this.talleres[index].talleres[id].estado;
//             let fecha = this.talleres[index].talleres[id].fecha_entrega;
//             this.taller_id = this.talleres[index].talleres[id].id;
//             this.estado = estado;
//             this.fecha_entrega = fecha
//             $('#fecha').modal('show');
//         },
//         Enviar: function() {
//             // let taller = id;
//             var set = this;
//             var url = '/sistema/admin/registro';
//             axios.post(url, {
//                 materia: set.materia_id,
//                 taller_id: set.taller_id,
//                 estado: set.estado,
//                 fecha: set.fecha_entrega
//             }).then(response => {
//                 toastr.success(response.data.message, "Smarmoddle", {
//                     "timeOut": "3000"
//                 });
//                 set.talleres = [];
//                 set.talleres = response.data.talleres;
//                 $('#fecha').modal('hide')
//                 // location.reload();
//             }).catch(function(error) {});
//         }
//     }
// });
</script>
@stop