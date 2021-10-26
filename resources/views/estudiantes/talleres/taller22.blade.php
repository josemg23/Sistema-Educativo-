@extends('layouts.nav')

@section('title', $datos->taller->nombre )
@section('content')
  <li class="d-none">
        @if (Auth::check())
        @foreach (auth()->user()->roles as $role)
        {{ $rol = $role->descripcion}}
        @endforeach
        @endif
    </li>

<!-- LENE  CON  LOS  SIGUIENTES  DATOS  LA  NOTA  DE  PEDIDO, 
ADECUADAMENTE. -->
	<div class="container">
			<h1 class="text-center text-danger  display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>

          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
                   		<table class="table table-borderless">
			                  <thead>
			                    <tr class="text-center">
			                      <th scope="col">Pedido</th>
			                      <th scope="col">Lugar y fecha</th>
			                      <th scope="col">Firma de Bodeguero</th>
			                      <th scope="col">Plazo de entregado</th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                  	
			                    <tr class="text-center">
			                      <td>{{ $taller->pedido }}</td>
			                      <td>{{ $taller->lugar }} {{ $taller->fecha }}</td>
			                      <td>{{ $taller->firma }}</td>
			                      <td>{{ $taller->plazo_entrega }}</td>
			                    </tr>
			       

			                  </tbody>
			                </table>

           		<table class="table table-borderless">
			                  <thead>
			                    <tr class="text-center">
			                      <th scope="col">#</th>
			                      <th scope="col">Codigo</th>
			                      <th scope="col">Cantidad</th>
			                      <th scope="col">Descripcion</th>
			                      <th scope="col">Precio Unitario</th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                  	@foreach ($taller->pedidoDatos as $dato)
			                    <tr class="text-center">
			                      <th scope="row"></th>
			                      <td>{{ $dato->codigo }}</td>
			                      <td>{{ $dato->cantidad }}</td>
			                      <td>{{ $dato->descripcion }}</td>
			                      <td>{{ $dato->precio_unit }}</td>
			                    </tr>
			                    @endforeach

			                  </tbody>
			                </table>
			                <div class="row justify-content-center">
			<div class="col-9 border border-warning">
				<div class="row">
					<div class="col-6 text-center p-3">
						<h1>COMERCIAL "PLAZA"</h1>
						<img class="img-fluid" src="{{ asset('img/talleres/imagen-22.jpg') }}" alt="">
						<h5 class="text-left">RUC. 0923568947001</h5><h5 class="text-left">Av. Quito y letamendi</h5>
						<h5 class="text-left">Tlfs: 2580465 - 2413864</h5>
					</div>
					<div class="col-6 text-center p-3">
						<h1>NOTA DE PEDIDA</h1>
						<h4>No. <input type="text" disabled value="{{ $datos->pedido }}" name="pedido" class="" size="5"></h4>
						<div class="row mb-2">			
							<div class="col-4 text-left">
								<label class="col-form-label" for="">Fecha:</label>
							</div>
							<div class="col-8">
								<input type="text" name="fecha" disabled value="{{ $datos->fecha }}" class="form-control">
							</div>
						</div>
						<div class="row mb-2">			
							<div class="col-4 text-left">
								<label class="col-form-label"  for="">Dependencia</label>
							</div>
							<div class="col-8">
								<input type="text" name="dependencia" disabled value="{{ $datos->dependencia }}" class="form-control">
							</div>
						</div>
						<div class="row mb-2">			
							<div class="col-4 text-left">
								<label class="col-form-label"  for="">Destino</label>
							</div>
							<div class="col-8">
								<input type="text" name="destino" disabled value="{{ $datos->destino }}" class="form-control">
							</div>
						</div>
						<div class="row mb-2">			
							<div class="col-4 text-left">
								<label class="col-form-label" for="">Plazo de entrega</label>
							</div>
							<div class="col-8">
								<input type="text" name="plazo_entrega" disabled value="{{ $datos->plazo_entrega }}" class="form-control">
							</div>
						</div>
					</div>
				</div>

				<div class="row p-3">
					<table class="table table-bordered">
					  <thead>
					    <tr class="text-center">
					      <th scope="col">CANTIDAD</th>
					      <th scope="col">CODIGO</th>
					      <th scope="col">DESCRIPCION</th>
					      <th scope="col">PRECIO UNIT.</th>
					      <th scope="col">TOTAL</th>
					      <th scope="col">ACCION</th>
					    </tr>
					  </thead> 
					  <tbody class="prin">
					  	@foreach ($datos->notapedidoRe as $dato)
					    <tr>
					      <td><input name="cantidad[]" disabled value="{{ $dato->cantidad }}" type="text" class="form-control" ></td>
					      <td><input name="codigo[]" disabled value="{{ $dato->codigo }}" type="text" class="form-control" ></td>
					      <td><input type="text" disabled value="{{ $dato->descripcion }}" name="descripcion[]" class="form-control" ></td>
					      <td><input type="text" disabled value="{{ $dato->precio_unit }}" name="precio_unit[]" class="form-control" ></td>
					      <td><input name="total[]" disabled value="{{ $dato->total }}" type="text" class="form-control" ></td>
					    </tr>
					    @endforeach
					  </tbody>
					</table>
				</div>
				<div class="row mb-3">
					<div class="col-4 align-self-center">
						<h4 class="">OBSERVACIONES</h4>
					</div>
					<div class="col-8">
						<input name="observaciones" disabled value="{{ $datos->observaciones }}" type="text" class="form-control">
					</div>
				</div>
				<div class="row justify-content-around">
					<div class="col-4 text-center">
						<input name="fabrica" type="text" disabled value="{{ $datos->fabrica }}" class="form-control">
						<label >Ing. Fabrica</label>
					</div>
					<div class="col-4 text-center">
						<input name="recibido" type="text" disabled value="{{ $datos->recibido }}" class="form-control">
						<label >Recibido</label>
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
                <input type="text" disabled value="{{ $relacion[0]->calificacion }}"class="form-control" name="calificacion" placeholder="Añada una nota al estudiante">
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
</form>
@endsection
@section('js')

	@endsection