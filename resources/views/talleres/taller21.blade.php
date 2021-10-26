@extends('layouts.nav')


@section('title', $datos->taller->nombre)
@section('content')

<!-- LLENE  CON  LOS  SIGUIENTES  DATOS  LOS  VALES,  CORRECTAMENTE. -->
<h1 class="text-center  mt-5 text-danger font-weight-bold display-4">{{ $datos->taller->nombre }}</h1>
     <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }} </h3>
<form action="{{ route('taller21', ['idtaller' => $d]) }}" method="POST" id="taller21">
          @csrf
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-3" style="box-shadow: -5px 5px 15px 0px  #27B8F4">
					<h3 class="text-center">Datos</h3>
					<div class="row">				
						<div class="col-6">
							<label>Valor :</label> <span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->valor }}')" ondragend="this.classList.add('text-muted');">${{ $datos->valor }}</span><br>
							<label>Deudor :</label> <span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->deudor }}')" ondragend="this.classList.add('text-muted');">{{ $datos->deudor }}	</span> <br>
							<label>Detalle :</label> <span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->detalle }}')" ondragend="this.classList.add('text-muted');">{{ $datos->detalle }}</span> <br>
							<label>Lugar y fecha :</label><span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->lugar }}')" ondragend="this.classList.add('text-muted');">{{ $datos->lugar }}</span> , <span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->fecha }}')" ondragend="this.classList.add('text-muted');">{{ $datos->fecha }}</span><br>
						</div>
					</div>
			</div>
			<div class="col-9" style="box-shadow: 5px 5px 15px 0px  #27F4AE">
				<div class="row justify-content-end">
					<div class="col-12 text-center mt-2">
						<h2>VALE DE CAJA</h2>
					</div>
					<div class="col-4 form-inline">
						<label for="">Por $ </label> <input type="number" name="por" class="form-control text-right"  size="20">
					</div>
				</div>
				<div class="row justify-content-center mt-1">
					<div class="col-12">
						<div class="row justify-content-start">
							<div class="col-3"><label for="">A favor de </label> </div>
							<div class="col-9"><input type="text" name="deudor"  class="form-control"></div>
						</div>
						
					</div>
				</div>
				<div class="row justify-content-center mt-1">
					<div class="col-12">
						<div class="row justify-content-start">
							<div class="col-3"><label for="">Por la cantidad de </label> </div>
							<div class="col-9"><input name="cantidad" type="text" class="form-control" ></div>
						</div>
						
					</div>
				</div>
				<div class="row justify-content-center mt-1">
					<div class="col-12">
						<div class="row justify-content-start">
							<div class="col-3"><label for="">A concepto de </label> </div>
							<div class="col-9"><input  name="concepto" type="text" class="form-control"></div>
						</div>
						
					</div>
				</div>
				<div class="row justify-content-end mt-2">
					<div class="col-6 text-center">
						<input type="date" name="fecha" class="form-control" >
						<label for="">Fecha</label>
					</div>
				</div>
				<div class="row justify-content-lg-between">
					<div class="col-4 text-center">
						<input name="vto_bueno" type="text" class="form-control"  >
						<label >Vto. Bno.</label>
					</div>
					<div class="col-4 text-center">
						<input  name="conforme" type="text" class="form-control" >
						<label >Recibi conforme</label>
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
    $( "#taller21" ).submit();
  }
})
});

</script>
@endsection

