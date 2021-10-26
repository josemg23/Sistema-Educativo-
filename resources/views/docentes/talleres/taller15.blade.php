@extends('layouts.nav')
@section('title', $datos->taller->nombre)
@section('content')
<!--CON LOS SIGUIENTES DATOS LLENE EL CHEQUE AL PORTADOR, CON CERTEZA. -->

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
                     @endisset </td>
          				</tr>
          			</table>
          		</div>
          	</div>

          </div>
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
            <div class="row justify-content-center">
            <div class="col-2" style="box-shadow: -5px 5px 15px 0px  #FB5EBA">
				<h2>Datos</h2>
				<label for="">Girador</label><br>

					<p >{{ $taller->girador }}</p>

				<label for="">Girado</label><br>

					<p >{{ $taller->girado }}</p>

				<label for="">Beneficiario</label><br>

					<p >{{ $taller->beneficiario }}</p>


				<label for="">Cantidad</label><br>

					<p>{{ $taller->cantidad }}</p>

				<label for="">Lugar y Fecha</label>	<br>
				<p >{{ $taller->lugar }}</p>

				<p>{{ $taller->fecha }}</p>

			</div>
           		<div class="col-9 border">
				<div class="row justify-content-center">
					<div class="col-6">
						<input type="text" name="girador" value="{{ $datos->girador }}" class="form-control mt-2" disabled>
					</div>	
					<div class="col-2 align-self-center">
						<p>16457 <br>
							152
						</p>
					</div>	
				</div>
				<div class="row">
					<div class="col-2">
						<label class="text-capitalize"  for="">PAGUESE A LA ORDEN DE:</label>
						
					</div>
					<div class="col-8">
						<input type="text" name="girado" class="form-control" value="{{ $datos->girado }}" disabled>
					</div>
					<div class="col-2">
						<label for="">
							CHEQUE 0145
						</label><br>
						<div class="row">
							<div class="col-2"><label for="">
							US
						</label></div>
							<div class="col-8"><input type="numeric" name="cantidad" value="{{ $datos->cantidad }}" class="form-control" size="2" disabled></div>
						</div>
						
					</div>

				</div>
				<div class="row mb-2">
					<div class="col-2">
						<label for="">LA SUMA DE</label>
					</div>
					<div class="col-8">
						<input type="text" name="suma" class="form-control" value="{{ $datos->suma }}" disabled> 
					</div>
					<div class="col-2">
						DOLARES
					</div>
				</div>
				<div class="row">
					<div class="col-6 align-self-start pb-5">
						<div class="row">
							<div class="col-6"><input name="lugar" class="form-control" value="{{ $datos->lugar }}" type="text" disabled></div>
							<div class="col-6"><input name="fecha" class="form-control" value="{{ $datos->fecha }}" type="date" disabled></div>
						</div>
							<div class="row">
							<div class="col-6"> <label for="">CIUDAD</label> </div>
							<div class="col-6 text-center"> <label for="">FECHA</label> </div>
						</div>
					</div>
					<div class="col-6 col align-self-end text-center">
						<input disabled class="form-control" value="{{ $datos->firma }}" type="text" >
						<label class="" for="">FIRMA</label>
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
	</div>
</form>
@endsection