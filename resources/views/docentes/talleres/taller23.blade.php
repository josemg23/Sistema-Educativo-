@extends('layouts.nav')

@section('title', $datos->taller->nombre)
@section('content')

<!-- LLENE  CON  LOS  SIGUIENTES  DATOS  LOS  RECIBOS  CORRECTAMENTE. -->

<form action="{{ route('taller1.docente', ['idtaller' => $d]) }}" method="POST">
 @csrf
	<div class="container">
		<h1 class="text-center text-danger  display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          
          <div class="card-header "> 
          	<div class="row">
          		<div class="col-7" style="font-size: 25px;">
          	<h1 class="display-3 font-weight-bold">{{ $user->name }} {{ $user->apellido }}</h1>
          			
          		</div>
          		<div class="col-5">
          			<table>
          				<tr>
          					<td width="200" class="font-weight-bold text-danger">Fecha de Entrega:</td>
          					<td>@isset($fecha->fecha_entrega)
                         {{Carbon\Carbon::parse($fecha->fecha_entrega)->formatLocalized('%d de %B %Y ') }}
                      @endisset</td>
          				</tr>
          				<tr>
          					<td width="200" class="font-weight-bold text-primary">Entregado:</td>
          					<td>{{Carbon\Carbon::parse($update_imei->pivot->fecha_entregado)->formatLocalized('%d de %B %Y ') }}</td>
          				</tr>
          				<tr>
          					<td class="font-weight-bold text-info">Estado de entrega:</td>
          					<td > @isset($fecha->fecha_entrega)
                      @if ($update_imei->pivot->fecha_entregado <= $fecha->fecha_entrega)
                      <span class="badge badge-success">PUNTUAL</span>
                      @else
                      <span class="badge badge-danger">ATRASADO</span>
                      @endif 
                     @endisset </td>
          				</tr>
          			</table>
          		</div>
          	</div>

          </div>
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
             		<table class="table table-borderless">
			                  <thead>
			                    <tr class="text-center">
			                      <th scope="col">Valor</th>
			                      <th scope="col">Acreedor</th>
			                      <th scope="col">Deudor</th>
			                      <th scope="col">Descripcion</th>
			                      <th scope="col">Direccion</th>
			                      <th scope="col">Lugar y fecha</th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                  	
			                    <tr class="text-center">
			                      <td>{{ $taller->valor }}</td>
			                      <td>{{ $taller->acreedor }} </td>
			                      <td>{{ $taller->deudor }}</td>
			                      <td>{{ $taller->descripcion }}</td>
			                      <td>{{ $taller->direccion }}</td>
			                      <td>{{ $taller->lugar }}, {{ $taller->fecha }}</td>
			                    </tr>
			       

			                  </tbody>
			              </table>
            <div class="row justify-content-center">
          				<div class="col-8 border">
				<h1 class="text-center">RECIBO</h1>
				<div class="row justify-content-between">
					<div class="col-4  form-inline">
						No. <input type="text" name="no" size="5" class="form-control  form-control-sm text-right" value="{{ $datos->no }}" disabled  name="">
					</div>
					<div class="col-4 form-inline mb-2">
						Por $  <input type="text" size="5" class="form-control  form-control-sm text-right" value="{{ $datos->por }}" disabled  name="por">
					</div>
				</div>
				<div class="row mb-2">			
					<div class="col-4 text-left">
						<label class="col-form-label" for="">Recibi de:</label>
					</div>
					<div class="col-8">
						<input type="text" name="recibi" class="form-control  form-control-sm" value="{{ $datos->recibi }}" disabled >
					</div>
				</div>

				<div class="row mb-2">			
							<div class="col-4 text-left">
								<label class="col-form-label" for="">La suma de:</label>
							</div>
							<div class="col-8">
								<input type="text" name="cantidad" class="form-control  form-control-sm" value="{{ $datos->cantidad }}" disabled >
							</div>
						</div>

						<div class="row mb-2">			
							<div class="col-4 text-left">
								<label class="col-form-label" for="">Por arriendo de</label>
							</div>
							<div class="col-8 form-inline">
							<p><input type="text" name="arriendo" class="form-control  form-control-sm" value="{{ $datos->arriendo }}" disabled > que ocupa <input type="text" name="ocupa" class="form-control  form-control-sm" value="{{ $datos->ocupa }}" disabled ></p>
								
							</div>
						</div>

						<div class="row mb-2">			
							<div class="col-4 text-left">
								<label class="col-form-label" for="">En la casa de propiedad</label>
							</div>
							<div class="col-8">
								<input type="text" name="propiedad" class="form-control  form-control-sm" value="{{ $datos->propiedad }}" disabled >
							</div>
						</div>

						<div class="row mb-2">			
							<div class="col-4 text-left">
								<label class="col-form-label" for="">situado en</label>
							</div>
							<div class="col-8 form-inline">
								<p><input type="text" class="form-control  form-control-sm" value="{{ $datos->situado }}" disabled  name="situado" size="40">  canon cubierto del</p>
							</div>
						</div>
						<div class="row mb-2">			
							
							<div class="col-12 form-inline">
						<p><input type="text" name="cubierto" class="form-control  form-control-sm" value="{{ $datos->cubierto }}" disabled   size="30"> Hasta el <input type="text" name="hasta" class="form-control  form-control-sm" value="{{ $datos->hasta }}" disabled  size="50"></p>
							</div>
							
						</div>
						<div class="row justify-content-end mb-2">
							<div class="col-4">
								<input type="text" name="espacio" class="form-control  form-control-sm float-left" value="{{ $datos->espacio }}" disabled >
							</div>
						</div>

						<div class="row mb-2 justify-content-center">			
							<div class="col-6 text-center">
								<p><input type="text" name="firma" class="form-control  form-control-sm" value="{{ $datos->firma }}" disabled  size="40">  FIRMA</p>
							</div>
						</div>
			</div>
</div>
          </div>
            <div class="row justify-content-center">
            <div class="col-5">
              <div class="form-group">
                <label for="exampleFormControlInput1">Calificacion</label>
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="text" value="{{ $update_imei->pivot->calificacion }}" class="form-control" name="calificacion" placeholder="Añada una nota al estudiante">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Retroalimentacion</label>
                <textarea class="form-control" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $update_imei->pivot->retroalimentacion }}</textarea>
              </div>   
               <div class="row justify-content-center mb-5">
                <input type="submit" value="Calificar" class="btn p-2 mt-3 btn-danger">
             </div>
            </div>
        </div>
        </div>
	</div>
</form>

@endsection