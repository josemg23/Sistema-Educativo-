@extends('layouts.nav')

@section('title', $datos->taller->nombre)
{{-- @section('title','Taller 33') --}}
@section('content')

<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->taller->nombre }}</h1>
<h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>

{{-- <h1 class="text-center  text-danger"> Taller 33</h1>
<h3 class="text-center mt-5 mb-3 text-info">CLASIFIQUE EL COMERCIO CON ORITGINALIDAD</h3> --}}

<form action="{{ route('taller33', ['idtaller' => $d]) }}" method="POST" id="taller33">
           @csrf
	<div class="container">
		<div class="row justify-content-center ">
			<table class="table table-bordered">
			  <thead  class="bg-warning text-center">
			    <tr >
			      <th valign="middle" scope="col">COMERCIO</th>
			     	@foreach ($clasificaciones as $clasificacion)
			      		<th scope="col">{{ $clasificacion->clasificaciones }}</th>
			     	@endforeach
			    </tr>
			  </thead>
			  <tbody>
			    
			    	@foreach ($clasificados as $key => $clasificado)
			    	<tr>
			      		<th scope="row" class="bg-warning">{{$clasificado->clasificados}}</th>
			      		@foreach ($clasificaciones as $k => $clasificacion)
			      			<td><input type="radio" class="custom-checkbok form-control" value="{{ $clasificacion->id }}" name="clasificacion[{{ $key}}]"></td>
			      		@endforeach
			      	</tr>
			    	@endforeach
			      
			  
			   
			  </tbody>
			</table>
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
    $( "#taller33" ).submit();
  }
})
});

</script>
@endsection