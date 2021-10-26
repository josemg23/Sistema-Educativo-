@extends('layouts.nav')

@section('title', $datos->taller->nombre)
@section('content')
<!-- LLENE  CON  LOS  SIGUIENTES  DATOS  LOS  CERTIFICADOS DE DEPÓSITO 
ADECUADAMENTE -->
   <li class="d-none">
        @if (Auth::check())
        @foreach (auth()->user()->roles as $role)
        {{ $rol = $role->descripcion}}
        @endforeach
        @endif
    </li>
	<div class="container">
		<h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>

          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
       					<div class="row justify-content-center">
			<div class="col-10 border border-warning">
				<div class="row justify-content-center">
						<div class="col-10 p-2  ">
							<div class="row">
								<div class="col-4">
									<h2>NO 017</h2>
								</div>
								<div class="col-4 text-center mt-2">
								<strong><h5 class="text-danger">CERTIFICADO DE DEPOSITO</h5></strong>	
								</div>
								<div class="col-4">
									<h5>BANCO DE MACHALA</h5>
								</div>
							</div>
							<div class="row p-1">
								<div class="col-6 form-inline">
									<p class="col-form-label" for="">Valor incial <input required  type="text" disabled value="{{ $datos->valor_inicial }}" class="form-control form-control-sm"></p> 
								</div>
								<div class="col-6 form-inline" >
									<p class="col-form-label" for="">CARACTER <input required  type="text" class="form-control " disabled value="{{ $datos->caracter }}">
										<h6 class="text-center">(Nominativa o a la orden )</h6>
									</p>
									
								</div>
							</div>
							<div class="row">
								<p class="form-inline text-justify">En  virtud  de  la  Facultad  contenida  en  el  numeral  séptimo  del  artículo  215  de  la  Ley  General  de Banco,  el  BANCO DE MACHALA,  emite  el  presente  Certificado  de  Depósito  y  reconoce  que  pagará contra presentacion de este titulo a <input required  type="text" disabled value="{{ $datos->beneficiario }}" class="form-control form-control-sm m-1" size="60">, cantidad de: <input required  type="text" disabled value="{{ $datos->cantidad }}" class="form-control form-control-sm m-1 text-right"> Dolares en el plazo de <input required  type="text" disabled value="{{ $datos->plazo }}" class="form-control form-control-sm m-1" size="3"> dias, a partir de <input required  type="date" size="10" disabled value="{{ $datos->fecha_de_emision }}" class="form-control form-control-sm m-1"> hasta el <input required  type="date" disabled value="{{ $datos->fecha_de_vencimiento }}" size="10" class="form-control form-control-sm m-1"> reconocimiento el interes actual del <input required  type="text" disabled value="{{ $datos->interes_anual }}" class="form-control form-control-sm m-1 text-right" size="3" disabled value=""> que  será  pagadero  en <input required  disabled value="{{ $datos->plazo_de_vencimiento }}" type="text" class="form-control form-control-sm m-1" size="2"> dias
								</p>
								<p class="text-justify">El  Banco de Machala  declara  que  éste  Certificado de  Depósito  no es renovable  y  que dejará  de ganar  interés desde  la  fecha  de  su  vencimiento.
								El  propietario  de  este título  acepta  las condiciones estipuladas y se somete a lo  dispuesto  en  la  Ley General  de  Bancos  y  a  la  Resolución  No.  90-020  de la Superintendencia  de  Bancos  y  sus posteriores  modificatorias.</p>
							</div>
							<div class="row justify-content-end">
								<div class="col-8 text-center">
									<input required  type="text" disabled value="{{ $datos->lugar_fecha_emision }}" class="form-control form-control-sm">
									<h6 for="">Lugar y fecha de emision</h6>
								</div>
							</div>
							<div class="row justify-content-between">
								<div class="col-5 text-center">
									<input required  type="text" value="ING. JUAN PEREZ" disabled="" class="form-control form-control-sm text-center" disabled>
									<h6>FIRMA AUTORIZADA</h6>
								</div>
								<div class="col-5 text-center">
									<input required  type="text" value="ING. JOSE MAYA" disabled="" class="form-control form-control-sm text-center" disabled>
									<h6>FIRMA AUTORIZADA</h6>
								</div>
							</div>
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
                <textarea class="form-control" disabled="" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion"> {{ $relacion[0]->retroalimentacion }}</textarea>
              </div>   
         
            </div>
        </div>
        @endif
        </div>
	</div>
@endsection