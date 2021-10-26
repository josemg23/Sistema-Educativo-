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

		<div class="container">
				<h1 class="text-center text-danger  display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>

          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
           	<div class="row justify-content-center">
			{{-- <div class="col-6">
				
				<table class="table table-borderless">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">Cliente</th>
                      <th scope="col">RUC</th>
                      <th scope="col">Fecha de emision</th>
                      <th scope="col">Descuento</th>
                      <th scope="col">Guia de Remision</th>
                    </tr>
                  </thead>
                  <tbody>
               
                    <tr class="text-center">
                      <td>{{ $taller->cliente }}</td>
                      <td>{{ $taller->ruc }}</td>
                      <td>{{ $taller->fecha_emision }}</td>
                      <td>{{ $taller->descuento }}</td>
                      <td>{{ $taller->remision }}</td>
                    </tr>
               
                  </tbody>
                </table>

				<table class="table table-borderless">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">Codigo</th>
                      <th scope="col">Cod. Auxiliar</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Precio Unitario</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach ($taller->facturaDatos as $dato)
                    <tr class="text-center">
                      <th scope="row">{{ ++$i }}</th>
                      <td>{{ $dato->codigo }}</td>
                      <td>{{ $dato->cod_auxiliar }}</td>
                      <td>{{ $dato->cantidad }}</td>
                      <td>{{ $dato->descripcion }}</td>
                      <td>{{ $dato->precio }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
								 
			</div> --}}
			<div class="col-9 border border-danger">
				<div class="row p-3 justify-content-between">
					<div class="col-5">
					 	<img class="img-fluid" src="{{ asset('img/talleres/imagen-27.jpg') }}" alt="">
					 	<div class="row">
					 		<div class="col-12 rounded border-success border text-left">
					 			<h5>Venta de materiales de construccion</h5>
					 			<h6>Dirección Matriz :  Av. 17 de Septiembre</h6>
					 			<h6>Dirección  Sucursal :  Juan  Montalvo  y  24  de  Mayo</h6>
					 			<h6>Contribuyente Especial N°        25489</h6>
					 			<h6>OBLIGADO  A  LLEVAR  CONTABILIDAD   SI</h6>
					 		</div>
					 	</div>
					</div>

					<div class="col-6 rounded border-success border text-left p-2">

						<h6>R.U.C.  0925487699001</h6>
						<h5>FACTURA</h5>
						<h6>No. 001-001-000000002</h6>
						<h6>NÚMERO DE AUTORIZACIÓN: <br> 2101201710240109254876990011045896723</h6>
						<h6>FECHA Y HORA DE AUTORIZACIÓN <br>
						21/01/2017    10:24:01  a.m.</h6>
						<h6>AMBIENTE :  PRODUCCIÓN</h6>
						<h6>EMISIÓN :  NORMAL</h6>
						<h6>CLAVE DE ACCESO :</h6>
					</div>
				</div>
				<div class="row p-3 m-0 mb-2 border border-info">
					<div class="col-7">
						<div class="row">
							<div class="col-6"><h6>RAZÓN SOCIAL/NOMBRES Y APELLIDOS</h6></div>
							<div class="col-6"><input disabled value="{{ $datos->nombre }}" name="nombre" type="text " class="form-control"></div>
						</div>
						<div class="row">
							<div class="col-6"><label class="col-form-label" for="">FECHA EMISIÓN :</label></div>
							<div class="col-6"><input disabled value="{{ $datos->fecha_emision }}" name="fecha_emision" type="text " class="form-control"></div>
						</div>
					</div>
					<div class="col-5">
						<div class="row mb-3">
							<div class="col-5"><label class="col-form-label">R.U.C/C.I. :</label></div>
							<div class="col-7"><input disabled value="{{ $datos->ruc }}" name="ruc" type="text " class="form-control text-right"></div>
						</div>
						<div class="row">
							<div class="col-5"><label class="col-form-label" for="">GUÍA DE REMISIÓN :</label></div>
							<div class="col-7"><input disabled value="{{ $datos->emision }}" name="emision" type="text " class="form-control text-right"></div>
						</div>
					</div>
				</div>

				<div class="row p-3  mb-2 ">
					<table class="table table-bordered table-sm">
					  <thead>
					    <tr align="center">
					      <th scope="col">CÓDIGO</th>
					      <th scope="col">CÓD. AUXILIAR</th>
					      <th scope="col">CANT.</th>
					      <th scope="col">DESCRIPCION.</th>
					      <th scope="col">P. UNITARIO</th>
					      <th>DESCUENTO</th>
					      <th>VALOR VENTA</th>
					      <th></th>
					    </tr>
					  </thead>
					  <tbody class="prin">
                  	@foreach ($datos->facturaDato as $dato)

					  	<tr>
					  		<td width="100"> <input disabled value="{{ $dato->codigo }}" type="text" name="codigo[]" class="form-control text-right" required></td>
					  		<td width="100"><input disabled value="{{ $dato->cod_aux }}" type="text" name="cod_aux[]" class="form-control text-right" required></td>
					  		<td width="50"><input disabled value="{{ $dato->cantidad }}" type="text" name="cantidad[]" class="form-control text-right" required></td>
					  		<td ><textarea disabled name="descripcion[]" class="form-control" required>{{ $dato->descripcion }}</textarea> </td>
					  		<td width="50"><input disabled value="{{ $dato->precio }}" type="text" name="precio[]" class="form-control text-right" required></td>
					  		<td width="50"><input disabled value="{{ $dato->descuento }}" type="text" name="descuento[]" class="form-control text-right" required></td>
					  		<td width="75"><input disabled value="{{ $dato->valor }}" type="text" name="valor[]" class="form-control text-right" required></td>

					  	</tr>
					  	@endforeach
								  
					  </tbody>
					</table>
				</div>	
					<div class="row p-3  mb-2">
				<div class="col-6 border-danger border align-self-end">
					<h2 class="text-center">Informacion Adicional</h2>
					<div class="row mb-2">
						<div class="col-4"><label class="col-form-label" for="">Direccion</label></div>
						<div class="col-8"><input disabled value="{{ $datos->direccion }}" type="text" class="form-control" name="direccion"></div>
					</div>
					<div class="row mb-2">
						<div class="col-4"><label class="col-form-label" for="">Telefono</label></div>
						<div class="col-8"><input disabled value="{{ $datos->telefono }}" type="text" class="form-control" name="telefono"></div>
					</div>
					<div class="row mb-2">
						<div class="col-4"><label class="col-form-label" for="">Email</label></div>
						<div class="col-8"><input disabled value="{{ $datos->email }}" type="text" class="form-control" name="email"></div>
					</div>
				</div>
				<div class="col-6">
					<table class="table table-bordered">
					  
					  <tbody>
					    <tr>
					      <th scope="row">SUBTOTAL {{ $datos->iva }}%</th>
					      <td><input disabled value="{{ $datos->subtotal_12 }}" type="text" name="subtotal_12" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">SUBTOTAL 0%</th>
					      <td><input disabled value="{{ $datos->subtotal_0 }}" type="text" name="subtotal_0" class="form-control text-right"></td>
					      
					    </tr>
					    <tr>
					      <th scope="row">SUBTOTAL No objeto de IVA</th>
					      <td><input disabled value="{{ $datos->subtotal_iva }}" type="text" name="subtotal_iva" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">SUBTOTAL Exento de IVA</th>
					      <td><input disabled value="{{ $datos->subtotal_siniva }}" type="text" name="subtotal_siniva" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">SUBTOTAL SIN IMPUESTOS</th>
					      <td><input disabled value="{{ $datos->subtotal_sin_imp }}" type="text" name="subtotal_sin_imp" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">TOTAL DESCUENTO</th>
					      <td><input disabled value="{{ $datos->descuento_total }}" type="text" name="descuento_total" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">ICE</th>
					      <td><input disabled value="{{ $datos->ice }}" type="text" name="ice" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">IVA {{ $taller->iva }}%</th>
					      <td><input disabled value="{{ $datos->iva12 }}" type="text" name="iva12" class="form-control text-right"></td>
					    </tr>
					     <tr>
					      <th scope="row">IRBPNR</th>
					      <td><input disabled value="{{ $datos->irbpnr }}" type="text" name="irbpnr" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">PROPINA</th>
					      <td><input disabled value="{{ $datos->propina }}" type="text" name="propina" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">VALOR TOTAL</th>
					      <td><input disabled value="{{ $datos->valor_total }}" type="text" name="valor_total" class="form-control text-right"></td>
					    </tr>

					  </tbody>
					</table>

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
                <input type="text" disabled value="{{ $relacion[0]->calificacion }}" class="form-control" name="calificacion" placeholder="Añada una nota al estudiante">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Retroalimentacion</label>
                <textarea class="form-control" disabled name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }}</textarea>
              </div>   
               
            </div>
        </div>
        @endif
        </div>

@section('js')
@endsection
@endsection