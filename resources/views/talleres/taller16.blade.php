@extends('layouts.nav')


@section('title', $datos->taller->nombre)
@section('content')

<!-- ENDOSE  EL  CHEQUE  A  NOMBRE DE  LA  ING. ISABEL  PANTOJA -->
<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->taller->nombre }}</h1>
     <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }} LA {{ $datos->endoso }} </h3>

     <form action="{{ route('taller16', ['idtaller' => $d]) }}" method="POST" id="taller16">
          @csrf
     	<div class="container">
     		<div class="row justify-content-center">
     			<div class="col-5"  style="box-shadow: 5px 5px 15px 0px  #27F4AE">
     				<div class="text-center">
     					<h2>ESPACIO PARA ENDOSO</h2>
     			<h6 class="mt-0">(en caso de requerirse)</h6>
     				</div>

     				<div class="text-justify">
     					ENDOSO A: 
     				</div>
     			
		        </div>
     		</div>
     		<div class="row justify-content-center">
     			<div class="col-5" style="box-shadow: 5px 5px 15px 0px  #27F4AE">
     				<div class="row justify-content-center mt-3 mb-2">
     					<div class="col-8 text-center">
     						<input type="text" name="endoso" class="form-control">
     						<label for="">Nombre</label>
     					</div>
     					<div class="col-8 text-center">
     						<input type="text" name="firma" class="form-control">
     						<label for="">Firma del endosante</label>
     						<h6>(1 beneficiario)</h6>
     					</div>
     				</div>
     			</div>
     		</div>
     			<div class="row justify-content-center ">
	     			<div class="col-5 border-success border ">
	     				<div class="text-center mt-1">
	     					<h5 class="text-gray-dark">ESPACIO PARA DEPOSITANTE O PERSONA QUE COBRA</h5>
	     				</div>
					</div>
     			</div>
     			<div class="row justify-content-center">
     			<div class="col-5" style="box-shadow: 5px 5px 15px 0px  #27F4AE">
     				<div class="row justify-content-center mt-3 mb-2">
     					<div class="col-8 text-center">
     						<input type="text" name="firma2" class="form-control text-center">
     						<label for="">Firma</label>
     					</div>
     					
     				</div>
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
    $( "#taller16" ).submit();
  }
})
});

</script>
@endsection

