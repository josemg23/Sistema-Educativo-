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
        <h1 class="font-weight-light" style="color:red;">  @isset ( auth()->user()->instituto->nombre)
            {{ auth()->user()->instituto->nombre}}
                
            @endisset</h1>
        <h2 class="font-weight-light" style="color:blue;"> {{ auth()->user()->name, }} {{ auth()->user()->apellido, }}
           
        </h2>

        <a class="btn btn-info btn" href="{{ route('contenido.resueltos',['id'=>$id]) }}"><i
                class="fas fa-book-open"></i>
            Talleres Resueltos</i></a>
         <h3 class="  font-weight-bold text-success">{{ $materia->nombre }}</h3>
            <h2 class="font-weight-bold text-dark">Administrador de Talleres</h2>
        <br>
        <br>
<div id="talleres">
         <ul class="nav nav-tabs" id="myTab" role="tablist">
    @foreach ($contenidos as $c => $contenido)
    <li class="nav-item">
      <a class="nav-link @if ($c== 0) active @endif " id="contenido{{ $contenido->id }}-tab" data-toggle="tab"
        href="#contenido{{ $contenido->id }}" role="tab" aria-controls="contenido{{ $contenido->id }}"
      aria-selected="true">{{ $contenido->nombre }}</a>
    </li>
    @endforeach
  </ul>
  
  <div class="tab-content" id="myTabContent">
    @foreach ($contenidos as $c => $contenido)
    <div class="tab-pane fade show @if ($c== 0) active @endif " id="contenido{{ $contenido->id }}"
      role="tabpanel" aria-labelledby="contenido{{ $contenido->id }}-tab">
      <div class="row justify-content-center">
        <div class="col-12">
          <!-- Inicio de Talleres -->
          <div class="card card-gray-dark mt-2">
            <div class="card-header">
              <h3 class="card-title">Talleres por activar</h3>
            </div>
            <div class="card-body" style="height: 400px; overflow-y: scroll; overflow-x: hidden;">
              <table class="table table-hover">
                <thead>
                  <tr class="text-center">
                    {{-- <th scope="col" width="100">Unidad</th> --}}
                    <th scope="col" width="100"> Taller </th>
                    <th scope="col">Enunciado </th>
                    <th scope="col">Paralelos Activos</th>
                    {{-- <th scope="col">Fecha Entrega</th> --}}
                    <th scope="col" colspan="2">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($talleres= App\Taller::where('contenido_id', $contenido->id)->where('estado', 1)->get() as $taller)
                  <tr>
                    {{-- <td>{{$taller->contenido->nombre}}</td> --}}
                    <td>{{$taller['nombre']}}</td>
                    <td >   <div class="truncate-overflow">
                            {!!$taller['enunciado']!!}
                                
                            </div></td>
                    {{-- <td>
                      @if ($taller['estado'] == 1)
                      <span class="badge-success badge">activo</span>
                      @else
                      <span class="badge-danger badge">desactivado</span>
                      @endif
                      <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch"
                        class="onoffswitch-checkbox"
                        id="myonoffswitch.{{ $taller->id }}" tabindex="0" @if($taller['estado'] ==1) checked @endif>
                        <label class="onoffswitch-label"
                          for="myonoffswitch.{{ $taller->id }}">
                          <span class="onoffswitch-inner"></span>
                          <span class="onoffswitch-switch"></span>
                        </label>
                      </div>
                    </td> --}}
                    <td width="150" class="text-center"> @livewire('paralelos',[$id, $taller->id])</td>
                    <td width="50" class="table-button ">
                      <a class="btn btn-info"
                        href="{{route('taller',['plant'=>$taller->plantilla_id,'id'=>$taller->id])}}"><i
                        class="fas fa-eye"></i>
                      </a>
                    </td>
                    <td width="50">
                      <a data-toggle="modal" data-target="#fecha" class="btn btn-warning" href="#" @click.prevent="active({{ $taller->id }})">
                      <i class="fas fa-edit"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
          {{--    <div class="row justify-content-center mt-4">
                {{  $talleres->links() }}
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    

  
  </div>

</div>
   

        @livewire('talleres',[$id])

</section>
@stop
@section('css')
@livewireStyles
@stop
@section('js')
@livewireScripts
<script type="text/javascript">
    window.addEventListener('activado', event => {
     $('#'+event.detail.modal).modal('hide');
      toastr.success(event.detail.mensaje, "Smarmoddle", {
        "timeOut": "3000"
    });
})
 
 let talleres = new Vue({
   el: "#talleres",
   data:{

   },
   methods:{
    active(id){
      console.log(id)
      Livewire.emit('active',id)
    }
   }
 
 })
// let talleres = @json($tallers);
// let talleress = @json($talleres);
// let materia = @json($id);
// console.log(talleress)
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