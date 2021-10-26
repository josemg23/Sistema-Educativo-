@extends('layouts.nav')

@section('title', $datos->taller->nombre)
@section('content')

<!--SEÑALE  LA  ALTERNATIVA  CORRECTA -->
<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->taller->nombre }}</h1>
     <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>
      <form action="{{ route('taller5', ['idtaller' => $d]) }}" method="POST" id="taller5">
      	@csrf
	<div class="container">
		<div class="row">
			@foreach ($datos->options as $key => $info)
			<div class="col-12">
				<div class="row bg-secondary border border-danger p-2" style="box-shadow: 3px 6px 5px 4px #64F4F2">
					<div class="col-4 align-self-center">
						<label for="">{{ $info->concepto }} </label>
					</div>
					<div class="col-8">
						<div class="row">
							<div class="col-11">
								<label for="resp" class="form-check-label mb-4">{{ $info->alternativa1 }} 
								</label> <br>				
								<label for="resp2" class="form-check-label">{{ $info->alternativa2 }}
								</label>
							</div>
							<div class="col-1 form-check">
								<input type="radio" id="resp1" value="{{$info->alternativa1 }}" name="respuesta[{{ $key }}]" class="form-control mb-4">
								<input type="radio" id="resp2" value="{{$info->alternativa2 }}" name="respuesta[{{ $key }}]" class="form-control">
							</div>
						</div>
					</div>
				</div>
			</div>
				@endforeach
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
    $( "#taller5" ).submit();
  }
})
});

</script>
@endsection
