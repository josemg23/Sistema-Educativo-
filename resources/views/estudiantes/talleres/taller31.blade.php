@extends('layouts.nav')
 {{-- EN EL SIGUIENTE COLLAGE APLIQUE FIGURAS QUE SE  RELACIONEN CON CONTABILIDAD HOTELERA, CON EFICACIA --}}
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
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
            <div class="row justify-content-center">
              <div class="col-9">
                   <div class="row">
              @foreach ($datos->collageImg as $key => $dato)
              <div class="col-6 align-self-center">
                <div class="card" style="width: 18rem;">
                  <img class="img-fluid" src="{{ asset($dato->url_img) }}" alt="">
                  <div class="card-body bg-secondary">
                    <p class="card-text">Imagen {{ $key+1 }}</p>
                  </div>
                </div>
              </div>

              @endforeach
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
                <textarea class="form-control" disabled="" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }}</textarea>
              </div>   
            </div>
        </div>
        @endif
        </div>
	</div>

 @endsection
