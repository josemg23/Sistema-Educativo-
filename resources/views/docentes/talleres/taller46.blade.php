@extends('layouts.nav')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/mapa.css') }}">
@endsection
@section('titulo', $datos->taller->nombre)
@section('content')

<form action="{{ route('taller1.docente', ['idtaller' => $d]) }}" method="POST">
    @csrf
	 <div class="container p-3">
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
                
        <div class="row  justify-content-center align-items-center mb-4">
            <div class="col-4 purple-border">
                <textarea disabled  placeholder="4. Personas Juridicas" name="persona_juridica"  class="form-control" id="" cols="30" rows="10">{{ $datos->persona_juridica }} </textarea>
            </div>
            <div class="col-4 align-self-center text-center" >
                <div class="border border-success mapa" style="">
                        <p> Objeto</p>  
                </div>
              
            </div>
            <div class="col-4 green-border">
                <textarea disabled   placeholder="1.Objetivo " name="objetivo" class="form-control"  id="" cols="30" rows="10">{{ $datos->objetivo }} </textarea>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-4">
                <div class="headshot headshot-1">
                    <div class="border border-primary mapa" style="">
                        <p> PERSONAS 
                        JURIDICAS</p>  
                </div>
            </div>
            </div>
            <div class="col-4">
            <div id="foo">
            <h6 class="hola">RUC</h6>
            </div>
            </div>
            <div class="col-4">
                <div class="border border-danger mapa" style="">
                        <p> IMPORTANCIA</p>  
                </div>
            </div>
        </div>
                <div class="row  justify-content-center align-items-center mb-4">
            <div class="col-4 purple-border">
                <textarea disabled  placeholder="3. Persona Natural" name="persona_natural"  class="form-control" id="" cols="30" rows="10">{{ $datos->persona_natural }} </textarea>
            </div>
            <div class="col-4 align-self-center text-center" >
                <div class="border border-success mapa" style="">
                        <p> PERSONAS NATURALES</p>  
                </div>
              
            </div>
            <div class="col-4 green-border">
                <textarea disabled  placeholder="2. Importancia" name="importancia" class="form-control"  id="" cols="30" rows="10">{{ $datos->importancia }} </textarea>
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
                <textarea   class="form-control" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $update_imei->pivot->retroalimentacion }}</textarea>
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
