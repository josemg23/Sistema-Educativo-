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
<!--ESCRIBA  EN  LOS  CÍRCULOS  EJEMPLOS. -->
    <div class="container">
        <h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;">
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
        <div class="row justify-content-center">
            <div class="col-4 mt-5">
                @isset ($datos->respuesta1 )
                    <div class="alert alert-primary" role="alert">
                        {{ $datos->respuesta1 }}
                    </div>
                @endisset
                
            </div>
            <div class="col-4 mt-5">
                 @isset ($datos->respuesta2 )
                    <div class="alert alert-primary" role="alert">
                        {{ $datos->respuesta2 }}
                    </div>
                @endisset
            </div>
        </div>
        <div class="row row justify-content-md-center">
            <div class="col-4 mt-5">
                 @isset ($datos->respuesta3 )
                    <div class="alert alert-primary" role="alert">
                        {{ $datos->respuesta3 }}
                    </div>
                @endisset
            </div>
            <div class="col-3 text-center mt-3 mb-3 ">
                <img class="img-fluid" width="150" src="{{ asset($taller->img) }}" alt="">
            </div>
        <div class="col-4 mt-5">
                 @isset ($datos->respuesta4 )
                    <div class="alert alert-primary" role="alert">
                        {{ $datos->respuesta4 }}
                    </div>
                @endisset
        </div>
    </div>
    <div class="row justify-content-center">
            <div class="col-4 m-2">
                     @isset ($datos->respuesta5 )
                    <div class="alert alert-primary" role="alert">
                        {{ $datos->respuesta5 }}
                    </div>
                @endisset
            </div>
            <div class="col-4 m-2">
                 @isset ($datos->respuesta6 )
                    <div class="alert alert-primary" role="alert">
                        {{ $datos->respuesta6 }}
                    </div>
                @endisset
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
                <textarea disabled class="form-control" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion"> {{ $relacion[0]->retroalimentacion }} </textarea>
              </div>       
            </div>
        </div>
        @endif
          </div>
        </div>
    </div>
@endsection