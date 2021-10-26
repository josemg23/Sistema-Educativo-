@extends('layouts.nav')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/mapa.css') }}">

@endsection
@section('titulo', $datos->nombre)
@section('content')
<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->nombre }}</h1>
     <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>

<form action="{{ route('taller46', ['idtaller' => $d]) }}" method="POST" id="taller46">
    @csrf
	 <div class="container mb-5">
        <div class="row  justify-content-center align-items-center mb-4">
            <div class="col-4 purple-border">
                <textarea placeholder="4. Personas Juridicas" name="persona_juridica"  class="form-control" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="col-4 align-self-center text-center" >
                <div class="border border-success mapa" style="">
                        <p> Objeto</p>  
                </div>
              
            </div>
            <div class="col-4 green-border">
                <textarea  placeholder="1.Objetivo " name="objetivo" class="form-control"  id="" cols="30" rows="10"></textarea>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-4">
                <div class="headshot headshot-1">
                    <div class="border border-primary mapa" style="">
                        <p> PERSONAS 
                        JURIDICAS</p>  
                </div>
            </div>
            </div>
            <div class="col-4">
            <div id="foo">
            <p class="hola">RUC</p>
            </div>
            </div>
            <div class="col-4">
                <div class="border border-danger mapa" style="">
                        <p> IMPORTANCIA</p>  
                </div>
            </div>
        </div>
                <div class="row  justify-content-center align-items-center mb-4">
            <div class="col-4 purple-border">
                <textarea placeholder="3. Persona Natural" name="persona_natural"  class="form-control" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="col-4 align-self-center text-center" >
                <div class="border border-success mapa" style="">
                        <p> PERSONAS NATURALES</p>  
                </div>
              
            </div>
            <div class="col-4 green-border">
                <textarea placeholder="2. Importancia" name="importancia" class="form-control"  id="" cols="30" rows="10"></textarea>
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
    $( "#taller46" ).submit();
  }
})
});

</script>
@endsection
