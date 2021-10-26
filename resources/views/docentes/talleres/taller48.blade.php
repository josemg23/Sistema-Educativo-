@extends('layouts.nav')
{{-- EN EL SIGUIENTE COLLAGE APLIQUE FIGURAS QUE SE  RELACIONEN CON CONTABILIDAD HOTELERA, CON EFICACIA --}}
@section('title', $datos->taller->nombre)
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
                     @endisset </td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="card-body">
				<h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
				<div class="row justify-content-center">
					<div class="col-9">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>N°</th>
									<th >NOMBRE DEL ARCHIVO</th>
									<th width="100">ARCHIVO</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($datos->rarchivos as $key => $archivo)
								<tr>
									<td>{{ $key + 1 }}</td>
									<td>{{ $archivo->nombre }}</td>
									<td class="text-center">
										@if ($archivo->extension == 'pdf')
										<a href="{{ $archivo->urlarchivo }}" target="_blanK" class="btn btn-outline-danger"><i class="fas fa-file-pdf"></i></a>
										@elseif ($archivo->extension == 'docx')
										<a href="{{ $archivo->urlarchivo }}" target="_blanK" class="btn btn-outline-primary"><i class="fas fa-file-word"></i></a>
										@elseif ($archivo->extension == 'txt')
										<a href="{{ $archivo->urlarchivo }}" target="_blanK" class="btn btn-outline-secondary"><i class="fas fa-file-alt"></i></a>
										@elseif ($archivo->extension == 'xlsx')
										<a href="{{ $archivo->urlarchivo }}" target="_blanK" class="btn btn-outline-success"><i class="fas fa-file-excel"></i></a>
										@elseif ($archivo->extension == 'ppt')
										<a href="{{ $archivo->urlarchivo }}" target="_blanK" class="btn btn-outline-danger"><i class="fas fa-file-powerpoint"></i></a>
										@elseif ($archivo->extension == 'png' || 'jpg' || 'jpge')
										<a href="{{ $archivo->urlarchivo }}" target="_blanK" class="btn btn-outline-primary"><i class="fas fa-file-image"></i></a>
										@else
										<a href="{{ $archivo->urlarchivo }}" target="_blanK" class="btn btn-outline-info"><i class="fas fa-file"></i></a>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
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
		
	</form>
</div>
@endsection