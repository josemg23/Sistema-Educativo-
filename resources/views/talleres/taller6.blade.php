@extends('layouts.nav')
@section('title', 'Taller '.$datos->taller->id)
@section('content')
<!--TALLER IDENTIFICAR IMAGENES -->

<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> Taller {{ $datos->taller->id }}</h1>
     <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>

<form action="{{ route('taller6',['idtaller' => $d]) }}" method="POST" id="taller6">
    @csrf	
    <div class="container">
		<div class="row justify-content-center">
			@foreach ($datos->tallerimg as $element)
				<div class="col-6">
				<div class="row justify-content-center mb-3">
					<div class="col-4">
						<img style="border: double 5px #17D6E2; box-shadow: 3px 3px 3px 3px #28BEE4" src="{{ asset($element->col_a) }}" width="200" alt="Imagen 1">
					</div>
					<div class="col-4 align-self-center" >
						<input type="checkbox" name="imgs[]" value="{{ $element->col_a }}" class="form-control">
					</div>
				</div>

				<div class="row justify-content-center mb-3">
					<div class="col-4">
						<img style="border: double 5px #17D6E2; box-shadow: 3px 3px 3px 3px #28BEE4" src="{{ asset($element->col_b) }}" width="200" alt="Imagen 1">
					</div>
					<div class="col-4 align-self-center" >
						<input type="checkbox" name="imgs[]" value="{{ $element->col_b }}" class="form-control">
					</div>
				</div>
			</div>
			@endforeach
		</div>
		 <div class="row justify-content-center mb-4">
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
    $( "#taller6" ).submit();
  }
})
});

</script>
@endsection
