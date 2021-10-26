@extends('layouts.nav')

@section('title', $datos->taller->nombre)
@section('content')
<!-- SUBRAYE  LA  ALTERNATIVA  CORRECTA. -->
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
                    <td >@isset($fecha->fecha_entrega)
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
                <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Enunciado</th>
                      <th scope="col">Respuesta</th>
                      <th scope="col">Estado De Respuesta</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($datos->subrayarres  as  $key => $data)
                    <tr>
                      <th scope="row"></th>
                      <td>{{ $data->concepto }}</td>
                      <td>{{ $data->respuesta }}</td>
                      <td width="200"> @if ($data->respuesta == $taller->tallerSubraOps[$key]->respuesta )<span class="badge badge-success">Correcta</span> @else <span class="badge badge-danger">Incorrecta</span> @endif</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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
{{--       @foreach ($datos->TallerSubraOps as $key => $element)          
     		<div class="row mb-4 justify-content-center ">
     			<div class="col-10">
     				<span class="badge-danger badge-pill">{{ $key + 1 }}.</span>
     				<label class="form-control-label">{{ $element->concepto }}</label>
     				<div class="row">
              @foreach ($info = explode(',', $element->alternativas); as $e)            
     						<div class="col-4"><input type="radio" name="respuesta[{{ $key }}]" value="{{ $e }}"> <label>{{ $e }}</label></div>
              @endforeach
     				</div>	
     			</div>
     		</div>
      @endforeach --}}
     	</div>
     	</div>

     	


     </form>

@endsection