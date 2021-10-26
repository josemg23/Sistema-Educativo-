@extends('layouts.nav')

@section('title', $datos->taller->nombre)
@section('content')
<!-- LLENE  CON  LOS  SIGUIENTES  DATOS  LOS  CERTIFICADOS DE DEPÓSITO 
ADECUADAMENTE -->
	<h1 class="text-center  mt-5 text-danger font-weight-bold display-4">{{ $datos->taller->nombre }}</h1>
    <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }} </h3>

<form action="{{ route('taller19', ['idtaller' => $d]) }}" method="POST" id="taller19">
	@csrf
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-10 align-content-center">
				<h3 class="text-center">Datos</h3>
					<div class="row">
						<div class="col-6">
							<label>Valor :  </label> 
							<span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->valor }}')" ondragend="this.classList.add('text-muted');">
								{{ $datos->valor }}
							</span>  <br>
							<label>Beneficiario : </label>
							<span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->beneficiario }}')" ondragend="this.classList.add('text-muted');">
								{{ $datos->beneficiario }}
							</span>   <br>
					 		<label>Interes Anual :</label> <span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->interes_anual }}')" ondragend="this.classList.add('text-muted');">
					 			{{ $datos->interes_anual }} 
					 		</span>
						</div>					
						<div class="col-6">
							<label>Lugar y Fecha de Emision :</label>
							 <span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->lugar }}, {{ $datos->fecha_de_emision }}')" ondragend="this.classList.add('text-muted');">
							 	{{ $datos->lugar }}, {{ $datos->fecha_de_emision }} <br>
							 </span> 
			
							<label>Plazo Vencimiento :</label>
							<span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->plazo_de_vencimiento }}')" ondragend="this.classList.add('text-muted');">
								{{ $datos->plazo_de_vencimiento }}
							</span>  <br>
					 		<label>Fecha de  Vencimiento :</label>
					 			<span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->fecha_de_vencimiento }}')" ondragend="this.classList.add('text-muted');">
					 				{{ $datos->fecha_de_vencimiento }}
					 			</span> 
						</div>
					</div>
			</div>
			<div class="col-10" style="box-shadow: 5px 5px 15px 0px  #C6F427">
				<div class="row justify-content-center">
						<div class="col-10 p-2  ">
							<div class="row">
								<div class="col-4">
									<h2>NO 017</h2>
								</div>
								<div class="col-4 text-center mt-2">
								<strong><h5 class="text-danger">CERTIFICADO DE DEPOSITO</h5></strong>	
								</div>
								<div class="col-4">
									<h5>BANCO DE MACHALA</h5>
								</div>
							</div>
							<div class="row p-1">
								<div class="col-6 form-inline">
									<p class="col-form-label" for="">Valor incial <input   type="number" name="valor_inicial" class="form-control"></p> 
								</div>
								<div class="col-6 form-inline" >
									<p class="col-form-label" for="">CARACTER <input   type="text" class="form-control" name="caracter">
										<h6 class="text-center">(Nominativa o a la orden )</h6>
									</p>
									
								</div>
							</div>
							<div class="row">
								<p class="form-inline text-justify">En  virtud  de  la  Facultad  contenida  en  el  numeral  séptimo  del  artículo  215  de  la  Ley  General  de Banco,  el  BANCO DE MACHALA,  emite  el  presente  Certificado  de  Depósito  y  reconoce  que  pagará contra presentacion de este titulo a <input   type="text" name="beneficiario" class="form-control m-1" size="60">, cantidad de: <input   type="number" name="cantidad" class="form-control m-1"> Dolares en el plazo de <input   type="text" name="plazo" class="form-control m-1" size="3"> dias, a partir de <input   type="date" size="10" name="fecha_de_emision" class="form-control m-1"> hasta el <input   type="date" name="fecha_de_vencimiento" size="10" class="form-control m-1"> reconocimiento el interes actual del <input   type="text" name="interes_anual" class="form-control m-1" size="3" name=""> que  será  pagadero  en <input   name="plazo_de_vencimiento" type="text" class="form-control m-1" size="2"> dias
								</p>
								<p class="text-justify">El  Banco de Machala  declara  que  éste  Certificado de  Depósito  no es renovable  y  que dejará  de ganar  interés desde  la  fecha  de  su  vencimiento.
								El  propietario  de  este título  acepta  las condiciones estipuladas y se somete a lo  dispuesto  en  la  Ley General  de  Bancos  y  a  la  Resolución  No.  90-020  de la Superintendencia  de  Bancos  y  sus posteriores  modificatorias.</p>
							</div>
							<div class="row justify-content-end">
								<div class="col-8 text-center">
									<input   type="text" name="lugar_fecha_emision" class="form-control">
									<h6 for="">Lugar y fecha de emision</h6>
								</div>
							</div>
							<div class="row justify-content-between">
								<div class="col-5 text-center">
									<input   type="text" class="form-control text-center" value="ING. JUAN PEREZ" disabled="" >
									<h6>FIRMA AUTORIZADA</h6>
								</div>
								<div class="col-5 text-center">
									<input   type="text" class="form-control text-center" value="ING. JOSE MAYA" disabled="" >
									<h6>FIRMA AUTORIZADA</h6>
								</div>
							</div>
						</div>					
				</div>
			</div>
		</div>
		<div class="row justify-content-center mb-4">
        	<input   type="button" id="button" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
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
    $( "#taller19" ).submit();
  }
})
});

</script>
@endsection
