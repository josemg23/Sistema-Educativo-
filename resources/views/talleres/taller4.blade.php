@extends('layouts.nav')
<!--TALLER PARA ESCRIBIR DIFERENCIAS -->
@section('title', $datos->taller->nombre)
@section('content')
@section('css')
<style type="text/css">
	:focus{outline: none;}

/* necessary to give position: relative to parent. */
input[type="text"]{font: 15px/24px 'Muli', sans-serif; color: #333; width: 100%; box-sizing: border-box; letter-spacing: 1px;}

:focus{outline: none;}

.col-3{float: left; width: 27.33%; margin: 40px 3%; position: relative;} /* necessary to give position: relative to parent. */
input[type="text"]{font: 15px/24px "Lato", Arial, sans-serif; color: #333; width: 100%; box-sizing: border-box; letter-spacing: 1px; box-shadow: 5px 6px 5px #AAE1E9}
.effect-1, 
.effect-2, 
.effect-3{border: 0; padding: 7px 0; border-bottom: 1px solid #ccc;}

.effect-1 ~ .focus-border{position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background-color: #4caf50; transition: 0.4s;}
.effect-1:focus ~ .focus-border{width: 100%; transition: 0.4s;}

</style>
@endsection

<h1 class="text-center  mt-5 text-danger font-weight-bold display-4">{{ $datos->taller->nombre }}</h1>
     <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>


<form action="{{ route('taller4',['idtaller' => $d]) }}" method="POST" id="taller4">
    @csrf
	<div class="container">
		<div class="row">
			<div class="col-6 border-right border-info ">
				<div class="row justify-content-center">
					@isset ($datos->img1)
					<div class="col-8">
					<img class="mt-3 img-fluid" style="border: solid 4px #2182FB;" width="400" src="{{ asset($datos->img1) }}" alt="">
					</div>

					@endisset

					@isset ($datos->descripcion1)
					<div class="col-11 text-center badge-primary mt-2 p-2" style="font-size: 30px;">
						<p>{{ $datos->descripcion1 }} </p>
						
					</div>
					   
					@endisset
				</div>
				<div class="row">
					<div class="col-12 mt-4">
						 <input class="effect-1" type="text" name="diferencia_1a" autocomplete="ÑÖcompletes">
              			<span class="focus-border"></span>
					</div>
						<div class="col-12 mt-4">
						 <input class="effect-1" type="text" name="diferencia_2a" autocomplete="ÑÖcompletes">
              			<span class="focus-border"></span>
					</div>
						<div class="col-12 mt-4">
						 <input class="effect-1" type="text" name="diferencia_3a" autocomplete="ÑÖcompletes">
              			<span class="focus-border"></span>
					</div>
						{{-- <input  class="form-control mb-3 mt-3" name="diferencia_1a" type="text">
				       <input  class="form-control mb-3" name="diferencia_2a" type="text">
				      <input  class="form-control mb-3" name="diferencia_3a" type="text"> --}}

					
				</div>
			</div>
			<div class="col-6">
				<div class="row justify-content-center">
					@isset ($datos->img2)
					<div class="col-8">
					<img class="mt-3 img-fluid" style="border: solid 4px #2182FB;" width="400" src="{{ asset($datos->img2) }}" alt="">
					</div>

					@endisset
					@isset ($datos->descripcion2)
					<div class="col-11 text-center badge-success mt-2 p-2" style="font-size: 30px;">
						<p>{{ $datos->descripcion2 }} </p>
						
					</div>
					   
					@endisset
				</div>
				<div class="row">
								<div class="col-12 mt-4">
						 <input class="effect-1" type="text" name="diferencia_1b" autocomplete="ÑÖcompletes">
              			<span class="focus-border"></span>
					</div>
						<div class="col-12 mt-4">
						 <input class="effect-1" type="text" name="diferencia_2b" autocomplete="ÑÖcompletes">
              			<span class="focus-border"></span>
					</div>
						<div class="col-12 mt-4">
						 <input class="effect-1" type="text" name="diferencia_3b" autocomplete="ÑÖcompletes">
              			<span class="focus-border"></span>
					</div>
					{{-- <div class="col">
						<input  class="form-control mb-3 mt-3" name="diferencia_1b" type="text">
				       <input  class="form-control mb-3" name="diferencia_2b" type="text">
				      <input  class="form-control mb-3" name="diferencia_3b" type="text">

					</div> --}}
				</div>

			</div>
		</div>
		<div class="row justify-content-center mb-2">
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
    $( "#taller4" ).submit();
  }
})
});

</script>
@endsection
