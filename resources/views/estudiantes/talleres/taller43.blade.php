
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
		<div class="container">
	<h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>

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
                <textarea class="form-control" disabled="" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }}</textarea>
              </div>   
            </div>
        </div>
        @endif
        </div>		
		</div>

@endsection