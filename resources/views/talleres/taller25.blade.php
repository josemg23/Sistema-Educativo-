@extends('layouts.nav')
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
@endsection

@section('title', $datos->taller->nombre)
@section('content')

	<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->taller->nombre }}</h1>
    <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>

	<form action="{{ route('taller25', ['idtaller' => $d]) }}" method="POST" id="taller25">
          @csrf
		<div class="container">
		<div class="row justify-content-center">
			<div class="col-6">
					<h5 class="text-center">Datos</h5>
				<div class="row">
					<div class="col-6">
						<h6><strong>Cliente</strong> {{ $datos->cliente }}</h6>
						<h6><strong>RUC</strong> {{ $datos->ruc }}</h6>
						<h6><strong>Fecha de emision </strong> {{ $datos->fecha_emision }}</h6>
					</div>
					<div class="col-6">
						<h6><strong>Descuento</strong> {{ $datos->descuento }}</h6>
						<h6><strong>Guia de Remision</strong> {{ $datos->remision }}</h6>
						
					</div>
				</div>
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
                  	@foreach ($datos->facturaDatos as $dato)
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
								 
			</div>
			<div class="col-10" style="box-shadow: 5px 5px 15px 0px  #F42787">
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
							<div class="col-6"><input  name="nombre" type="text " class="form-control"></div>
						</div>
						<div class="row">
							<div class="col-6"><label class="col-form-label" for="">FECHA EMISIÓN :</label></div>
							<div class="col-6"><input  name="fecha_emision" type="text " class="form-control"></div>
						</div>
					</div>
					<div class="col-5">
						<div class="row mb-3">
							<div class="col-5"><label class="col-form-label">R.U.C/C.I. :</label></div>
							<div class="col-7"><input  name="ruc" type="text " class="form-control"></div>
						</div>
						<div class="row">
							<div class="col-5"><label class="col-form-label" for="">GUÍA DE REMISIÓN :</label></div>
							<div class="col-7"><input  name="emision" type="text " class="form-control"></div>
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
					  	<tr>
					  		<td width="100"> <input type="number" name="codigo[]" class="form-control text-right" ></td>
					  		<td width="100"><input type="text" name="cod_aux[]" class="form-control text-right" ></td>
					  		<td width="100"><input type="number" name="cantidad[]" class="form-control text-right" ></td>
					  		<td ><textarea  name="descripcion[]" class="form-control" ></textarea> </td>
					  		<td width="50"><input type="number" name="precio[]" class="form-control text-right" ></td>
					  		<td width="50"><input type="number" name="descuento[]" class="form-control text-right" ></td>
					  		<td width="75"><input type="number" name="valor[]" class="form-control text-right" ></td>
                      		<td><a href="#" class="btn btn-danger remove"><span class="glyphicon glyphicon-remove">X</span></a></td>

					  	</tr>
								  
					  </tbody>
					</table>
					<a href="#" class="addRow btn btn-outline-danger">Agregar Columna</a>
				</div>	
					<div class="row p-3  mb-2">
				<div class="col-6 border-danger border align-self-end">
					<h2 class="text-center">Informacion Adicional</h2>
					<div class="row mb-2">
						<div class="col-4"><label class="col-form-label" for="">Direccion</label></div>
						<div class="col-8"><input  type="text" class="form-control" name="direccion"></div>
					</div>
					<div class="row mb-2">
						<div class="col-4"><label class="col-form-label" for="">Telefono</label></div>
						<div class="col-8"><input  type="text" class="form-control" name="telefono"></div>
					</div>
					<div class="row mb-2">
						<div class="col-4"><label class="col-form-label" for="">Email</label></div>
						<div class="col-8"><input  type="text" class="form-control" name="email"></div>
					</div>
				</div>
				<div class="col-6">
					<table class="table table-bordered">
					  
					  <tbody>
					    <tr>
					      <th scope="row">SUBTOTAL {{ $datos->iva }}%</th>
					      <td><input  type="NUMBER" name="subtotal_12" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">SUBTOTAL 0%</th>
					      <td><input  type="NUMBER" name="subtotal_0" class="form-control text-right"></td>
					      
					    </tr>
					    <tr>
					      <th scope="row">SUBTOTAL No objeto de IVA</th>
					      <td><input  type="NUMBER" name="subtotal_iva" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">SUBTOTAL Exento de IVA</th>
					      <td><input  type="NUMBER" name="subtotal_siniva" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">SUBTOTAL SIN IMPUESTOS</th>
					      <td><input  type="NUMBER" name="subtotal_sin_imp" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">TOTAL DESCUENTO</th>
					      <td><input  type="NUMBER" name="descuento_total" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">ICE</th>
					      <td><input  type="NUMBER" name="ice" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">IVA {{ $datos->iva }}%</th>
					      <td><input  type="NUMBER" name="iva12" class="form-control text-right"></td>
					    </tr>
					     <tr>
					      <th scope="row">IRBPNR</th>
					      <td><input  type="NUMBER" name="irbpnr" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">PROPINA</th>
					      <td><input  type="NUMBER" name="propina" class="form-control text-right"></td>
					    </tr>
					    <tr>
					      <th scope="row">VALOR TOTAL</th>
					      <td><input  type="NUMBER" name="valor_total" class="form-control text-right"></td>
					    </tr>

					  </tbody>
					</table>

				</div>
			</div>

			</div>
		

		</div>
		
		<div class="row justify-content-center">
        		<input type="button" id="button" value="Enviar Respuesta" class="btn p-2 mt-3 mb-5 btn-danger">
    		 </div>
	</div>
	</form>

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
	<script type="text/javascript">
		$('.addRow').on('click', function(evt) {
			evt.preventDefault();
			addRow();
		});

		function addRow(){
			
			var tr='<tr>'+
			'<td><input type="text" name="codigo[]" class="form-control text-right" ></td>'+
			'<td><input type="text" name="cod_aux[]" class="form-control text-right" ></td>'+
			'<td><input type="text" name="cantidad[]" class="form-control" ></td>'+
			'<td><textarea  name="descripcion[]" class="form-control" ></textarea></td>'+
			'<td><input type="text" name="precio[]" class="form-control text-right" ></td>'+
			'<td><input type="text" name="descuento[]" class="form-control text-right" ></td>'+
			'<td><input type="text" name="valor[]" class="form-control text-right" ></td>'+
            '<td><a href="#" class="btn btn-danger remove"><span class="glyphicon glyphicon-remove">X</span></a></td>'
			'</tr>';
			$('.prin').append(tr);
		  toastr.success("Columna agregada correctamente", "Smarmoddle",{
		  	 "timeOut": "1000"
		  });

		}
		$('.remove').live('click', function(evt){
	evt.preventDefault();
      var last=$('.prin tr').length;
      if (last == 1) {
        toastr.error("Esta columna no se puede eliminar", "Smarmoddle",{
         "timeOut": "1000"
      });
      }else{
      $(this).parent().parent().remove();
       i = last;
}
    });

	</script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">

 $( "#button" ).click(function( event ) {
  event.preventDefault();
  Swal.fire({
  title: 'Seguro que deseas completar el taller?',
  text: "Esta accion ya no se puede revertir!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Completar!',
  cancelButtonText: 'Cancelar!'
}).then((result) => {
  if (result.isConfirmed) {
    $( "#taller25" ).submit();
  }
})
});

</script>
	@endsection
@endsection
