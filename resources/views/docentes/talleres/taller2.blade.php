@extends('layouts.nav')

@section('titulo', $datos->taller->nombre)
@section('content')

<form action="{{ route('taller1.docente', ['idtaller' => $d]) }}" method="POST">
    @csrf
	 <div class="container-md">
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
            
        <div class="row justify-content-center">
          <div class="col-10">
             {!! $taller->transacciones !!}
          </div>
        </div>
              <div class="row justify-content-between" > 
                @foreach ($registros as $registro)    
                  <div class="col-5">
                    <table class="table">
                        <thead>
                                <tr>
                                  <th colspan="2" scope="col">
                                      <div class="row justify-content-around">
                                          <div class="col-2">D</div>
                                          <div class="col-8 text-center">{{ $registro->cuenta }}</div>
                                          <div class="col-2 text-right">H</div>
                                      </div>
                                  </th>
                                </tr>
                        </thead>
                        <tbody>
                          <tr>
                           <td width="225" class="border-left-0 border-bottom-0 border-top-0 border">
                            <div class="row justify-content-end">
                                <div class="col-12">
                                  @foreach ($cuenta = App\Admin\Respuesta\PDDebe::where('partida_doble_regi_id', $registro->id)->get() as $cu)
                                    <div>
                                        <p  class="text-right">{{ $cu->valor }}</p>
                                    </div>
                                    @endforeach
                               @isset ($registro->total_debe)  
                                 <p class="border border-bottom-0 border-left-0 border-right-0 border-danger text-right">$ {{ $registro->total_debe }}</p>
                                 @endisset
                                </div>
                            </div>
                          </td>  
                             <td width="225" class="border-left-0 border-bottom-0 border-top-0 border">
                              <div class="row justify-content-end">
                                  <div class="col-12">
                              @foreach ($cuentas = App\Admin\Respuesta\PDHaber::where('partida_doble_regi_id', $registro->id)->get() as $element)
                                      <div >
                                          <p  class="text-right">{{ $element->valor }}</p>
                                      </div>
                              @endforeach
                              @isset ($registro->total_haber)
                                <p class="border border-bottom-0 border-left-0 border-right-0 border-danger text-right">$ {{ $registro->total_haber }} </p>
                              @endisset                  
                                  </div>
                              </div>
                          </td>  
                             </tr>
                        </tbody>
                    </table>
                  </div>
                @endforeach
                </div>
                @if ($taller->estado_resultado == 'si')
                 <h2 class="text-center font-weight-bold text-danger mt-2 display-4">ESTADO DE RESULTADO</h2>
                   <div class="row mt-2 justify-content-center">
                     <div class="col-10">
                       <table class="table">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">Descripcion</th>
                              <th class="text-center" scope="col" width="150">.</th>
                              <th class="text-center" scope="col" width="150">.</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($resultado = App\PartidaDobleEstado::where('partida_doble_id', $datos->id)->get() as $registro) 
                            <tr>
                              <td>{{ $registro->descripcion }}</td>
                              <td class="text-right">{{ $registro->saldo1 }}</td>
                              <td class="text-right">{{ $registro->saldo2 }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                     </div>
                   </div>
                 @endif
          </div>
            <div class="row justify-content-center">
            <div class="col-5">
              <div class="form-group">
                <label for="exampleFormControlInput1">Calificacion</label>
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="text" class="form-control" value="{{ $update_imei->pivot->calificacion }}" name="calificacion" placeholder="Añada una nota al estudiante">
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