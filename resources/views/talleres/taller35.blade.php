@extends('layouts.nav')

@section('title', $datos->nombre)
@section('content')

{{-- >DESARROLLE  FÓRMULAS  DE  LA  ECUACIÓN  CONTABLE,  CON  EXACTITUD. --}}
<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->nombre }}</h1>
<h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>

 <form action="{{ route('taller35', ['idtaller' => $d]) }}" method="POST" id="taller35">
           @csrf
	<div class="container">
		<div class="row justify-content-center ">
			<div class="col-8">

				@foreach (json_decode($taller->datos) as $ecuacion)
					
				<div class="row">
					<div class="col-5 text-center">
						<table class="table " style="box-shadow: 5px 5px 15px 0px  #087980;">
						  <thead>
						    <tr>
							    <th colspan="2" scope="col">
							      Activo <br>
							      @isset ($ecuacion->activo)
							      {{ $ecuacion->activo }}
							          
							      @else
							      	?
							      @endisset
							  	</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						    	<td>
						    		Pasivo <br>
						    		@isset ($ecuacion->pasivo)
							      {{ $ecuacion->pasivo }}
							          
							      @else
							      	?
							      @endisset
						    	</td>
						    	<td>
						    		Patrimonio <br>
						    				@isset ($ecuacion->patrimonio)
							      {{ $ecuacion->patrimonio }}
							          
							      @else
							      	?
							      @endisset
						    	</td>
						    </tr>
						  </tbody>
						</table>
					</div>
					<div class="col-7 text-center  align-self-center">
						<textarea style="box-shadow: 5px 5px 15px 0px  #FF1C87;"  cols="30" rows="3" class="form-control" name="respuesta[]"></textarea>
						{{-- <input style="box-shadow: 5px 5px 15px 0px  #FF1C87;" type="text" name="formula1"   class="form-control"> --}}
					</div>
				</div>

				@endforeach

		

			</div>

		</div>
		 <div class="row justify-content-center mb-3">
        	<input  type="button" id="button" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
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
    $( "#taller35" ).submit();
  }
})
});

</script>
@endsection