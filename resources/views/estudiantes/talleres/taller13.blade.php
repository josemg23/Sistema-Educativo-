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
<!-- DEFINA  LOS  ENUNCIADOS  EN  LOS  CUADROS,  CON  ORIGINALIDAD. -->

<div class="container">
	<h1 class="text-center text-danger  display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
            		<div class="row justify-content-center">
					<div class="col-10">
						<div class="row justify-content-between">
							@foreach ($datos->definirenunciadosRes as $element)
								<div class="col-5 border-danger border mb-4 pb-5">
									<h2 class="text-center mt-1 mb-3 bg-info"> {{ $element->concepto }} </h2>
					    <p class="card-text">{{ $element->respuesta }}</p>
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
                <input type="text"{{ $relacion[0]->retroalimentacion }}   disabled="" class="form-control" name="calificacion" placeholder="Añada una nota al estudiante">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Retroalimentacion</label>
                <textarea class="form-control" name="retroalimentacion" disabled=""  rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }}</textarea>
              </div>   
            </div>
        </div>
        @endif
			</div>
          </div>
        </div>
@endsection