@extends('layouts.nav')

@section('title', $datos->taller->nombre)
@section('content')
@section('css')
<style type="text/css">

.text {
 /* width:500px;*/
    overflow:hidden;
    background-color:#FFF;
    color:#222;
    font-family:Courier, monospace;
    font-weight:normal;
    font-size:24px;
    resize:none;
    line-height:40px;
    padding-left:100px;
    padding-right:100px;
    padding-top:45px;
    padding-bottom:34px;
    background-image:url(https://static.tumblr.com/maopbtg/E9Bmgtoht/lines.png), url(https://static.tumblr.com/maopbtg/nBUmgtogx/paper.png);
    background-repeat: repeat;
    -webkit-border-radius:12px;
    border-radius:12px;
    -webkit-box-shadow: 0px 2px 14px #000;
    box-shadow: 0px 2px 14px #000;
    border-top:1px solid #FFF;
    border-bottom:1px solid #FFF;
}

</style>
@endsection
<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->taller->nombre }}</h1>
<h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>

<form action="{{ route('taller36', ['idtaller' => $d]) }}" method="POST" id="taller36">
           @csrf
	<div class="container">
		<div class="row justify-content-center ">
			@foreach ($datos->tallerAnalizarOp as $enunciados)
				<div class="col-10 mb-3">
					<h2> <strong>{{ ++$a }} </strong> {{ $enunciados->enunciado }} </h2>
					<textarea  name="analisis[]" cols="20" rows="10" class="form-control text"></textarea>
				</div>
			@endforeach
		</div>
		 <div class="row justify-content-center mb-3">
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
    $( "#taller36" ).submit();
  }
})
});

</script>
@endsection