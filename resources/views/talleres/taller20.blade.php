@extends('layouts.nav')
@section('title', $datos->taller->nombre)
@section('content')
<!-- LLENE  CON  LOS  SIGUIENTES  DATOS  EL  PAGARÉ  CORRECTAMENTE -->
<h1 class="text-center  mt-5 text-danger font-weight-bold display-4">{{ $datos->taller->nombre }}</h1>
<h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }} </h3>
<form action="{{ route('taller20', ['idtaller' => $d]) }}" method="POST" class="mb-3" id="taller20">
	@csrf
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-10 align-self-center">
				<h3 class="text-center">Datos</h3>
				<div class="row">
					<div class="col-6">
						<label>Beneficiario : </label>
						<span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->beneficiario }}')" ondragend="this.classList.add('text-muted');">
							{{ $datos->beneficiario }}
						</span>
						<br>
						<label>Deudor :  </label>
						<span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->deudor }}')" ondragend="this.classList.add('text-muted');">
							{{ $datos->deudor }}
						</span>
						<br>
						<label>Garante :</label>
						<span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->garante }}')" ondragend="this.classList.add('text-muted');">
							{{ $datos->garante }}
						</span>
					</div>
					<div class="col-6">
						<label>Valor :</label>
						<span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->valor }}')" ondragend="this.classList.add('text-muted');">
							{{ $datos->valor }}
						</span>
						<br>
						<label>Plazo de Pago :</label>
						<span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->plazo_pago }}')" ondragend="this.classList.add('text-muted');">
							{{ $datos->plazo_pago }}
						</span><br>
						<label>Taza de interes :</label>
						<span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->tasa_interes }}')" ondragend="this.classList.add('text-muted');">
							{{ $datos->tasa_interes}}%
						</span>
					</div>
					<div class="col-12">
						<label>Lugar y fecha de emision :</label>
						<span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->lugar }}, {{ $datos->fecha_emision }}')" ondragend="this.classList.add('text-muted');">
							{{ $datos->lugar }}, {{ $datos->fecha_emision }}
						</span>
						<br>
						<label>Fecha de vencimiento :</label>
						<span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->fecha_de_vencimiento }}')" ondragend="this.classList.add('text-muted');">
							{{ $datos->fecha_de_vencimiento }}
						</span>
						<br>
					</div>
				</div>
			</div>
			<div class="col-10" style="box-shadow: 5px 5px 15px 0px  #27F4AE">
				<div class="row justify-content-center">
					<div class="col-10 p-2  ">
						<div class="row justify-content-center">
							<div class="col-4">
								<img class="img-fluid" src="{{ asset('img/talleres/imagen-19.jpg') }}" alt="">
							</div>
						</div>
						<div class="row justify-content-around">
							<div class="col-5">
								<span class="border border-right-0 border-left-0 border-success">No. 1</span>
							</div>
							<div class="col-4 form-inline">
								<label for="">Por $<input    name="cantidad" type="number" class="form-control text-right"></label>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<p class="form-inline text-justify">
									Deb <input    name="resp1" type="text" class="form-control m-1" size="1"> y pagar <input    name="resp2" type="text" class="form-control m-1" size="2"> de la fecha en <input    name="resp3" type="text" class="form-control m-1" size="5"> fijos en esta ciudad o en el lugar en que<input    name="resp4" type="text" class="form-control m-1" size="5"> reconvenga a la orden de <input    name="resp5" type="text" class="form-control m-1" size="60"> la cantidad de <input    name="resp6" type="text" class="form-control m-1" size="60"> por igual valor que ten <input    type="text" name="resp7" class="form-control m-1" size="1"> recibido, en calidad de préstamo y en dinero efectivo para destinarlo a negocios de comercio; esta cantidad  <input    type="text" name="resp8" class="form-control m-1" size="1"> obli <input    type="text" name="resp9" class="form-control m-1" size="1">a devolveria al vencimiento del plazo expresado, enmonedas de este curso legal.
								</p>
								<p class="form-inline text-justify">
									Tambien <input    type="text" name="resp10" class="form-control m-1" size="1"> oblig <input    type="text" name="resp11" class="form-control m-1" size="1"> a pagar el interes del <input    type="text" name="resp12" class="form-control m-1" size="1"> por ciento anual desde el vencimiento hasta la completa cancelacion y en el caso de mora, a pagar todos los gastos judiciales y extrajudiciales que ocasione el cobro, bastando para terminar el montode tales gastos la sola afirmacion del agreedor.</p>
									<p class="form-inline text-justify">
										Al fiel cumplimiento de lo acordado <input    type="text" name="resp13" class="form-control m-1" size="1"> oblig <input    type="text" name="resp14" class="form-control m-1" size="1"> con todos v bienes presentes y futuros, y ademas, renunci<input    type="text" name="resp15" class="form-control m-1" size="1"> domicilio y toda ley o excepcion que pudiera favorecer <input    type="text" name="resp16" class="form-control m-1" size="1"> en jucio o fuera de el.
									</p>
									<p class="form-inline text-justify">
										Renuncia <input    type="text" name="resp17" class="form-control m-1" size="1"> tambien al derecho de interponer el recurso de apelacion y el de hecho de las providencias que se expidieron en el juicio a que diere lugar, estipul <input    type="text" name="resp18" class="form-control m-1" size="1"> expresamente que el tenedor no podra ser obligado a recibir el pago por partes ni aun por <input    type="text" name="resp19" class="form-control m-1" size="1"> herederos o sucesores, sin protesto
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<label for="">Ciudad</label><input    class="form-control" name="resp20" type="text">
								</div>
								<div class="col-6">
									<label for="">Fecha Vencimiento</label><input   class="form-control" name="fecha_vencimiento" type="text">
									
								</div>
								
							</div>
							<div class="row justify-content-end mt-3">
								<div class="col-10">
									<p class="form-inline text-justify">Me <input    class="form-control mb-1 ml-1 mr-1" size="1" name="resp21" type="text">  constituy <input  size="1"   class="form-control mb-1 ml-1 mr-1" name="resp22" type="text"> fiador <input   size="1"  class="form-control mb-1 ml-1 mr-1" name="resp23" type="text">  llano <input   size="1"  class="form-control mb-1 ml-1 mr-1" name="resp23" type="text"> pagador <input    class="form-control mb-1 ml-1 mr-1" size="1" name="resp24" type="text"> de <input    class="form-control mb-1 ml-1 mr-1" size="1" name="resp25" type="text">  señor <input    class="form-control mb-1 ml-1 mr-1" size="15" name="resp26" type="text"> por las obligaciones que he  <input    class="form-control mb-1 ml-1 mr-1" size="1" name="resp27" type="text">  ontraído en el pagaré anterior haciendo de deuda ajena deuda propia renunciando  los beneficios de orden y de excusión de bienes de <input    class="form-control mb-1 ml-1 mr-1" size="1" name="resp28" type="text"> deudor <input    class="form-control mb-1 ml-1 mr-1" size="1" name="resp29" type="text"> principal  <input    class="form-control mb-1 ml-1 mr-1" size="1" name="resp30" type="text"> el de división y cualquier ley, excepción o derecho que pueda favorecer <input    class="form-control mb-1 ml-1 mr-1" size="1" name="resp31" type="text"> así como la apelación y el recurso de hecho.  Quedo sometido a los jueces de  Provincia o de la que elija el acreedor. Sin protesto.</p>
								</div>
							</div>
							<div class="row">
								<div class="col-6 ">
									<div class="form-group">
										<label >FECHA UT SUPRA <br>DEUDOR(ES)</label>
										<input type="text" name="resp32" class="form-control" >
									</div>
								</div>
								<div class="col-6 mt-4">
									<div class="form-group">
										<label >GARANTE(ES)</label>
										<input type="text" name="resp33" class="form-control">
									</div>
								</div>
									<div class="col-6 ">
									<div class="form-group">
										<input type="text" name="resp34" class="form-control form-control-sm" placeholder="CI">
									</div>
								</div>
									<div class="col-6 ">
									<div class="form-group">
										<input type="text" name="resp35" class="form-control form-control-sm" placeholder="CI">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<input    type="button"  id="button" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
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
    $( "#taller20" ).submit();
  }
})
});

</script>
@endsection
