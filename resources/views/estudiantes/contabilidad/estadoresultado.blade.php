<div id="estado_resultado" class="border border-danger p-4">
	<h2 class="text-center display-4 font-weight-bold text-danger">Estado de Resultado</h2>
	<div class="row p-3  mb-2 justify-content-center ">
		<div class="col-5 mb-3">
			<h2 class="text-center font-weight-bold display-4">@{{ nombre }}</h2>
			<h4 class="text-center font-weight-bold display-4">@{{ fecha }}</h4>
			
		</div>
		
	</div>
	<div class="row">
		<div class="col-5"><h4>Ventas</h4></div>
		<div class="col-2 text-right"><span>@{{ decimales(venta) }}</span></div>
	</div>
	<div class="row">
		<div class="col-5"><h4>- Costos de Ventas</h4></div>
		<div class="col-2 border-danger text-right" style="border-bottom: solid; 2px">@{{ decimales(costo_venta) }}</div>
	</div>
	<div class="row">
		<div class="col-10"><h3 class="font-weight-bold text-info">Utilidad Bruta en Ventas</h3></div>
		<div class="col-2 text-right"><span class="badge badge-danger" style="font-size: 20px;">@{{ decimales(totales.utilidad_bruta_ventas) }}</span></div>
	</div>
	<div class="row mt-2">
		<div class="col-6">
			<h1 class="font-weight-bold pl-3">INGRESOS</h1>
			
		</div>
		<div class="col-12">
			<table>
				<tbody >
					<tr v-for="(balan, index) in ingresos">
						<td class="text-left" width="300">@{{ balan.cuenta}}</td>
						<td align="center">@{{ decimales(balan.saldo)}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row justify-content-between">
		<div class="col-10"><h3 class="font-weight-bold text-info">Total de ingresos</h3></div>
		<div class="col-2 text-right"><span class="badge badge-danger" style="font-size: 20px;">@{{ totales.ingreso }}</span></div>
	</div>
	<div class="row justify-content-between">
		<div class="col-10"><h3 class="font-weight-bold text-info">Utilidad Neta en Operaciones</h3></div>
		<div class="col-2 text-right"><span class="badge badge-danger" style="font-size: 20px;">@{{ totales.utilidad_neta_o }}</span></div>
	</div>
	<div class="row mt-2">
		<div class="col-6">
			<h1 class="font-weight-bold pl-3">GASTOS</h1>
		</div>
		<div class="col-12">
			<table>
				<tbody >
					<tr v-for="(balan, index) in gastos">
						<td class="text-left" width="300">@{{ balan.cuenta}}</td>
						<td align="center">@{{ decimales(balan.saldo)}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row justify-content-between mb-2">
		<div class="col-10"><h3 class="font-weight-bold text-info">Total de gastos</h3></div>
		<div class="col-2 text-right border-danger" style="border-bottom: solid 2px;"><span class="badge badge-danger" style="font-size: 20px; ">@{{ totales.gasto }}</span></div>
	</div>
	<div class="row justify-content-between">
		<div class="col-7">
			<select class="custom-select" v-model="utilidad" name="" id="" disabled="">
				<option selected="" disabled="" value="">ELEGIR UNA OPCION</option>
				<option value="utilidad_neta">UTILIDAD NETA DEL EJERCICIO</option>
				<option value="utilidad_perdida"> PERDIDA DEL EJERCICIO</option>
			</select>
		</div>
		<div class="col-3 text-right border-danger" style="border-bottom: solid 2px;"><span class="badge badge-danger" style="font-size: 20px; ">@{{ totales.utilidad_ejercicio }}</span></div>
	</div>
	<div class="mt-2 row justify-content-between" v-if="utilidad == 'utilidad_neta'">
		<div class="col-12">
			<table>
				<tbody>
					<tr v-for="(balan, index) in utilidades">
						<td class="text-left" width="750">@{{ balan.cuenta}}</td>
						<td align="center">@{{ decimales(balan.saldo)}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-12">
			<div class="row mt-2 justify-content-between">
				<div class="col-10">
					<h2 class="font-weight-bold">UTILIDAD LIQUIDA DEL EJERCICIO</h2>
				</div>
				<div class="col- text-right border-danger" style="border-bottom: solid 2px;"><span class="badge badge-danger" style="font-size: 20px; ">@{{ totales.utilidad_liquida }}</span></div>
			</div>
		</div>
	</div>
</div>