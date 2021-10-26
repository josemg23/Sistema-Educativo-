@extends('layouts.nav')

@section('title', $datos->taller->nombre)
@section('content')

<h1 class="text-center  mt-5 text-danger"> {{ $datos->taller->nombre }}</h1>
     <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>

<form id="taller10" action="{{ route('taller10', ['idtaller' => $d]) }}" method="POST">
    @csrf
	<div class="container">
		@if (session('datos'))
    <div class="alert alert-danger">
        {{ session('datos') }}
    </div>
@endif
		@foreach ($datos->relacionarOptions as $key => $opciones)
		<div class="row justify-content-center align-items-center mb-5">
			<div class="col-5 text-justify">
				
     				<label class="form-control-label"><span draggable="true" ondragstart="event.dataTransfer.setData('text/plain',{{ $opciones->orden }});" class="badge-danger badge-pill"> {{ $opciones->orden }} </span> {{ $opciones->definicion_aleatoria }}</label>
			</div>
			<div class="col-5">
				<div class="row align-items-center">
					<div class="col-6 text-center">
						<img width="150" src="{{ asset($opciones->img) }}">
					</div>
					<div class="col-6 text-center ">
						<label for="">{{ $opciones->enunciado }}</label><br>
						<input type="number"  size="2" name="order[]" class="ml-5 font-weight-bold text-center form-control consul form-control-sm" style="outline: none; background-color: #94F0E4; box-shadow: 5px 5px 15px 0px  #18DEF0; width: 100px" >
					</div>
				</div>
			</div>
		</div>
		@endforeach
		 <div class="row justify-content-center mb-3">
                  <input type="button" id="button" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
               </div>

	</div>


</form>
@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
$('.consul').on("input", function() {
  var dInput = this.value;
  
  console.log(dInput)
  // $('#output').text(dInput);
});
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
    $( "#taller10" ).submit();
  }
})
});

</script>
@endsection
