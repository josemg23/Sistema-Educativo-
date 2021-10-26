@extends('layouts.nav')
{{-- EN EL SIGUIENTE COLLAGE APLIQUE FIGURAS QUE SE  RELACIONEN CON CONTABILIDAD HOTELERA, CON EFICACIA --}}
@section('title', $datos->taller->nombre)
@section('content')
<<<<<<< HEAD
=======
    <li class="d-none">
        @if (Auth::check())
        @foreach (auth()->user()->roles as $role)
        {{ $rol = $role->descripcion}}
        @endforeach
        @endif
    </li>
>>>>>>> 618ceb09e19e1b3a3abfe1045b2cd3624380bfa2
<div class="container">
  <h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
  <div class="card border border-danger mb-3" >
    <div class="card-header font-weight-bold" style="font-size: 25px;">
    <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>
    <div class="card-body">
         <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
    <div class="row justify-content-center">
     {{--  <div class="col-12">
        {!! $taller->detalles !!}
      </div> --}}
      <div class="col-6" style="border: double 8px #CD1D1D; overflow-y: scroll; height: 500px;">
        <h2 class="text-center font-weight-bold text-danger">ACTIVOS</h2>
        <ul class="list-group list-group-flush">
          @foreach ($activos = json_decode($datos->activos) as $activo)
          <li class="list-group-item">{{ $activo->cuenta }}</li>
          @endforeach
        </ul>
      </div>
      <div class="col-6" style="border: double 8px #CD1D1D; overflow-y: scroll; height: 500px;">
        <h2 class="text-center font-weight-bold text-danger">PASIVOS</h2>
        <ul class="list-group list-group-flush">
          @foreach ($pasivos = json_decode($datos->pasivos) as $pasivo)
          <li class="list-group-item">{{ $pasivo->cuenta }}</li>
          @endforeach
        </ul>
      </div>
    </div>
      
    </div>
 
    
<<<<<<< HEAD
    
=======
      @if ($rol === 'estudiante')
>>>>>>> 618ceb09e19e1b3a3abfe1045b2cd3624380bfa2
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
<<<<<<< HEAD
=======
    @endif
>>>>>>> 618ceb09e19e1b3a3abfe1045b2cd3624380bfa2
  </div>
</div>
</div>
@endsection