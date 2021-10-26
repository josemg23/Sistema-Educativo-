@extends('layouts.nav')
@section('title',  $datos->taller->nombre)
@section('content')
<li class="d-none">
  @if (Auth::check())
  @foreach (auth()->user()->roles as $role)
  {{ $rol = $role->descripcion}}
  @endforeach
  @endif
</li>
<!--IDENTIFICA  EL  ENUNCIADO  ESCRIBIENDO  (V) DE  VERDADERO   O  (F)  DE
FALSO,  CON  CERTEZA. -->
<div class="container">
  <h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
  <div class="card border border-danger mb-3" >
    <div class="card-header font-weight-bold" style="font-size: 25px;">
    <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>
    <div class="card-body">
      <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
      <h6 class="text-muted"> Si el item esta en verde esta correcto, si esta en rojo es incorrecto</h6>
      <div class="row justify-content-center">
        <div class="col-7">
              <table class="table table-borderless ">
              <tbody>
                @foreach ($datos->verdadFalsoRes as $key => $element)
                <tr>
                  <td width="50"> <span class="badge badge-pill badge-info">{{$key + 1 }}</span>  </td>
                  <td>{{ $element->enunciado }} </td>
                  <td class="text-right"><span class=" @if($taller->tallerVerFalOp[$key]->respuesta === $element->respuesta)badge-success @else badge-danger @endif badge p-3">{{ $element->respuesta }}</span> </td>
                </tr>
              </tbody>
              @endforeach
            </table>
            
{{--           @foreach ($datos->verdadFalsoRes as $key => $element)
          <div class="row mt-4 p-2">
            <div class="col-10 ">
              <span class="badge badge-pill badge-info">{{$key + 1 }}</span> <label class="col-form-label " for="">{{ $element->enunciado }} </label>
              
            </div>
            <div class="col-2">
              <span class=" @if ($taller->tallerVerFalOp[$key]->respuesta === $element->respuesta)badge-success @else badge-danger @endif badge p-3">{{ $element->respuesta }}</span>
            </div>
          </div>
          <br>
          @endforeach --}}
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
          <textarea  disabled class="form-control" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }}</textarea>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection