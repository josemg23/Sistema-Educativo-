@extends('layouts.nav')

@section('title', 'Taller 38')
@section('content')
       <li class="d-none">
        @if (Auth::check())
        @foreach (auth()->user()->roles as $role)
        {{ $rol = $role->descripcion}}
        @endforeach
        @endif
    </li>
	<div class="container">
	<h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
		  <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1>
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
            			<div class="row justify-content-center ">
				<div class="col-12">
				@foreach ($taller->tallerTipoSaldo as  $key => $tipos)
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
							 				<h4 class="text-right font-weight-bold text-info">{{ $datos->saldoDato[$key]->total_debe }}</h4>
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
							 				<h4 class="text-right font-weight-bold text-info">{{ $datos->saldoDato[$key]->total_haber }}</h4>

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
								<input type="text" disabled value="{{ $datos->saldoDato[$key]->respuesta }}" name="saldo[]" class="form-control">
							</div>

						</div>
					</div>
					@endforeach
				</div>
		</div>
          </div>
          @if ($rol === 'estudiante')
            <div class="row justify-content-center">
            <div class="col-5">
              <div class="form-group">
                <label for="exampleFormControlInput1">Calificacion</label>
                {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
                <input type="text" disabled value="{{ $relacion[0]->calificacion }}"class="form-control" name="calificacion" placeholder="Añada una nota al estudiante">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Retroalimentacion</label>
                <textarea disabled="" class="form-control" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }}</textarea>
              </div>   
              
            </div>
        </div>
        @endif
        </div>
	</div>
</form>

@endsection