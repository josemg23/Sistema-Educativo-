@extends('layouts.nav')

@section('title',  $datos->nombre )
@section('content')

	<h1 class="text-center  mt-5 text-danger font-weight-bold display-4">{{ $datos->nombre }}</h1>
	<h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>
  <form action="{{ route('taller41', ['idtaller' => $d]) }}" method="POST" id="taller41">
           @csrf
	<div class="container mb-5">
		<div class="row justify-content-center mb-2">
			<div class="col-10">
				<div class="row justify-content-center">
					<div class="col-6  align-self-center">
						<h4  class="text-center bg-success p-2 rounded">FORMAS DE TRANSACCIONES</h4 >
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-4 align-self-center">
						<h5 class="bg-warning border border-secondary p-1 rounded text-center">VENDER</h5>
						<input  type="text" class="form-control" name="vender">
					</div>
					<div class="col-4 text-center">
						<img class="img-fluid" src="{{ asset('img/talleres/imagen-32.jpg') }}" alt="">
					</div>
					<div class="col-4 align-self-center">
						<h5 class="bg-warning border border-secondary p-1 rounded text-center">COMPRAR</h5>
						<input  type="text" class="form-control" name="comprar">
					</div>
				</div>

				<div class="row justify-content-lg-between">
					<div class="col-3 align-self-center text-center p-3" style="box-shadow: 5px 5px 15px 0px  #087980;">
						<h5>1</h5>
						<input  type="text" class="form-control" name="seccion1a">
						<img class="img-fluid mb-1 mt-1 " src="{{ asset('img/talleres/img-1.jpg') }}" alt="">
						<input  type="text" class="form-control" name="seccion1b">
					</div>
					<div class="col-3 align-self-center text-center p-3" style="box-shadow: 5px 5px 15px 0px  #087980;">
						<h5>2</h5>

						<input  type="text" class="form-control" name="seccion2a">
						<img class="img-fluid mb-1 mt-1 " src="{{ asset('img/talleres/img-2.jpg') }}" alt="">
						<input  type="text" class="form-control" name="seccion2b">
					</div>
					<div class="col-3 align-self-center text-center p-3" style="box-shadow: 5px 5px 15px 0px  #087980;">
						<h5>3</h5>

						<input  type="text" class="form-control" name="seccion3a">
						<img class="img-fluid mb-1 mt-1 " src="{{ asset('img/talleres/img-3.jpg') }}" alt="">
						<input  type="text" class="form-control" name="seccion3b">
					</div>
				</div>
		
				
			</div>
		</div>
		 <div class="row justify-content-center">
        	<input  type="button" id="button" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
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
    $( "#taller41" ).submit();
  }
})
});

</script>
@endsection