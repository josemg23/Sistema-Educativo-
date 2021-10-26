@extends('layouts.nav')
<!-- ESCRIBIR EN EL GUSANILLO -->

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
         			<div class="row align-items-center justify-content-center">
			<div class="col-2">
				<img class="text-center" src="{{ asset('img/talleres/imagen-8.jpg') }}" alt="">
			</div>
			<div class="col-3 mt-5 rounded-circle bg-danger p-5">
				<div class="card" style="width: 11rem;">
				  <div class="card-body">
				   
				    <p class="text-danger text-center">{{ $datos->respuesta1 }}</p>
				   
				  </div>
				</div>
			</div>
			<div class="col-3 mt-3 rounded-circle bg-info p-5">
				<div class="card" style="width: 11rem;">
				  <div class="card-body">
				   
				    <p class="text-danger text-center">{{ $datos->respuesta2 }}</p>
				   
				  </div>
				</div>
			</div>
			<div class="col-3 rounded-circle bg-success p-5">
				<div class="card" style="width: 11rem;">
				  <div class="card-body">
				   
				    <p class="text-danger text-center">{{ $datos->respuesta3 }}</p>
				   
				  </div>
				</div>
			</div>
		</div>
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
                <textarea class="form-control" disabled name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }}</textarea>
              </div>   
            </div>
        </div>
        @endif
        </div>
	</div>
@endsection