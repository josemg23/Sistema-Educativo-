
@extends('layouts.nav')

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
           		<div class="row justify-content-center ">
				<div class="col-6 text-center">
					<label class="text-center">{{ $taller->concepto }}</label>
					<div class="border border-info">
						<textarea disabled name="" id="" class="form-control text-justify"  cols="20" rows="5">{{ $datos->respuesta }}</textarea>
					</div>
				</div>
			</div>
			@if ($taller->cantidad == 3)
			<div class="row justify-content-center mb-2">
				<div class="col-12 text-center">
					<label class="text-center">Clasificación</label>
					<div class="row">
						<div class="col-4 "><input disabled value="{{ $datos->enunciado1 }}" type="text" class="form-control border border-success" name="enunciado1"></div>
						<div class="col-4 "><input disabled value="{{ $datos->enunciado2 }}" type="text" class="form-control border border-success" name="enunciado2"></div>
						<div class="col-4 "><input disabled value="{{ $datos->enunciado3 }}" type="text" class="form-control border border-success" name="enunciado3"></div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center ">
				<div class="col-12 text-center">
					<div class="row">
						<div class="col-4 "><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta1" rows="5">{{ $datos->respuesta1 }}</textarea></div>
						<div class="col-4 "><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta2" rows="5">{{ $datos->respuesta2 }}</textarea></div>
						<div class="col-4 "><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta3" rows="5">{{ $datos->respuesta3 }}</textarea></div>
					</div>
				</div>
			</div>
			@elseif($taller->cantidad == 4)
					<div class="row justify-content-center mb-2">
				<div class="col-12 text-center">
					<label class="text-center">Clasificación</label>
					<div class="row">
						<div class="col-3 "><input disabled value="{{ $datos->enunciado1 }}" type="text" class="form-control border border-success" name="enunciado1"></div>
						<div class="col-3 "><input disabled value="{{ $datos->enunciado2 }}" type="text" class="form-control border border-success" name="enunciado2"></div>
						<div class="col-3 "><input disabled value="{{ $datos->enunciado3 }}" type="text" class="form-control border border-success" name="enunciado3"></div>
						<div class="col-3 "><input disabled value="{{ $datos->enunciado4 }}" type="text" class="form-control border border-success" name="enunciado4"></div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center ">
				<div class="col-12 text-center">
					<div class="row">
						<div class="col-3 "><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta1" rows="5">{{ $datos->respuesta1 }}s</textarea></div>
						<div class="col-3 "><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta2" rows="5">{{ $datos->respuesta2 }}s</textarea></div>
						<div class="col-3 "><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta3" rows="5">{{ $datos->respuesta3 }}s</textarea></div>
						<div class="col-3 "><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta4" rows="5">{{ $datos->respuesta4 }}s</textarea></div>
					</div>
				</div>
			</div>
			@elseif($taller->cantidad == 5)
				<div class="row justify-content-center mb-2">
				<div class="col-12 text-center">
					<label class="text-center">Clasificación</label>
					<div class="row">
						<div class="col-3 "><input disabled value="{{ $datos->enunciado1 }}" type="text" class="form-control border border-success" name="enunciado1"></div>
						<div class="col-2 "><input disabled value="{{ $datos->enunciado2 }}" type="text" class="form-control border border-success" name="enunciado2"></div>
						<div class="col-2 "><input disabled value="{{ $datos->enunciado3 }}" type="text" class="form-control border border-success" name="enunciado3"></div>
						<div class="col-2 "><input disabled value="{{ $datos->enunciado4 }}" type="text" class="form-control border border-success" name="enunciado4"></div>
						<div class="col-3 "><input disabled value="{{ $datos->enunciado5 }}" type="text" class="form-control border border-success" name="enunciado5"></div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center ">
				<div class="col-12 text-center">
					<div class="row">
						<div class="col-3 "><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta1" rows="5">{{ $datos->respuesta1 }}</textarea></div>
						<div class="col-2 "><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta2" rows="5">{{ $datos->respuesta2 }}</textarea></div>
						<div class="col-2 "><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta3" rows="5">{{ $datos->respuesta3 }}</textarea></div>
						<div class="col-2 "><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta4" rows="5">{{ $datos->respuesta4 }}</textarea></div>
						<div class="col-3 "><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta5" rows="5">{{ $datos->respuesta5 }}</textarea></div>
					</div>
				</div>
			</div>
			@elseif($taller->cantidad == 6)
						<div class="row justify-content-center mb-2">
				<div class="col-12 text-center">
					<label class="text-center">Clasificación</label>
					<div class="row">
						<div class="col-2"><input disabled value="{{ $datos->enunciado1 }}" type="text" class="form-control border border-success" name="enunciado1"></div>
						<div class="col-2"><input disabled value="{{ $datos->enunciado2 }}" type="text" class="form-control border border-success" name="enunciado2"></div>
						<div class="col-2"><input disabled value="{{ $datos->enunciado3 }}" type="text" class="form-control border border-success" name="enunciado3"></div>
						<div class="col-2"><input disabled value="{{ $datos->enunciado4 }}" type="text" class="form-control border border-success" name="enunciado4"></div>
						<div class="col-2"><input disabled value="{{ $datos->enunciado5 }}" type="text" class="form-control border border-success" name="enunciado5"></div>
						<div class="col-2"><input disabled value="{{ $datos->enunciado6 }}" type="text" class="form-control border border-success" name="enunciado6"></div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center ">
				<div class="col-12 text-center">
					<div class="row">
						<div class="col-2"><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta1" rows="5">{{ $datos->respuesta1 }}</textarea></div>
						<div class="col-2"><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta2" rows="5">{{ $datos->respuesta2 }}</textarea></div>
						<div class="col-2"><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta3" rows="5">{{ $datos->respuesta3 }}</textarea></div>
						<div class="col-2"><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta4" rows="5">{{ $datos->respuesta4 }}</textarea></div>
						<div class="col-2"><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta5" rows="5">{{ $datos->respuesta5 }}</textarea></div>
						<div class="col-2"><textarea value="" disabled  class="form-control border border-success" cols="20" name="respuesta6" rows="5">{{ $datos->respuesta6 }}</textarea></div>
					</div>
				</div>
			</div>

			@endif
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