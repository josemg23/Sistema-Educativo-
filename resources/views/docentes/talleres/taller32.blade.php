@extends('layouts.nav')

@section('title', $datos->nombre)
@section('content')
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
          					<td > @isset($fecha->fecha_entrega)
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
            <h2 class="font-weight-bold "><span class="badge badge-danger text-center text-gray-dark">#</span>{{ $datos->enunciado }}</h2>
          		<div class="row">
          			<div class="col-4">
          				<div class="card" style="width: 18rem;">
						  <ul class="list-group list-group-flush">
						  	<li class="list-group-item list-group-item-primary"><span class="font-weight-bold">Abreviaturas 5 Económicas con la letra I</span></li>
						  	@isset ($datos->abreviaturaI1)
						  	     <li class="list-group-item">{{ $datos->abreviaturaI1 }}</li>
						  	@endisset
						  	@isset ($datos->abreviaturaI2)
						  	     <li class="list-group-item">{{ $datos->abreviaturaI2 }}</li>
						  	@endisset
						  	@isset ($datos->abreviaturaI3)
						  	     <li class="list-group-item">{{ $datos->abreviaturaI3 }}</li>
						  	@endisset
						  	@isset ($datos->abreviaturaI4)
						  	     <li class="list-group-item">{{ $datos->abreviaturaI4 }}</li>
						  	@endisset
						  	@isset ($datos->abreviaturaI5)
						  	     <li class="list-group-item">{{ $datos->abreviaturaI5 }}</li>
						  	@endisset
						  </ul>
						</div>
          			</div>
          			<div class="col-4">
          				<div class="card" style="width: 18rem;">
						  <ul class="list-group list-group-flush">
						  	<li class="list-group-item list-group-item-primary"><span class="font-weight-bold">Abreviaturas Económicas 5 con la letra C</span></li>
						  	@isset ($datos->abreviaturaC1)
						  	     <li class="list-group-item">{{ $datos->abreviaturaC1 }}</li>
						  	@endisset
						  	@isset ($datos->abreviaturaC2)
						  	     <li class="list-group-item">{{ $datos->abreviaturaC2 }}</li>
						  	@endisset
						  	@isset ($datos->abreviaturaC3)
						  	     <li class="list-group-item">{{ $datos->abreviaturaC3 }}</li>
						  	@endisset
						  	@isset ($datos->abreviaturaC4)
						  	     <li class="list-group-item">{{ $datos->abreviaturaC4 }}</li>
						  	@endisset
						  	@isset ($datos->abreviaturaC5)
						  	     <li class="list-group-item">{{ $datos->abreviaturaC5 }}</li>
						  	@endisset
						  </ul>
						</div>
          			</div>
          			<div class="col-4">
          				<div class="card" style="width: 18rem;">
						  <ul class="list-group list-group-flush">
						  	<li class="list-group-item list-group-item-primary"><span class="font-weight-bold">Abreviaturas Económicas con la letra R</span></li>
						  	@isset ($datos->abreviaturaR1)
						  	     <li class="list-group-item">{{ $datos->abreviaturaR1 }}</li>
						  	@endisset
						  	@isset ($datos->abreviaturaR2)
						  	     <li class="list-group-item">{{ $datos->abreviaturaR2 }}</li>
						  	@endisset
						  	@isset ($datos->abreviaturaR3)
						  	     <li class="list-group-item">{{ $datos->abreviaturaR3 }}</li>
						  	@endisset
						  	@isset ($datos->abreviaturaR4)
						  	     <li class="list-group-item">{{ $datos->abreviaturaR4 }}</li>
						  	@endisset
						  	@isset ($datos->abreviaturaR5)
						  	     <li class="list-group-item">{{ $datos->abreviaturaR5 }}</li>
						  	@endisset
						  </ul>
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