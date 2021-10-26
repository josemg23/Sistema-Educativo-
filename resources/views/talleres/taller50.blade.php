@extends('layouts.nav')

@section('title', $datos->taller->nombre )
@section('content')

<!-- LENE  CON  LOS  SIGUIENTES  DATOS  LA  NOTA  DE  CREDITO, 
ADECUADAMENTE. -->
	<h1 class="text-center  mt-5 text-danger  font-weight-bold display-4">{{  $datos->taller->nombre }} </h1>
    <h3 class="text-center mt-5 mb-3 text-info"> {{ $datos->enunciado }}</h3>

<form action="{{ route('taller50', ['idtaller' => $d]) }}" method="POST" id="taller50">
          @csrf
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-8 mb-2" style="box-shadow: 5px 5px 15px 0px  #087980">
						<h3 class="text-center">Datos</h3>
							<div class="row">				
								<div class="col-6">
									<label>Pedido :</label> <span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->pedido  }}')" ondragend="this.classList.add('text-muted');">{{ $datos->pedido  }}</span> <br>
									<label>Lugar y fecha :</label> <span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->lugar  }}')" ondragend="this.classList.add('text-muted');">{{ $datos->lugar }}</span> , <span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->fecha }}')" ondragend="this.classList.add('text-muted');">{{ $datos->fecha }}</span> <br>

									<label>Firma de Bodeguero :</label> <span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->firma  }}')" ondragend="this.classList.add('text-muted');">{{ $datos->firma }}</span> <br>
									<label>Plazo de entrega :</label> <span draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '{{ $datos->plazo_entrega }}')" ondragend="this.classList.add('text-muted');">{{ $datos->plazo_entrega  }}</span><br>
								</div>
							</div>
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
			                  	@foreach ($datos->pedidoDatos as $dato)
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
			</div>

			<div class="col-9" style="box-shadow: 5px 5px 15px 0px  #27F4AE">
				<div class="row">
					<div class="col-6 text-center p-3">
						<h1>COMERCIAL "PLAZA"</h1>
						<img class="img-fluid" src="{{ asset('img/talleres/imagen-22.jpg') }}" alt="">
						<h5 class="text-left">RUC. 0923568947001</h5><h5 class="text-left">Av. Quito y letamendi</h5>
						<h5 class="text-left">Tlfs: 2580465 - 2413864</h5>
					</div>
					<div class="col-6 text-center p-3">
						<h1>NOTA DE PEDIDO</h1>
						<h4>No. <input  type="number" name="pedido" class="text-right" size="5"></h4>
						<div class="row mb-2">			
							<div class="col-4 text-left">
								<label class="col-form-label" for="">Fecha:</label>
							</div>
							<div class="col-8">
								<input  type="text" name="fecha" class="form-control">
							</div>
						</div>
						<div class="row mb-2">			
							<div class="col-4 text-left">
								<label class="col-form-label" for="">Dependencia</label>
							</div>
							<div class="col-8">
								<input  type="text" name="dependencia" class="form-control">
							</div>
						</div>
						<div class="row mb-2">			
							<div class="col-4 text-left">
								<label class="col-form-label" for="">Destino</label>
							</div>
							<div class="col-8">
								<input  type="text" name="destino" class="form-control">
							</div>
						</div>
						<div class="row mb-2">			
							<div class="col-4 text-left">
								<label class="col-form-label" for="">Plazo de entrega</label>
							</div>
							<div class="col-8">
								<input  type="text" name="plazo_entrega" class="form-control">
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
					    <tr>
					      <td><input  name="cantidad[]" type="number" class="form-control text-right" ></td>
					      <td><input  name="codigo[]" type="number" class="form-control text-right" ></td>
					      <td><input  type="text" name="descripcion[]" class="form-control" ></td>
					      <td><input  type="number" name="precio_unit[]" class="form-control text-right" ></td>
					      <td><input  name="total[]" type="number" class="form-control text-right" ></td>
					      <td><a href="#" class="btn btn-danger remove"><span class="glyphicon glyphicon-remove">X</span></a></td>
					    </tr>
					  </tbody>
					</table>
				<a href="#" class="addRow btn btn-outline-danger">Agregar Columna</a>
				</div>
				<div class="row mb-3">
					<div class="col-4 align-self-center">
						<h4 class="">OBSERVACIONES</h4>
					</div>
					<div class="col-8">
						<input  name="observaciones" type="text" class="form-control">
					</div>
				</div>
				<div class="row justify-content-around">
					<div class="col-4 text-center">
						<input  name="fabrica" type="text" name="" class="form-control">
						<label >Ing. Fabrica</label>
					</div>
					<div class="col-4 text-center">
						<input  name="recibido" type="text" name="" class="form-control">
						<label >Recibido</label>
					</div>
				</div>
			</div>
		</div>
			<div class="row justify-content-center mb-3">
        	<input type="button" id="button" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
    	</div>
	</div>
</form>
@endsection
@section('js')
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
	<script type="text/javascript">
		$('.addRow').on('click', function(evt) {
			evt.preventDefault();
			addRow();
		});
		function addRow(){	
		var tr='<tr>'+
			'<td><input  name="cantidad[]" type="number" class="form-control text-right" ></td>'+
			'<td><input  name="codigo[]" type="number" class="form-control text-right" ></td>'+
			'<td><input   type="text" name="descripcion[]" class="form-control" ></td>'+
			'<td><input  type="number" name="precio_unit[]" class="form-control text-right" ></td>'+
			'<td><input  name="total[]" type="number" class="form-control text-right" ></td>'+
			'<td><a href="#" class="btn btn-danger remove"><span class="glyphicon glyphicon-remove">X</span></a></td>'+
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
    $( "#taller50" ).submit();
  }
})
});

</script>

	@endsection
