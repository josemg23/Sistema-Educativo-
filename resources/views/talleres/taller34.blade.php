@extends('layouts.nav')

@section('title', 'Taller 38')
@section('content')

{{-- LUEGO  DE  REALIZAR  LOS  EJERCICIOS,  DETERMINE  EL  TIPO  DE  SALDO CON  EXACTITUD.  --}}
<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->nombre }}</h1>
<h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>

<form action="{{ route('taller34', ['idtaller' => $d]) }}" method="POST" id="taller34">
           @csrf
	<div class="container">
		<div class="row justify-content-center ">
			
				<div class="col-12">
				@foreach ($datos->tallerTipoSaldo as $tipos)
					<div class="row">
						<div class="col-8">
							<table class="table">
							  <thead>
							    <tr>
							      <th colspan="10" scope="col">DEBE</th>
							      <th colspan="10" class="text-right"  scope="col">HABER</th>
							    </tr>
							  </thead>
							  <tbody>
							 <tr>
							 	<td class="border-left-0 border-bottom-0 border-top-0 border" colspan="10">
							 		<div class="row">
							 			<div class="col-6">
							 			@foreach ($tipos->saldoDebe as $debe)
							 				<h6>{{ $debe->nom_cuenta }}</h6>
							 			@endforeach
							 				<h4>TOTAL</h4>
							 			</div>
							 			<div class="col-6 ">
							 			@foreach ($tipos->saldoDebe as $debesaldo)
							 				<h6  class="text-right">{{ $debesaldo->saldo }}</h6>
							 			@endforeach
							 			<input type="number" class="form-control form-control-sm text-right" name="total_debe[]">
							 				{{-- <h6 >$ 2.100</h6>
							 				<h6 class="border-left-0 border-right-0 border-top-0 border border-danger">$ 900</h6> --}}

							 			</div>
							 		</div>
							 	</td>
							 	<td colspan="10">
							 		<div class="row">
							 			<div class="col-6">
							 			@foreach ($tipos->saldoHaber as $haber)
							 				<h6>{{ $haber->nom_cuenta }}</h6>
							 			@endforeach
							 				<h4>TOTAL</h4>
							 			</div>
							 			<div class="col-6">
							 			@foreach ($tipos->saldoHaber as $saldo)
							 				<h6 class="text-right">{{ $saldo->saldo }}</h6>
							 			@endforeach
							 			<input type="number" class="form-control form-control-sm text-right" name="total_haber[]">

							 				{{-- <h6 class="mb-4">$ 2.100</h6>
							 				<h6 class="border-left-0 border-right-0 border-top-0 border border-danger">$ 900</h6> --}}
							 			</div>
							 		</div>
							 	</td>
							 </tr>
							  </tbody>
							</table>

						</div>
						<div class="col-4 text-center align-self-center">
							<div class="border bg-light p-2">
								<h5>SALDO :</h5>
								<input  type="text" name="saldo[]" class="form-control" style="box-shadow: 5px 5px 15px 0px  #087980;">
							</div>

						</div>
					</div>
					@endforeach
				</div>
			
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
    $( "#taller34" ).submit();
  }
})
});

</script>
@endsection