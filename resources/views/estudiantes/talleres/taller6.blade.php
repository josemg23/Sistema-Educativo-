@extends('layouts.nav')
@section('title', 'Taller '.$datos->taller->id)
@section('content')
    <li class="d-none">
        @if (Auth::check())
        @foreach (auth()->user()->roles as $role)
        {{ $rol = $role->descripcion}}
        @endforeach
        @endif
    </li>
<!--TALLER IDENTIFICAR IMAGENES -->
    <div class="container">
    <h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>
            
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
         		<div class="row justify-content-center">
			@foreach ($datos->identificarimgs as $key => $element)
				<div class="col-6">
					<h5>{{ $key +1 }}</h5>
				<div class="row justify-content-center">
					<div class="col-4">
						<img src="{{ asset($element->img) }}" width="250" alt="Imagen 1">
					</div>
				</div>
			</div>
			@endforeach
		</div>
          </div>
           @if ($rol === 'estudiante')
            <div class="row justify-content-center">
            <div class="col-5">
              <div class="form-group">
                <label for="exampleFormControlInput1">Calificacion</label>
                {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
                <input type="text" value="{{ $relacion[0]->calificacion }}"  disabled class="form-control" name="calificacion" placeholder="Añada una nota al estudiante">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Retroalimentacion</label>
                <textarea disabled="" class="form-control" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion"> {{ $relacion[0]->retroalimentacion }}</textarea>
              </div>   
            </div>
        </div>
          @endif
        </div>
 	</div>
@endsection