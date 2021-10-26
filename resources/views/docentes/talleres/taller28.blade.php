@extends('layouts.nav')

@section('title', $datos->nombre)
@section('content')


   <form action="{{ route('taller1.docente',  ['idtaller' => $d]) }}" method="POST">
           @csrf
	<div class="container mb-3">
			<h1 class="text-center  text-danger">{{ $datos->nombre }}</h1>
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
          					<td >@isset($fecha->fecha_entrega)
                      @if ($update_imei->pivot->fecha_entregado <= $fecha->fecha_entrega)
                      <span class="badge badge-success">PUNTUAL</span>
                      @else
                      <span class="badge badge-danger">ATRASADO</span>
                      @endif 
                     @endisset </td>
          				</tr>
          			</table>
          		</div>
          	</div>

          </div>
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
           		<div class="row justify-content-center">
			<div class="col-8 border border-danger p-3">
				<div class="row justify-content-end">
					<div  class="col-6 mt-3">
						<h4 draggable="true">Señor  Ingeniero.</h4>
						<h3>Sergio  Castro  Montero.</h3>
						<h4>GERENTE  DE  “DINAMO”.</h4>
						<h5>Ciudad.</h5>
						<h5>Estimado <strong>Señor</strong> </h5>
					</div>
					<div class="col-6">
						<h4>Guayaquil,  15  de  Julio  del  2019</h4>
					</div>
				</div
>				<div class="row">
					<div class="col-12">
						<p class="text-justify" style="font-size: 16px;">La  presente  tiene  por  objeto  saludarlo  y  a  la  vez  solicitarle  me envíe  la  <strong>cuenta</strong>  de  los  pedidos  según  <strong>Factura  número</strong>   1830 correspondiente  al <strong>presente</strong>    mes,  con  el  detalle  de  cada  uno  de los <strong>artículos</strong> artículos  entregados.  La  <strong>Factura</strong>   contiene  15  cocinas,  con las  características  ya  señaladas.    El  valor  de  la <strong>Factura</strong>    asciende  a  la  cantidad  de  $ 4.800  dicho  valor  será  depositado en  su <strong>cuenta  corriente </strong> </p>
						<p class="text-justify" style="font-size: 16px;">Nos  despedimos  de <strong> usted </strong> no  sin  antes  reiterarle  nuestra consideración  y  estima</p>
					</div>

				</div>
				<div class="row ">
					<div class="col-12 text-center">
						<h2>Cordialmente</h2>
						<h5>Ingeniero  David  Reinoso</h5>
						<h3>GERENTE  ADMINISTRATIVO</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-8">
						<h3 class="mt-3">Convertir</h3>
			</div>
		</div>


		<div class="row justify-content-center">
			<div class="col-8 border border-danger p-3">
				<div class="row justify-content-end">
					<div class="col-6 mt-3">
						<h4>Señor  Ingeniero.</h4>
						<h3>Sergio  Castro  Montero.</h3>
						<h4>GERENTE  DE  “DINAMO”.</h4>
						<h5>Ciudad.</h5>
						<h5>Estimado <strong>Señor</strong> </h5>
					</div>
					<div class="col-6">
						<h4>Guayaquil,  15  de  Julio  del  2019</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-12 form-inline">
						<p class="text-justify" style="font-size: 16px;">La  presente  tiene  por  objeto  saludarlo  y  a  la  vez  solicitarle  me envíe  la <strong style="font-size: 25px;" class=" text-danger">{{ $datos->abreviatura1 }}</strong>   de  los  pedidos  según  <strong style="font-size: 25px;" class=" text-danger">{{ $datos->abreviatura2 }}</strong>   1830 correspondiente  al <strong style="font-size: 25px;" class=" text-danger">{{ $datos->abreviatura3 }}</strong>    mes,  con  el  detalle  de  cada  uno  de los <strong style="font-size: 25px;" class=" text-danger">{{ $datos->abreviatura4 }}</strong> artículos  entregados.  La  <strong style="font-size: 25px;" class=" text-danger">{{ $datos->abreviatura5 }}</strong>   contiene  15  cocinas,  con las  características  ya  señaladas.    El  valor  de  la <strong style="font-size: 25px;" class=" text-danger">{{ $datos->abreviatura6 }}</strong>    asciende  a  la  cantidad  de  $ 4.800  dicho  valor  será  depositado en  su <strong style="font-size: 25px;" class=" text-danger">{{ $datos->abreviatura7 }}</strong> </p>
						<p class="text-justify" style="font-size: 16px;">Nos  despedimos  de <strong style="font-size: 25px;" class=" text-danger">{{ $datos->abreviatura8 }}</strong> no  sin  antes  reiterarle  nuestra consideración  y  estima</p>
					</div>

				</div>
				<div class="row ">
					<div class="col-12 text-center">
						<h2>Cordialmente</h2>
						<h5>Ingeniero  David  Reinoso</h5>
						<h3>GERENTE  ADMINISTRATIVO</h3>
					</div>
				</div>
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