@extends('layouts.nav')

@section('title', $datos->nombre)
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
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1>
            </div>

          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
            			<h5 class="text-center display-2">{{ $taller->palabra_clasificar }}</h5>
        		<div class="row justify-content-center">

        			@foreach ($celdas as $clasificaciones)
        			<div class="col-5 mb-5">
						<ul class="list-group">	
						  <li class="list-group-item bg-primary" aria-disabled="true">{{ $clasificaciones->clasificaciones }}</li>
						  	@foreach ($ceda = App\Admin\Respuesta\CeldaClasificado::where('taller_celda_clasificacion_id', $clasificaciones->id)->get() as $element)
						  		<li class="list-group-item">{{ $element->nombre }}</li>
						  	@endforeach
				  		</ul>					
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
               <input type="text" disabled class="form-control" value="{{ $relacion[0]->calificacion }}" name="calificacion" placeholder="Añada una nota al estudiante">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Retroalimentacion</label>
                <textarea disabled class="form-control" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }}</textarea>
              </div>   
            </div>
        </div>
        @endif
        </div>
    </div>

@endsection