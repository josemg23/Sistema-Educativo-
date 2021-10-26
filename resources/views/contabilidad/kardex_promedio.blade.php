<div id="kardex_promedio" class="border border-danger p-4">
	<div class=" row">
		<div class="col-3">
			<h6 class="font-weight-bold">Elegir Producto:</h6>
			<select v-model="producto_id" class="custom-select" name="" id="" @change="obtenerKardexPromedio()">
			<option disabled selected value="">ELIGE UN PRODUCTO</option>
			@if ($datos->metodo == 'concatenado')
				@foreach ($productos as $producto)
					<option :value="{{ $producto->id }}">{{ $producto->nombre }}</option>
				@endforeach
			@elseif($datos->metodo == 'individual')
				@foreach ($transacciones as $producto)
					<option :value="{{ $producto->id }}">{{ $producto->nombre }}</option>
				@endforeach
			@endif
		</select>
		</div>
	</div><br><br>
	<h1 class="text-center font-weight-bold text-danger">KARDEX</h1>
	<h5 class="text-center font-weight-bold text-info">METODO PROMEDIO</h5>

	<div class="row justify-content-center mb-2">
		<div class="col-5 mb-3">

			<input autocomplete="ÑÖcompletes" v-model="nombre" type="" name="" placeholder="Nombre de la empresa" class="form-control form-control-sm text-center">
			<input autocomplete="ÑÖcompletes" v-model="producto" type="" name="" placeholder="Producto" class="form-control text-center">

		</div>

		
 @if ($rol === 'estudiante' or 'docente')
 <div v-if="!transaccion.ingreso.edit && !transaccion.egreso.edit  && producto_id !== ''" class="col-12 text-center mb-3">
	<a {{-- v-if="transacciones.length == 0" --}} class="btn btn-sm btn-success mr-2" @click.prevent="modalInicial()">Saldo Inicial</a>
	<a  class="btn btn-sm btn-info mr-2" @click.prevent="modalTransacciones()">Agregar Ingreso / Egreso</a>
	<a href="" class="btn btn-primary btn-sm" @click.prevent="guardarKardex()">GUARDAR KARDEX</a>

</div>
@endif

	<table class="table table-bordered  table-sm">
		<thead class="bg-warning"> 
		  <tr class="text-center">
		    <th style="vertical-align:middle" rowspan="2" width="100">FECHA</th>
		    <th style="vertical-align:middle" rowspan="2" width="300">FACTURAS</th>
		    <th colspan="3">INGRESOS</th>
		    <th colspan="3">EGRESOS</th>
		    <th colspan="3">EXISTENCIA</th>
		    <th v-if="transacciones.length >= 1" style="vertical-align:middle" rowspan="2" colspan="2">ACCIONES</th>

		  </tr>
		  <tr class="text-center">
		    <td>CANT.</td>
		    <td>PREC. UNIT</td>
		    <td>TOTAL</td>
		    <td>CANT.</td>
		    <td>PREC. UNIT</td>
		    <td>TOTAL</td>
		    <td>CANT</td>
		    <td>PREC. UNIT</td>
		    <td>TOTAL</td>
		  </tr>
		</thead>
		<tbody  style="border-bottom: solid 3px #0F0101;">
			<tr v-for="(exist, id) in transacciones" >
				<td style="vertical-align:middle" >@{{ formatoFecha(exist.fecha) }}</td>
				<td style="vertical-align:middle" >@{{ exist.movimiento }}</td>
				<td style="vertical-align:middle" class="text-right">@{{ exist.ingreso_cantidad }}</td>
				<td style="vertical-align:middle" class="text-right">@{{ decimales(exist.ingreso_precio) }}</td>
				<td style="vertical-align:middle" class="text-right">@{{ exist.ingreso_total }}</td>
				<td style="vertical-align:middle" class="text-right">@{{ exist.egreso_cantidad }}</td>
				<td style="vertical-align:middle" class="text-right">@{{ decimales(exist.egreso_precio) }}</td>
				<td style="vertical-align:middle" class="text-right">@{{ exist.egreso_total }}</td>
				<td style="vertical-align:middle" class="text-right">@{{ exist.existencia_cantidad }}</td>
				<td style="vertical-align:middle" class="text-right">@{{ decimales(exist.existencia_precio) }}</td>
				<td style="vertical-align:middle" class="text-right">@{{ decimales(exist.existencia_total) }}</td>
				<td style="vertical-align:middle" v-if="transacciones.length >= 1 && transacciones[id].tipo == 'ingreso' || transacciones[id].tipo == 'inicial' || transacciones[id].tipo == 'egreso'"><a class="btn btn-sm btn-warning" href="" @click.prevent="editarTransaccion(id, exist.tipo)"><i class="fas fa-edit"></i></a></td>
				<td style="vertical-align:middle" v-if="transacciones.length >= 1 && transacciones[id].tipo == 'ingreso'  || transacciones[id].tipo == 'inicial' || transacciones[id].tipo == 'egreso'"><a class="btn btn-sm btn-danger" href="" @click.prevent="borrarTransaccion(id)"><i class="fas fa-trash"></i></a></td>
				<td style="vertical-align:middle" v-else colspan="2"></td>
			</tr>
		</tbody>

		<tbody>
		  <tr class="bg-secondary">
		    <td></td>
		    <td class="font-weight-bold text-danger">SUMAN</td>
		    <td class="text-right">@{{ suman.ingreso_cantidad }}</td>
		    <td></td>
		    <td class="text-right">@{{ suman.ingreso_total }}</td>
		    <td>@{{ suman.egreso_cantidad }}</td>
		    <td></td>
		    <td class="text-right">@{{ suman.egreso_total }}</td>
		    <td></td>
		    <td></td>
		    <td></td>
		  </tr>
		</tbody>
</table>
 	@include('contabilidad.modales.modalkardex_promedio')
 @if ($rol === 'estudiante' or 'docente')
 <div v-if="!transaccion.ingreso.edit && !transaccion.egreso.edit  && producto_id !== ''" class="text-center">

	<a {{-- v-if="transacciones.length == 0" --}} class="btn btn-sm btn-success mr-2" @click.prevent="modalInicial()">Saldo Inicial</a>
	<a  class="btn btn-sm btn-info mr-2" @click.prevent="modalTransacciones()">Agregar Ingreso / Egreso</a>
	{{-- <a  class="btn btn-sm btn-info mr-2" href="#" @click.prevent="modalEgreso()" data-toggle="modal" data-target="#egreso">EGRESO</a> --}}
	
</div>
	<div v-if="!transaccion.ingreso.edit && !transaccion.egreso.edit  && producto_id !== ''" class="col-12 mt-3">
		<div class="row justify-content-center">
			<div class="col-6 border rounded border-danger">
				<table class="table table-sm">
					<thead>
						<tr>
							<th width="200">PRUEBA</th>
							<th class="text-center text-danger">CANTIDAD</th>
							<th class="text-center text-danger">TOTAL</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Inventario Inicial de Mercaderias</td>
							<td><input autocomplete="ÑÖcompletes" v-model="prueba.cantidad.inventario_inicial" type="number" class="form-control form-control-sm text-right"></td>
							<td><input autocomplete="ÑÖcompletes" v-model="prueba.precio.inventario_inicial" type="number" class="form-control form-control-sm text-right"></td>
						</tr>
						<tr>
							<td>Adquisiciones</td>
							<td><input autocomplete="ÑÖcompletes" v-model="prueba.cantidad.adquicisiones" type="number" placeholder="+" class="form-control form-control-sm text-right text-right"></td>
							<td><input autocomplete="ÑÖcompletes" v-model="prueba.precio.adquicisiones" type="number" placeholder="+" class="form-control form-control-sm text-right text-right"></td>
						</tr>
						<tr>
							<td>(-) Ventas</td>
							<td><input autocomplete="ÑÖcompletes" v-model="prueba.cantidad.ventas" type="number" placeholder="-" class="form-control form-control-sm text-right text-right"></td>
							<td><input autocomplete="ÑÖcompletes" v-model="prueba.precio.ventas" type="number" placeholder="-" class="form-control form-control-sm text-right text-right"></td>
						</tr>
						<tr>
							<td>Inv. Final Mercaderia</td>
							<td><input autocomplete="ÑÖcompletes" v-model="prueba.cantidad.inventario_final" type="number" class="form-control form-control-sm text-right text-right"></td>
							<td><input autocomplete="ÑÖcompletes" v-model="prueba.precio.inventario_final" type="number" class="form-control form-control-sm text-right text-right"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div v-if="!transaccion.ingreso.edit && !transaccion.egreso.edit " class="row justify-content-center mt-2">
			<a href="" class="btn btn-primary" @click.prevent="guardarKardex()">GUARDAR KARDEX</a>
		</div>
		
	</div>
@endif
</div>
<div v-if="ingresos.length > 0 && transaccion.ingreso.edit ">
<table  class="table table-bordered table-responsive table-sm">
		<thead class="bg-warning"> 
		  <tr class="text-center">
		    <th style="vertical-align:middle" rowspan="2">FECHA</th>
		    <th style="vertical-align:middle" rowspan="2">MOVIMIENTOS</th>
		    <th colspan="3">INGRESOS</th>
		    <th colspan="3">EGRESOS</th>
		    <th colspan="3">EXISTENCIA</th>
		    {{-- <th style="vertical-align:middle" rowspan="2">ELIMINAR</th> --}}

		  </tr>
		  <tr class="text-center">
		    <td>CANT.</td>
		    <td>PREC. UNIT</td>
		    <td>TOTAL</td>
		    <td>CANT.</td>
		    <td>PREC. UNIT</td>
		    <td>TOTAL</td>
		    <td>CANT</td>
		    <td>PREC. UNIT</td>
		    <td>TOTAL</td>
		  </tr>
			</thead>
			<tbody>
				<tr v-for="(transa, id) in ingresos">
                    <td style="vertical-align:middle"><input autocomplete="ÑÖcompletes" type="date"   class="form-control-sm form-control-plaintext" v-model=" transa.fecha"></td>
                          <td v-if="transa.tipo != 'existencia'">
                               <textarea style="vertical-align:middle" cols="30" rows="3" class="form-control form-control-plaintext text-center" v-model="transa.movimiento"></textarea>
                              {{-- <input autocomplete="ÑÖcompletes" type="text"  class="form-control-sm form-control-plaintext" v-model="transa.movimiento"> --}}
                          </td>
					<td style="vertical-align:middle"  class="text-right"><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_cantidad" @keyup.enter="totalIng(id)"></td>
					<td style="vertical-align:middle"  class="text-right"><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_precio" @keyup.enter="totalIng(id)"> </td>
					<td style="vertical-align:middle" class="text-right">@{{ transa.ingreso_total }}</td>
					<td style="vertical-align:middle" class="text-right"><input autocomplete="ÑÖcompletes" type="number" v-if="transa.egreso_cantidad" class="form-control-sm form-control-plaintext" v-model="transa.egreso_cantidad"></td>
					<td style="vertical-align:middle" class="text-right"><input autocomplete="ÑÖcompletes" type="number" v-if="transa.egreso_precio" class="form-control-sm form-control-plaintext" v-model="transa.egreso_precio"></td>
					<td style="vertical-align:middle" class="text-right">@{{ transa.egreso_total }}</td>
					<td style="vertical-align:middle" class="text-right"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_cantidad"></td>
					<td style="vertical-align:middle" class="text-right"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_precio"></td>
					{{-- <td v-if="!actuingreso.estado">@{{ transa.existencia_total }}</td> --}}
					<td style="vertical-align:middle" class="text-right"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_total"></td>
					{{-- <td><a href="#" class="btn btn-sm btn-danger" @click.prevent="borrarIngreso(id, 'ingreso')"> <i class="fas fa-trash"></i></a></td> --}}
				</tr>
			</tbody>
</table>
	<div class="row justify-content-center">
		<a class="btn btn-sm btn-primary mr-2" href="" @click.prevent="actualizarIngreso()">Actualizar Transaccion</a>
		<a class="btn btn-sm btn-warning mr-2"  href="" @click.prevent="cancelarActualizacion('ingresos')">Cancelar</a>

	</div>
</div>

		<div v-if="egresos.length > 0 && transaccion.egreso.edit">
			<table  class="table table-bordered table-responsive table-sm">
					<thead class="bg-warning"> 
					  <tr class="text-center">
					    <th style="vertical-align:middle" rowspan="2">FECHA</th>
					    <th style="vertical-align:middle" rowspan="2">MOVIMIENTOS</th>
					    <th colspan="3">INGRESOS</th>
					    <th colspan="3">EGRESOS</th>
					    <th colspan="3">EXISTENCIA</th>
					    {{-- <th style="vertical-align:middle" rowspan="2">ELIMINAR</th> --}}
					  </tr>
					  <tr class="text-center">
					    <td>CANT.</td>
					    <td>PREC. UNIT</td>
					    <td>TOTAL</td>
					    <td>CANT.</td>
					    <td>PREC. UNIT</td>
					    <td>TOTAL</td>
					    <td>CANT</td>
					    <td>PREC. UNIT</td>
					    <td>TOTAL</td>
					  </tr>
						</thead>
						<tbody>
							<tr v-for="(transa, id) in egresos">
							  <td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="date"   class="form-control-sm form-control-plaintext" v-model=" transa.fecha"></td>
                          <td style="vertical-align:middle"  v-if="transa.tipo != 'existencia'">
                               <textarea style="vertical-align:middle" cols="30" rows="3" class="form-control form-control-plaintext text-center" v-model="transa.movimiento"></textarea>
                              {{-- <input autocomplete="ÑÖcompletes" type="text"  class="form-control-sm form-control-plaintext" v-model="transa.movimiento"> --}}
                          </td>
								<td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="number"  v-if="transa.ingreso_cantidad !== ''" class="form-control-sm form-control-plaintext" v-model="transa.ingreso_cantidad" ></td>
								<td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="number" v-if="transa.ingreso_precio !== ''"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_precio" > </td>
								<td style="vertical-align:middle"  class="text-right">@{{ transa.ingreso_total }}</td>
								<td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.egreso_cantidad" @keyup.enter="totaEgre(id)"></td>
								<td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.egreso_precio" @keyup.enter="totaEgre(id)"></td>
							
								<td style="vertical-align:middle"  class="text-right">@{{ transa.egreso_total }}</td>
								<td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_cantidad"></td>
								<td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_precio"></td>
								{{-- <td v-if="!actuegreso.estado">@{{ transa.existencia_total }}</td> --}}
								<td style="vertical-align:middle"  class="text-right"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_total"></td>
								{{-- <td v-if="transa.tipo == 'existencia'"><a href="#"   class="btn btn-sm btn-danger" @click.prevent="borrarEgresoAct(id, 'existencia')"> <i class="fas fa-trash"></i></a></td>
								<td v-if="transa.tipo == 'egreso_compra'"><a href="#"   class="btn btn-sm btn-danger" @click.prevent="borrarEgresoAct(id, 'egreso_compra')"> <i class="fas fa-trash"></i></a></td>
								<td v-if="transa.tipo == 'egreso'"><a href="#"   class="btn btn-sm btn-danger" @click.prevent="borrarEgresoAct(id, 'egreso')"> <i class="fas fa-trash"></i></a></td> --}}
							</tr>
						</tbody>
			</table>
			<div  class="row justify-content-center">
				<a class="btn btn-sm btn-primary mr-2"  href="" @click.prevent="actualizarEgreso()">Actualizar Transaccion</a>
			<a class="btn btn-sm btn-warning mr-2"  href="" @click.prevent="cancelarActualizacion('egresos')">Cancelar</a>

			</div>
	
		</div>

</div>