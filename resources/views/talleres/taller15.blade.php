@extends('layouts.nav')
@section('title', $datos->taller->nombre)
@section('content')
<!--CON LOS SIGUIENTES DATOS LLENE EL CHEQUE AL PORTADOR, CON CERTEZA. -->

<h1 class="text-center  mt-5 text-danger font-weight-bold display-4">{{ $datos->taller->nombre }}</h1>
     <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>

<form action="{{ route('taller15', ['idtaller' => $d]) }}" method="POST" id="taller15">
	@csrf
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-2" style="box-shadow: -5px 5px 15px 0px  #FB5EBA">
				<h2>Datos</h2>
				<label for="">Girador</label><br>
					<p style="cursor: move;" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->girador }}')" ondragend="this.classList.add('text-muted');">{{ $datos->girador }}</p>
				<label for="">Girado</label><br>
					<p style="cursor: move;" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->girado }}')" ondragend="this.classList.add('text-muted');">{{ $datos->girado }}</p>

					<label for="">Beneficiario</label><br>
					<p style="cursor: move;" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->beneficiario }}')" ondragend="this.classList.add('text-muted');">{{ $datos->beneficiario }}</p>

				<label for="">Cantidad</label><br>
					<p style="cursor: move;" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->cantidad }}')" ondragend="this.classList.add('text-muted');">{{ $datos->cantidad }}</p>
				<label for="">Lugar y Fecha</label>	<br>
				<p style="cursor: move;" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->lugar }}')" ondragend="this.classList.add('text-muted');">{{ $datos->lugar }}</p>
				<p>{{ $datos->fecha }}</p>
			</div>
			<div class="col-9 border p-2" style="box-shadow: 5px 5px 15px 0px  #27B8F4">
				<div class="row ">
					<div class="col-6">
						<input type="text" name="girador" class="form-control mt-2" >
					</div>	
					<div class="col-2 align-self-center">
						<p>16457 <br>
							152
						</p>
					</div>	
				</div>
				<div class="row">
					<div class="col-2">
						<label class="text-capitalize"  for="">PAGUESE A LA ORDEN DE:</label>
						
					</div>
					<div class="col-8">
						<input type="text" name="girado" class="form-control" >
					</div>
					<div class="col-2">
						<label for="">
							CHEQUE 0145
						</label><br>
						<div class="row">
							<div class="col-2"><label for="">
							US
						</label></div>
							<div class="col-8"><input type="number" name="cantidad" class="form-control" size="2" ></div>
						</div>
						
					</div>

				</div>
				<div class="row mb-2">
					<div class="col-2">
						<label for="">LA SUMA DE</label>
					</div>
					<div class="col-8">
						<input type="text" name="suma" class="form-control" > 
					</div>
					<div class="col-2">
						DOLARES
					</div>
				</div>
				<div class="row">
					<div class="col-6 align-self-start pb-5">
						<div class="row">
							<div class="col-6"><input name="lugar" class="form-control" type="text" ></div>
							<div class="col-6"><input name="fecha" class="form-control" type="date" ></div>
						</div>
							<div class="row">
							<div class="col-6"> <label for="">CIUDAD</label> </div>
							<div class="col-6 text-center"> <label for="">FECHA</label> </div>
						</div>
					</div>
					<div class="col-6 col align-self-end text-center">
						<input name="firma" class="form-control" type="text" >
						<label class="" for="">FIRMA</label>
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
    $( "#taller15" ).submit();
  }
})
});

</script>
@endsection
