@extends('layouts.nav')
@section('title',  $datos->taller->nombre)
@section('content')
<!--IDENTIFICA  EL  ENUNCIADO  ESCRIBIENDO  (V) DE  VERDADERO   O  (F)  DE
FALSO,  CON  CERTEZA. -->
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
                <td > @isset($fecha->fecha_entrega)
                  @if ($update_imei->pivot->fecha_entregado <= $fecha->fecha_entrega)
                  <span class="badge badge-success">PUNTUAL</span>
                  @else
                  <span class="badge badge-danger">ATRASADO</span>
                  @endif
                @endisset</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
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
            {{--   @foreach ($datos->verdadFalsoRes as $key => $element)
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