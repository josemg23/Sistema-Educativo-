@extends('layouts.nav')

@section('title', $datos->taller->nombre)
@section('content')
  <li class="d-none">
        @if (Auth::check())
        @foreach (auth()->user()->roles as $role)
        {{ $rol = $role->descripcion}}
        @endforeach
        @endif
    </li>

<!-- LLENE  CON  LOS  SIGUIENTES  DATOS  LA  ORDEN  DE  PAGO CORRECTAMENTE. -->

	<div class="container">
		<h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>

          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
            	<table class="table table-borderless">
			                  <thead>
			                    <tr class="text-center">
			                      <th scope="col">Nombre del beneficiario</th>
			                      <th scope="col">Lugar y fecha</th>
			                      <th scope="col">Tipo y Numero de comprobante</th>
			                      <th scope="col">Cantidad</th>
			                      <th scope="col">Firmas</th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                  	
			                    <tr class="text-center">
			                      <td>{{ $taller->beneficiario }}</td>
			                      <td>{{ $taller->lugar }} , {{ $taller->fecha }} </td>
			                      <td>{{ $taller->comprobante }}</td>
			                      <td>{{ $taller->cantidad }}</td>
			                      <td>{{ $taller->firmas }}</td>
			                    </tr>
			       

			                  </tbody>
			              </table>

			              		<div class="row justify-content-center">
			<div class="col-10 border border-danger">
				<div class="row justify-content-center">
					<div class="col-10">
						<div class="row">
							<div class="col-8">
								<div class="row">
									<div class="col-4 align-self-center">
										<img class="img-fluid float-right" src="{{ asset('img/talleres/imagen-25.jpg') }}" alt="">
									</div>
									<div class="col-8">
										<h2>MIKEY  S.A.</h2>
										<h5>RUC. 1200548769001</h5>
										<h5>Tlfs: 2306168   2431129</h5>
										<h5>Casilla No 1840</h5>
									</div>
								</div>
							</div>
							<div class="col-4 align-self-center">
								<h1 class="text-center">ORDEN DE  PAGO</h1>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-3">
								<label for="">Señor (es)</label>
							</div>
							<div class="col-9">
								<input disabled value="{{ $datos->señor }}" type="text" name="señor" class="form-control">
							</div>
						</div>

							<div class="row mb-3">
							<div class="col-3">
								<label for="">Fecha</label>
							</div>
							<div class="col-9">
								<input disabled value="{{ $datos->fecha }}" type="date" name="fecha" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-12 text-center">
								<h1>DATOS DE LA FACTURA</h1>
							</div>
						</div>

						<div class="row border border-danger mb-4">
							<table class="table table-bordered">
							  <thead >
							    <tr align="center" >
							      <th colspan="3">COMPROBANTES</th>
							      <th scope="col" style="vertical-align: middle;" rowspan="2">DEBE</th>
							      <th scope="col" style="vertical-align: middle;" rowspan="2">HABER</th>
							      <th scope="col"style="vertical-align: middle;"  rowspan="2">SALDO</th>
							    </tr>
							    <tr align="center">
								    <th>FECHA</th>
								    <th>NUMERO</th>
								    <th>TIPO</th>
							    </tr>
							  </thead>
							  <tbody>
							<tr>
								<td><input disabled value="{{ $datos->fecha_c }}" type="date" name="fecha_c" class="form-control"></td>
								<td><input disabled value="{{ $datos->numero }}" type="text" name="numero" class="form-control text-right"></td>
								<td><input disabled value="{{ $datos->tipo }}" type="text" name="tipo" class="form-control"></td>
								<td><input disabled value="{{ $datos->debe }}" type="text" name="debe" class="form-control text-right"></td>
								<td><input disabled value="{{ $datos->haber }}" type="text" name="haber" class="form-control text-right"></td>
								<td><input disabled value="{{ $datos->saldo }}" type="text" name="saldo" class="form-control text-right"></td>
							</tr>
							  </tbody>
							</table>

						</div>
						<div class="row border border-danger mb-4">
							<table class="table table-bordered">
							  <thead >
							  	<tr align="center">
							  		<th >
							  			<h5>REVISADO</h5>
							  		</th>
							  		<th>
							  			<h5>AUTORIZADO</h5>
							  		</th>
							  		<th>
							  			<h5>VTO. BNO.</h5>
							  		</th>
							  	</tr>
							  </thead>
							  <tbody>
							  	<tr>
							  		<td><input disabled value="{{ $datos->revisado }}" type="text" name="revisado" class="form-control"></td>
							  		<td><input disabled value="{{ $datos->autorizado }}" type="text"  name="autorizado"class="form-control"></td>
							  		<td><input disabled value="{{ $datos->vto_bueno }}" type="text" name="vto_bueno" class="form-control"></td>
							  	</tr>
							  </tbody>

							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

          </div>
           @if ($rol === 'estudiante')
            <div class="row justify-content-center">
            <div class="col-5">
              <div class="form-group">
                <label for="exampleFormControlInput1">Calificacion</label>
                {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
                <input type="text" disabled value="{{ $relacion[0]->calificacion }}" class="form-control" name="calificacion" placeholder="Añada una nota al estudiante">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Retroalimentacion</label>
                <textarea disabled class="form-control" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion"> {{ $relacion[0]->retroalimentacion }}</textarea>
              </div>   
               
            </div>
        </div>
        @endif
        </div>


	</div>

</form>

@endsection	