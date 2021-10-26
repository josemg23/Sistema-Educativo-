@extends('layouts.nav')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
@endsection
@section('title', $datos->taller->nombre)
@section('content')
  <li class="d-none">
        @if (Auth::check())
        @foreach (auth()->user()->roles as $role)
        {{ $rol = $role->descripcion}}
        @endforeach
        @endif
    </li>

<!-- LLENE  CON  LOS  SIGUIENTES  DATOS  LA  ORDEN  DE  PAGO CORRECTAMENTE-->
	<div class="container">
			<h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
            	
		<div class="row justify-content-center">
	{{-- 		<div class="col-10">
						<h5 class="text-center">Datos</h5>
				<div class="row">
					<div class="col-6">
						<h6><strong>Nombre</strong> {{ $taller->nombre }}</h6>
						<h6><strong>RUC</strong> {{ $taller->ruc }}</h6>
						<h6><strong>Fecha de emision </strong> {{ $taller->fecha }}</h6>
					</div>
				</div>
				<table class="table table-borderless">
                  <thead class="table-dark">
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Precio Unitario</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach ($taller->notaventaDatos as $dato)
                    <tr class="text-center">
                      <th scope="row">{{ ++$i }}</th>
                      <td>{{ $dato->cantidad }}</td>
                      <td>{{ $dato->descripcion }}</td>
                      <td>{{ $dato->precio }}</td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
			</div> --}}
			<div class="col-8 border border-danger p-5">
				<div class="row ">
					<div class="col-6 text-center">
						<h1>TECNOLOGY  S.A.</h1>
						<h6>Ing. Diego Arcos Quezada <br>
							Contribuyente Régimen Simplificado</h6>

						<h5>Dirección  Matriz :  Malecón y Olmedo</h5>
					</div>
					<div class="col-6">
						<table class="table table-bordered">
						  <tbody>
						 <tr>
						 	<td>R.U.C</td>
						 	<td>0938489125001</td>
						 </tr>
						 <tr>
						 	<td colspan="2" align="center">
						 		NOTA DE VENTA <br>
						 		<h6>No. 002-3470</h6>
						 	</td>					 	
						 </tr>
						 <tr>
						 	<td>AUT. SRI:</td>
						 	<td>241899176
						 	</td>
						 </tr>
						  </tbody>
						</table>
					</div>
				</div>
				<div class="row mb-2">
				</div>
				<div class="row">
					<div class="col-2 text-right"> <label>Sr (es):</label> </div>
					<div class="col-4"> <input type="text" class="form-control" disabled value="{{ $datos->nombre }}" name="nombre"></div>
					<div class="col-2 text-right"> <label>R.U.C/C.I. :</label> </div>
					<div class="col-4"> <input type="text" class="form-control text-right" disabled value="{{ $datos->ruc }}" name="ruc"></div>
				</div>
				<div class="row justify-content-start mt-2">
					<div class="col-2 text-right">
						<label for="">FECHA :</label>
					</div>
					<div class="col-5">
						<input disabled value="{{ $datos->fecha }}" name="fecha" type="text" class="form-control">
					</div>
				</div>
				<div class="row mt-4">
					<table class="table table-bordered">
					  <thead>

					    <tr align="center">
					      <th scope="col">CANT.</th>
					      <th scope="col">DESCRIPCIÓN</th>
					      <th scope="col">P. UNITARIO </th>
					      <th scope="col">VALOR VENTA</th>
					    </tr>

					  </thead>
					  <tbody class="prin">
                  	@foreach ($datos->notavDatos as $dato)
					    <tr>
					      <th><input type="text" class="form-control text-right" disabled value="{{ $dato->cantidad }}" name="cantidad[]"></th>
					      <td><input type="text" class="form-control" disabled value="{{ $dato->descripcion }}" name="descripcion[]"></td>
					      <td><input type="text" class="form-control text-right" disabled value="{{ $dato->precio }}" name="precio[]"></td>
					      <td><input type="text" class="form-control text-right" disabled value="{{ $dato->valor_venta }}" name="valor_venta[]"></td>
					    </tr>
					   @endforeach
					  </tbody>
					</table>
				</div>
				<div class="row justify-content-end mb-2">
					<div class="col-3 text-right"><label for="">VALOR TOTAL</label></div>
					<div class="col-3"><input type="text" disabled value="{{ $datos->total }}" name="total" class="form-control text-right"> </div>
				</div>
				<div class="row mb-2 justify-content-end">
					<label for="">VÁLIDO PARA SU EMISIÓN HASTA FEBRERO/2021</label>
				</div>
				<div class="row mb-2 justify-content-start">
					<div class="col-6 text-center">
						<h6>Imprenta  Falcao</h6>
						<h6>RUC:  0957742891001 No. Autorización 0518</h6>
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

@section('js')
@endsection
@endsection