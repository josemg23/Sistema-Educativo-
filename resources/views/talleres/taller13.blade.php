@extends('layouts.nav')

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
    line-height:25px;
    padding-left:50px;
    padding-right:50px;
    padding-top:20px;
    padding-bottom:15px;
    background-image:/*url(https://static.tumblr.com/maopbtg/E9Bmgtoht/lines.png),*/ url(https://static.tumblr.com/maopbtg/nBUmgtogx/paper.png);
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


@section('title', $datos->taller->nombre)
@section('content')
<!-- DEFINA  LOS  ENUNCIADOS  EN  LOS  CUADROS,  CON  ORIGINALIDAD. -->

<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->taller->nombre }}</h1>
     <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado}} </h3>

<form action="{{ route('taller13', ['idtaller' => $d]) }}" method="POST" id="taller13">
@csrf
<div class="container">
	<div class="row justify-content-center border p-2 bg-light"  style="box-shadow: 5px 5px 15px 0px  #18DEF0">
		<div class="col-10">
			<div class="row justify-content-between">
				@foreach ($datos->tallerDefinirEnunOp as $element)
					<div class="col-5  mb-4" style="box-shadow: 5px 5px 15px 0px  #EB5389">
						<h2 class="text-center mt-1 mb-3"> {{ $element->concepto }} </h2>
						<textarea name="respuestas[]"  class="form-control mb-2 text" id="" cols="30" rows="8"></textarea>
					</div>
				@endforeach
			</div>
		</div>
		
	</div>
	    <div class="row justify-content-center mb-4">
        	<input type="button" id="button" value="Enviar Respuestas" class="btn p-2 mt-3 btn-danger">
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
    $( "#taller13" ).submit();
  }
})
});

</script>
@endsection

