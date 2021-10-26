@extends('layouts.nav')

@section('title',  $datos->nombre )
@section('content')



  <form action="{{ route('taller1.docente', ['idtaller' => $d]) }}" method="POST">
           @csrf
	<div class="container mb-4">
			<h1 class="text-center text-danger"> {{ $datos->nombre }}</h1>
		<div class="row justify-content-center">
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
                     @endisset </td>
          				</tr>
          			</table>
          		</div>
          	</div>

          </div>
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
            	{{-- <h5 class="text-muted">Las respuestas que estan en verde, estan correctas</h5> --}}
            <div class="row justify-content-center">
           
          <div class="col-8 p-3" style="box-shadow: 5px 5px 15px 0px  #E81853;">
				<ul class="nav justify-content-center">
<li  class="badge badge-primary nav-item m-2 text-wrap">Cheque</li>

<li  class="badge badge-primary nav-item m-2 text-wrap">Cuenta</li>

<li  class="badge badge-primary nav-item m-2 text-wrap">Factura</li>

<li  class="badge badge-primary nav-item m-2 text-wrap">Artículos</li>

<li  class="badge badge-primary nav-item m-2 text-wrap">Doctora</li>

<li  class="badge badge-primary nav-item m-2 text-wrap">Factura</li>

<li  class="badge badge-primary nav-item m-2 text-wrap">Presente</li>

<li  class="badge badge-primary nav-item m-2 text-wrap">Economista</li>

<li  class="badge badge-primary nav-item m-2 text-wrap">Factura</li>

<li  class="badge badge-primary nav-item m-2 text-wrap">Cuenta corriente</li>

<li  class="badge badge-primary nav-item m-2 text-wrap">Ustedes</li>

<li  class="badge badge-primary nav-item m-2 text-wrap">Banco</li>

<li  class="badge badge-primary nav-item m-2 text-wrap">Remesa</li>

<li class="badge badge-primary nav-item m-2 text-wrap">Compañía</li>
				</ul>
				
			</div>
            	
            <div class="col-7 border border-danger mt-3">
				<div class="row p-2">
					<div class="col-4">
						<img class="img-fluid" src="{{ asset('img/talleres/imagen-29.jpg') }}" alt="">
					</div>
					<div class="col-5 text-center">
						<h1 class="text-danger"><strong>COMUNICADO</strong></h1>
						<h5>“IMPORTADORA GARY S.A.”</h5>
						<h5>TELF: 2415287 - 2425689</h5>
					</div>
					<div class="col-6">
						<p>Guayaquil, 25 de Octubre del 201</p> 
						<p>
							Doctora  <br>
							Carolina Robles <br>
							Gerente de "COMERCIAL XAVI” <br>
							Ciudad.
						</p>
					</div>
					<div class="col-12 form-inline">
						<p>Estimada <span class="badge badge-success">{{ $datos->abreviatura1 }}</span></p>
						
					</div>
					<div class="col-12 form-inline">
						<p class="text-justify">Es grato enviarle la <span class="badge badge-success">{{ $datos->abreviatura2 }}</span> o. 124 correspondiente  a cuatro  bultos  de mercaderías  que  hemos  enviado  por  vía terrestre, utilizando transportes ECUADOR, el 3 de Mayo del <span class="badge badge-success">{{ $datos->abreviatura3 }}</span> año</p>
					</div>
					<div class="col-12 form-inline">
						<p class="text-justify">
							Esta <span class="badge badge-success">{{ $datos->abreviatura4 }}</span> contiene <span class="badge badge-success">{{ $datos->abreviatura5 }}</span> con  las  características señaladas  por <span class="badge badge-success">{{ $datos->abreviatura6 }}</span> a  nuestra <span class="badge badge-success">{{ $datos->abreviatura7 }}</span>
						</p>
					</div>
					<div class="col-12 form-inline">
						<p class="text-justify">
							El  valor  de  la <span class="badge badge-success">{{ $datos->abreviatura8 }}</span> asciende  a  la  cantidad  de $ 8.500; la hemos cargado a su <span class="badge badge-success">{{ $datos->abreviatura9 }}</span> ogando nos envíe  un <span class="badge badge-success">{{ $datos->abreviatura10 }}</span> certificado  por  dicho  valor.
						</p>
					</div>
					<div class="col-12 form-inline">
						<p class="text-justify">
							De  no  ser  posible  esperamos  que  el  valor  de  la <span class="badge badge-success">{{ $datos->abreviatura11 }}</span> lo  deposite  en  nuestra <span class="badge badge-success">{{ $datos->abreviatura12 }}{{ $datos->abreviatura13 }}</span> del <span class="badge badge-success">{{ $datos->abreviatura14 }}</span> Produbanco  No. 40035873.
						</p>
					</div>
					<div class="col-12">
						<p class="text-justify">
							Sin  otro  particular  por  el  momento  aprovechamos  la oportunidad  para  reiterarles  nuestras  consideraciones  y aprecio.
						</p>
					</div>
					<div class="col-5 text-center">
						<h4>Cordialmente,</h4>
						<p>Diana  Flores <br>
						Gerente General</p>
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
	</div>
</form>
@endsection