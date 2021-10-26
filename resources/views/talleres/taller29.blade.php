@extends('layouts.nav')

@section('title',  $datos->nombre )
@section('content')

	<h1 class="text-center  mt-5 text-danger display-4 font-weight-bold"> {{ $datos->nombre }}</h1>
    <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>

  <form action="{{ route('taller29', ['idtaller' => $d]) }}" method="POST" id="taller29">
           @csrf
	<div class="container mb-4">
		<div class="row justify-content-center">
			<div class="col-8 p-3" style="box-shadow: 5px 5px 15px 0px  #E81853;">
				<ul class="nav justify-content-center">
<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Cheque'); " class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Cheque</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Cuenta')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Cuenta</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Factura')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Factura</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Artículos')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Artículos</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Doctora')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Doctora</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Factura')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Factura</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Presente')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Presente</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Economista')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Economista</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Factura')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Factura</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Cuenta corriente')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Cuenta corriente</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Ustedes')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Ustedes</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Banco')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Banco</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Remesa')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Remesa</li>

<li draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Compañía')" class="badge badge-primary nav-item m-2 text-wrap" ondragend="this.classList.remove('badge', 'badge-primary'); this.classList.add('badge'); " style="cursor: move;">Compañía</li>
				</ul>
				
			</div>
			<div class="col-7  mt-3" style="box-shadow: 5px 5px 15px 0px  #800846;">
				<div class="row p-2">
					<div class="col-4">
						<img class="img-fluid" src="{{ asset('img/talleres/imagen-29.jpg') }}" alt="">
					</div>
					<div class="col-5 text-center">
						<h1 class="text-danger"><strong>COMUNICADO</strong></h1>
						<h5>“IMPORTADORA GARY S.A.”</h5>
						<h5>TELF: 2415287 - 2425689</h5>
					</div>
					<div class="col-6">
						<p>Guayaquil, 25 de Octubre del 201</p>
						<p>
							Doctora  <br>
							Carolina Robles <br>
							Gerente de "COMERCIAL XAVI” <br>
							Ciudad.
						</p>
					</div>
					<div class="col-12 form-inline">
						<p>Estimada <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura1" class="form-control"></p>
						
					</div>
					<div class="col-12 form-inline">
						<p class="text-justify">Es grato enviarle la <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura2"  class="form-control"> o. 124 correspondiente  a cuatro  bultos  de mercaderías  que  hemos  enviado  por  vía terrestre, utilizando transportes ECUADOR, el 3 de Mayo del <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura3"  class="form-control" size="5"> año</p>
					</div>

					<div class="col-12 form-inline">
						<p class="text-justify">
							Esta <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura4"  class="form-control"> contiene <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura5"  class="form-control m-1" size="7"> con  las  características señaladas  por <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura6"  class="form-control m-1" size="7"> a  nuestra <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura7"  class="form-control m-1" size="7">
						</p>
					</div>
					<div class="col-12 form-inline">
						<p class="text-justify">
							El  valor  de  la <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura8"  class="form-control m-1" size="7"> asciende  a  la  cantidad  de $ 8.500; la hemos cargado a su <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura9"  class="form-control m-1" size="7"> rogando nos envíe  un <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura10"  class="form-control m-1" size="4"> certificado  por  dicho  valor.
						</p>
					</div>
					<div class="col-12 form-inline">
						<p class="text-justify">
							De  no  ser  posible  esperamos  que  el  valor  de  la <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura11"  class="form-control m-1" size="7"> lo  deposite  en  nuestra <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura12"  class="form-control m-1" size="7"> <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura13"  class="form-control m-1" size="7"> del <input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;"  type="text" name="abreviatura14"  class="form-control m-1" size="7">  Produbanco  No. 40035873.
						</p>
					</div>
					<div class="col-12">
						<p class="text-justify">
							Sin  otro  particular  por  el  momento  aprovechamos  la oportunidad  para  reiterarles  nuestras  consideraciones  y aprecio.
						</p>
					</div>
					<div class="col-5 text-center">
						<h4>Cordialmente,</h4>
						<p>Diana  Flores <br>
						Gerente General</p>
					</div>
				</div>
			</div>
		</div>
		 <div class="row justify-content-center mb-3">
        	<input style="box-shadow: 5px 5px 15px 0px  #5EE1E9;" type="button" id="button" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
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
    $( "#taller29" ).submit();
  }
})
});

</script>
@endsection