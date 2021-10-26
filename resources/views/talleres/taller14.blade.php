@extends('layouts.nav')


@section('title',  $datos->taller->nombre )
@section('content')

<!-- IDENTIFIQUE  LAS  PERSONAS  QUE  INTERVIENEN  EN  EL  CHEQUE,  CON CERTEZA -->
<h1 class="text-center  mt-5 text-danger">{{ $datos->taller->nombre }}</h1>
     <h3 class="text-center mt-5 mb-3 text-info"> {{ $datos->enunciado }} </h3>
<form action="{{ route('taller14', ['idtaller' => $d]) }}" method="POST" id="taller14">
 @csrf
<div class="container p-2" style="box-shadow: 5px 5px 15px 0px  #EB5389">
	<div class="row justify-content-center" >
		<div class="col-8">
			<p class="text-justify font-italic" style="font-size: 20px">{{ $datos->descripcion }} </p>		
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-7">
			<div class="row">
				<div class="col-2">
				@foreach (json_decode($datos->intermediarios)  as $persona)
					<label class="mb-4 form-control-label" for="">{{ $persona }}</label>
				@endforeach
				</div>
				<div class="col-8">
				@foreach (json_decode($datos->intermediarios)  as $persona)
				<input  type="text" name="personas[]" class="form-control mb-2 border-left-0 border-right-0 border-top-0 border-bottom border-success">
				@endforeach
					
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
    $( "#taller14" ).submit();
  }
})
});

</script>
@endsection

