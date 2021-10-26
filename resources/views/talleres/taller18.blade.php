@extends('layouts.nav')

@section('title', $datos->taller->nombre)
@section('content')

<!-- LLENE  CON  LOS SIGUIENTES DATOS LAS LETRAS  DE  CAMBIO CORRECTAMENTE -->

<h1 class="text-center  mt-5 text-danger font-weight-bold display-4">{{ $datos->taller->nombre }}</h1>
     <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }} </h3>

<form action="{{ route('taller18', ['idtaller' => $d]) }}" method="POST" id="taller18">
    @csrf
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-2" style="box-shadow: -5px 0px 15px 0px  #27F4AE">
				 <h2>Datos</h2>				 
				  <label for="">Valor</label><br>
                    <p draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->valor }}')" ondragend="this.classList.add('text-muted');">{{ $datos->valor }}</p>
                <label for="">Acreedor</label><br>
                    <p draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->acreedor }}')" ondragend="this.classList.add('text-muted');">{{ $datos->acreedor }}</p>
                <label for="">Deudor</label><br>
                    <p draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->deudor }}')" ondragend="this.classList.add('text-muted');"> {{ $datos->deudor }}</p>
                <label for="">Tasa de interes</label><br>
                    <p draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->tasa_de_interes }}')" ondragend="this.classList.add('text-muted');">{{ $datos->tasa_de_interes }}</p>
                    <label for="">Fecha de Vencimiento</label><br>
                    <p draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->fecha_de_vencimiento }}')" ondragend="this.classList.add('text-muted');">{{ $datos->fecha_de_vencimiento }}</p>
                <label for="">Lugar y Fecha de emision</label>  <br>
                <p draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->lugar }}')" ondragend="this.classList.add('text-muted');"> {{ $datos->lugar }}</p>
                <p>{{ $datos->fecha_de_emision }}</p>
			</div>
			<div class="col-9 p-3" style="box-shadow: 5px 5px 15px 0px  #3A27F4">
				<div class="row mb-2">
					<div class="col-5 mt-3">
						<h2>LETRA DE CAMBIO</h2>
					</div>	
					<div class="col-7 align-self-center">
						<div class="row mb-2">
							<div class="col-3 text-right"><label for="" class="col-form-label">Vence el:</label></div>
							<div class="col-8">
								<input type="date" name="vencimiento" class="form-control text-center" >
							</div>
						</div>
						<div class="row">
							<div class="col-3 text-right">
								<label for="" class="col-form-label">No:</label>
							</div>
							<div class="col-3">
								<input type="number" name="numero" class="form-control" >
							</div>
							<div class="col-5 border border-info p-2">
								<div class="row">
									<div class="col-2">
										<label class="col-form-label" for="">POR:</label>
									</div>
									<div class="col-8">
										<input type="number" name="por" class="form-control text-right" >
									</div>
								</div>
							</div>
						</div>						
					</div>	
				</div>
				<div class="row">
					<div class="col-12 text-center ">
						<div class="row mb-1">
							<div class="col-6">
								<input type="text" name="ciudad" class="form-control" >
							</div>
							<div class="col-6">
								<input type="date" name="fecha" class="form-control" >
							</div>
						</div>				
						<h6>Ciudad y fecha</h6>
					</div>
					<div class="col-12 ">						
							<input type="text" name="orden_de" class="form-control" >								
						<h6>A la orden de</h6>
					</div>
					<div class="col-12 ">						
							<input type="text" name="de" class="form-control" >								
						<h6>De</h6>
					</div>
					<div class="col-12 ">						
							<input type="text" name="cantidad" class="form-control" >								
						<h6>La Cantidad de</h6>
					</div>
					<div class="col-12 form-inline">						
							<p class="col-form-label">Con  el  interés  del <input type="number" name="interes" class="form-control" > por  ciento  anual,   desde <input name="desde" type="text" class="form-control" > Sin protesto.   Exímese  de presentación  para  aceptación  y  pago  así  como  de  avisos  por  falta  de  estos  hechos.</p>
					</div>
					<div class="col-12 ">						
							<div class="row mb-1">
								<div class="col-6">
									<input type="text" name="direccion" class="form-control" >
								</div>
								<div class="col-6">
									<input type="text" name="ciudad2" class="form-control" >
								</div>
							</div>	
							<div class="row mb-1">
							<div class="col-6"><h6>Direccion</h6></div>
							<div class="col-6 text-right"><h6>Ciudad</h6></div>
							</div>	
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-5 text-center">
						<input type="text" name="atentamente" class="form-control" >
						<h1>Atentamente</h1>
					</div>
				</div>
			</div>
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
    $( "#taller18" ).submit();
  }
})
});

</script>
@endsection
