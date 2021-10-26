@extends('layouts.nav')

@section('title', $datos->nombre)
@section('content')

<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->taller->nombre }}</h1>
<h3 class="text-center mt-5 mb-3 text-info">{{ $datos->taller->enunciado }}</h3>
<form action="{{ route('taller47', ['idtaller' => $d]) }}" method="POST" id="taller47">
    @csrf
    <div class="container mb-3">
       <div class="row">
           <div class="col-4 align-self-center">
               <ul class="list-group list-group-flush ">
                @foreach ($datos->enunciados as $enunciado)
                 
                  <li style="font-size: 22px" class="list-group-item bg-transparent border-bottom-0"><span class="badge badge-danger">{{ ++$numero }}. </span> {{ $enunciado->enunciado }}</li>
                    
                @endforeach
                </ul>
           </div>
           <div class="col-8" style="box-shadow: 5px 5px 15px 0px  #087980;>
               <ul class="list-group list-group-flush ">
                @foreach ($datos->definiciones as $definicion)
                  <li class="list-group-item bg-transparent border-bottom-0 text-justify"><span class="badge badge-info">{{ $letra++ }}. </span>{{ $definicion->definicion }}</li>    
                @endforeach
                </ul>
           </div>
       </div>
       <div class="row justify-content-center mt-3">
           <div class="col-4 align-self-center">
            <h2 class="font-weight-bold display-4">Alternativas</h2>
               @foreach ($datos->alternativas as $alternativa)
                <p style="font-size: 22px"><span class="badge badge-danger">{{ ++$numer}}. </span> <input type="radio" value="{{ $alternativa->alternativa }}" name="respuesta"> {{ $alternativa->alternativa }}</p> 
                   
               @endforeach
           </div>
       </div>


    <div class="row justify-content-center">
        <input type="button" id="button" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
    </div>

    </div>
</form>

@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">

 $( "#button" ).click(function( event ) {
  event.preventDefault();
  Swal.fire({
  title: 'Seguro que deseas completar el taller?',
  text: "Esta accion ya no se puede revertir!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Completar!',
  cancelButtonText: 'Cancelar!'
}).then((result) => {
  if (result.isConfirmed) {
    $( "#taller47" ).submit();
  }
})
});

</script>
@endsection
