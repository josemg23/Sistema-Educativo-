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

	<div class="container">
			 	<h1 class="text-center text-danger  display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
          	<h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>
          <div class="card-body">
                        <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
            
        <div class="row justify-content-center">
            @foreach ($taller->partidaDobleEnn as $key =>$element)
                  <div class="col-6">
                    <div class="card border border-info mb-3">
                  <div class="card-header">Enunciado {{ $key +1 }}</div>
                  <div class="card-body text-info">
                    <p class="card-text">{{ $element->enunciados }}</p>
                  </div>
                </div>
                </div>
            @endforeach
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
                                          <div class="col-8 text-center" contenteditable="true">{{ $registro->cuenta }}</div>
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
	                <textarea disabled class="form-control" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }}</textarea>
	              </div>   
	            </div>
        	</div>
          @endif
        </div>
	</div>
@endsection