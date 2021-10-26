@extends('layouts.nav')

@section('title', $datos->taller->nombre)
@section('content')

<!-- LLENE  CON  LOS SIGUIENTES DATOS LAS LETRAS  DE  CAMBIO CORRECTAMENTE -->

<form action="{{ route('taller1.docente', ['idtaller' => $d]) }}" method="POST">
    @csrf
	<div class="container">

			<h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
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
          					<td >@isset($fecha->fecha_entrega)
                      @if ($update_imei->pivot->fecha_entregado <= $fecha->fecha_entrega)
                      <span class="badge badge-success">PUNTUAL</span>
                      @else
                      <span class="badge badge-danger">ATRASADO</span>
                      @endif 
                     @endisset</td>
          				</tr>
          			</table>
          		</div>
          	</div>

          </div>
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
         				<div class="row justify-content-center">
         							<div class="col-2" style="box-shadow: -5px 0px 15px 0px  #27F4AE">
				 <h2>Datos</h2>				 
				  <label for="">Valor</label><br>
                    <p>{{ $taller->valor }}</p>
                <label for="">Acreedor</label><br>
                    <p >{{ $taller->acreedor }}</p>
                <label for="">Deudor</label><br>
                    <p > {{ $taller->deudor }}</p>
                <label for="">Tasa de interes</label><br>
                    <p >{{ $taller->tasa_de_interes }}</p>
                    <label for="">Fecha de Vencimiento</label><br>
                    <p >{{ $taller->fecha_de_vencimiento }}</p>
                <label for="">Lugar y Fecha de emision</label>  <br>
                <p > {{ $taller->lugar }}</p>
                <p>{{ $taller->fecha_de_emision }}</p>
			</div>
			<div class="col-9 border border-info p-3">
				<div class="row mb-2">
					<div class="col-5 mt-3">
						<h2>LETRA DE CAMBIO</h2>
					</div>	
					<div class="col-7 align-self-center">
						<div class="row mb-2">
							<div class="col-3 text-right"><label for="" class="col-form-label">Vence el:</label></div>
							<div class="col-8">
								<input disabled value="{{ $datos->vencimiento }}" type="date" name="vencimiento" class="form-control form-control-sm text-center" required>
							</div>
						</div>
						<div class="row">
							<div class="col-3 text-right">
								<label for="" class="col-form-label">No:</label>
							</div>
							<div class="col-3">
								<input disabled value="{{ $datos->numero }}" type="text" name="numero" class="form-control form-control-sm text-right" required>
							</div>
							<div class="col-5 border border-info p-2">
								<div class="row">
									<div class="col-2">
										<label class="col-form-label" for="">POR:</label>
									</div>
									<div class="col-8">
										<input disabled value="{{ $datos->por }}" type="text" name="por" class="form-control form-control-sm text-right" required>
									</div>
								</div>
							</div>
						</div>						
					</div>	
				</div>
				<div class="row">
					<div class="col-12 text-center ">
						<div class="row mb-1">
							<div class="col-6">
								<input disabled value="{{ $datos->ciudad }}" type="text" name="ciudad" class="form-control form-control-sm" required>
							</div>
							<div class="col-6">
								<input disabled value="{{ $datos->fecha }}" type="date" name="fecha" class="form-control form-control-sm" required>
							</div>
						</div>				
						<h6>Ciudad y fecha</h6>
					</div>
					<div class="col-12 ">						
							<input disabled value="{{ $datos->orden_de }}" type="text" name="orden_de" class="form-control form-control-sm" required>								
						<h6>A la orden de</h6>
					</div>
					<div class="col-12 ">						
							<input disabled value="{{ $datos->orden_de }}" type="text" name="de" class="form-control form-control-sm" required>								
						<h6>De</h6>
					</div>
					<div class="col-12 ">						
							<input disabled value="{{ $datos->cantidad }}" type="text" name="cantidad" class="form-control form-control-sm" required>								
						<h6>La Cantidad de</h6>
					</div>
					<div class="col-12 form-inline">						
							<p class="col-form-label">Con  el  interés  del <input disabled value="{{ $datos->interes }}" type="text" name="interes" class="form-control form-control-sm" required> por  ciento  anual,   desde <input disabled value="{{ $datos->desde }}" name="desde" type="text" class="form-control form-control-sm" required> Sin protesto.   Exímese  de presentación  para  aceptación  y  pago  así  como  de  avisos  por  falta  de  estos  hechos.</p>
					</div>
					<div class="col-12 ">						
							<div class="row mb-1">
								<div class="col-6">
									<input disabled value="{{ $datos->direccion }}" type="text" name="direccion" class="form-control form-control-sm" required>
								</div>
								<div class="col-6">
									<input disabled value="{{ $datos->ciudad2 }}" type="text" name="ciudad2" class="form-control form-control-sm" required>
								</div>
							</div>	
							<div class="row mb-1">
							<div class="col-6"><h6>Direccion</h6></div>
							<div class="col-6 text-right"><h6>Ciudad</h6></div>
							</div>	
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-5 text-center">
						<input disabled value="{{ $datos->atentamente }}" type="text" name="atentamente" class="form-control form-control-sm" required>
						<h1>Atentamente</h1>
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