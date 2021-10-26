@extends('layouts.nav')
@section('title', $datos->nombre)
@section('content')
<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->nombre }}</h1>
<h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>
<form action="{{ route('taller32', ['idtaller' => $d]) }}" method="POST" id="taller32">
	@csrf
	<div class="container">
		<div class="row ">
			<div class="col-2 gusano1"> <div class=" text-center border bg-light p-4 rounded-circle" style="box-shadow: 5px 5px 15px 0px  #087980;">
				<h6>Abreviaturas
				5
				Económicas
				con la letra
				I</h6>
			</div></div>
			<div class="col-2 gusano2"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaI1" class="form-control  p-4 rounded-circle text-center align-text-bottom"></textarea></div>
			<div class="col-2 gusano3"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaI2"  class="form-control  p-4 rounded-circle text-center align-text-bottom"></textarea></div>
			<div class="col-2 gusano4"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaI3"  class="form-control p-4  rounded-circle text-center align-text-bottom"></textarea></div>
			<div class="col-2 gusano5"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaI4"  class="form-control  p-4 rounded-circle text-center align-text-bottom"></textarea></div>
			<div class="col-2 gusano6"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaI5"  class="form-control  p-4 rounded-circle text-center align-text-bottom"></textarea></div>
			
		</div>
		<div class="row ">
			<div class="col-2 gusano12">
				<div class=" text-center border bg-light p-4 rounded-circle" style="box-shadow: 5px 5px 15px 0px  #087980;">
					<h6>
					Abreviaturas
					Económicas
					5
					con la letra
					C</h6>
				</div>
			</div>
			<div class="col-2 gusano7"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaC1" class="form-control  p-4 rounded-circle text-center align-text-bottom"></textarea> </div>
			<div class="col-2 gusano8"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaC2"  class="form-control  p-4 rounded-circle text-center align-text-bottom"></textarea></div>
			<div class="col-2 gusano9"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaC3"  class="form-control  p-4 rounded-circle text-center align-text-bottom"></textarea></div>
			<div class="col-2 gusano10"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaC4"  class="form-control p-4  rounded-circle text-center align-text-bottom"></textarea></div>
			<div class="col-2 gusano11"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaC5"  class="form-control p-4  rounded-circle text-center align-text-bottom"></textarea></div>
			
		</div>
		<div class="row ">
			<div class="col-2 gusano13"> <div class=" text-center border bg-light p-4 rounded-circle" style="box-shadow: 5px 5px 15px 0px  #087980;">
				<h6>
				Abreviaturas
				Económicas
				con la letra
				R</h6>
			</div></div>
			<div class="col-2 gusano14"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaR1"  class="form-control p-4  rounded-circle text-center align-text-bottom"></textarea></div>
			<div class="col-2 gusano15"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaR2"  class="form-control  p-4 rounded-circle text-center align-text-bottom"></textarea></div>
			<div class="col-2 gusano16"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaR3"  class="form-control  p-4 rounded-circle text-center align-text-bottom"></textarea></div>
			<div class="col-2 gusano17"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaR4"  class="form-control p-4  rounded-circle text-center align-text-bottom"></textarea></div>
			<div class="col-2 gusano18"><textarea style="box-shadow: 5px 5px 15px 0px  #087980;"  name="abreviaturaR5"  class="form-control  p-4 rounded-circle text-center align-text-bottom"></textarea></div>
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
$("#button").click(function( event ) {
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
			$( "#taller32" ).submit();
		}
	})
});
</script>
@endsection