@extends('layouts.nav')

@section('title', $datos->taller->nombre)
@section('content')

<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->taller->nombre }}</h1>
<h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>
	<form action="{{ route('taller44', ['idtaller' => $d]) }}" method="POST" id="taller44">
    @csrf
		<div class="container">
			<div class="row justify-content-center ">
				@if ($datos->cuenta == 'activo')
				<input type="hidden" name="cuenta" value="activo">
					<div class="col-10">
					<div class="row mb-3">
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area1" name="activos[]" ></textarea></div>
						<div class="col-4 border border-success rounded-circle p-3">
							<p class="text-center">Activo <br> Corriente</p>
						</div>
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area1"  name="activos[]"></textarea></div>
					</div>

					<div class="row mb-3">
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area"  name="activos[]"></textarea></div>
						<div class="col-4 border border-info rounded-circle p-3">
							<p class="text-center">Activo <br>no <br> Corriente</p>
						</div>
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area" name="activos[]" ></textarea></div>
					</div>

					<div class="row justify-content-center">
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area"  name="activos[]"></textarea></div>
					</div>
				</div>

				@elseif ($datos->cuenta == 'pasivo')
				<input type="hidden" name="cuenta" value="pasivo">

					<div class="col-10">
					<div class="row mb-3">
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area1" name="pasivos[]"></textarea></div>
						<div class="col-4 border border-success rounded-circle p-3">
							<p class="text-center">Pasivo <br> Corriente</p>
						</div>
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area1" name="pasivos[]"></textarea></div>
					</div>

					<div class="row mb-3">
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area" name="pasivos[]"></textarea></div>
						<div class="col-4 border border-info rounded-circle p-3">
							<p class="text-center">Pasivo <br>no <br> Corriente</p>
						</div>
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area" name="pasivos[]"></textarea></div>
					</div>

					<div class="row justify-content-center">
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area" name="pasivos[]"></textarea></div>
					</div>
				</div>
				@elseif ($datos->cuenta == 'patrimonio')
				<input type="hidden" name="cuenta" value="patrimonio">
					<div class="col-10">
					<div class="row mb-3">
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area1" name="patrimonio[]"></textarea></div>
						<div class="col-4 border border-success rounded-circle p-3">
							<p class="text-center">Patromonio</p>
						</div>
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area1" name="patrimonio[]"></textarea></div>
					</div>
					<div class="row justify-content-center">
						<div class="col-4 align-self-center"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  class="form-control area" name="patrimonio[]"></textarea></div>
					</div>
				</div>
				@endif
				
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
    $( "#taller44" ).submit();
  }
})
});

</script>
@endsection