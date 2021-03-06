@extends('layouts.nav')


@section('title', $datos->taller->nombre)
@section('content')
   <li class="d-none">
        @if (Auth::check())
        @foreach (auth()->user()->roles as $role)
        {{ $rol = $role->descripcion}}
        @endforeach
        @endif
    </li>

<!-- LLENE  CON  LOS  SIGUIENTES  DATOS  LOS  VALES,  CORRECTAMENTE. -->

	<div class="container">
			<h1 class="text-center text-danger  display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>

          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
       				<table class="table mb-3">
			<thead >
				<tr class=" text-center thead-dark">
					 <th>Valor</th>
					<th>Deudor</th>
					<th>Detalle</th>
					<th>Lugar y fecha</th>
				</tr>
			
			</thead>
			<tbody>
				<tr class="text-center">
					<td>{{ $taller->valor }}</td>
					<td>{{ $taller->deudor }}</td>
					<td>{{ $taller->detalle}}</td>
					<td>{{ $taller->fecha}}</td>
				</tr>
			</tbody>
		</table>
		<div class="row justify-content-center">
			<div class="col-9 border border-warning">
				<div class="row justify-content-end">
					<div class="col-12 text-center mt-2">
						<h2>VALE DE CAJA</h2>
					</div>
					<div class="col-4 form-inline">
						<label for="">Por $ </label> <input type="text" name="por"  disabled value="{{ $datos->por }}" class="form-control form-control-sm" size="20">
					</div>
				</div>
				<div class="row justify-content-center mt-1">
					<div class="col-12">
						<div class="row justify-content-start">
							<div class="col-3"><label for="">A favor de </label> </div>
							<div class="col-9"><input type="text" name="deudor"  disabled value="{{ $datos->deudor }}" class="form-control form-control-sm"></div>
						</div>
						
					</div>
				</div>
				<div class="row justify-content-center mt-1">
					<div class="col-12">
						<div class="row justify-content-start">
							<div class="col-3"><label for="">Por la cantidad de </label> </div>
							<div class="col-9"><input name="cantidad" type="text"  disabled value="{{ $datos->cantidad }}" class="form-control form-control-sm"></div>
						</div>
						
					</div>
				</div>
				<div class="row justify-content-center mt-1">
					<div class="col-12">
						<div class="row justify-content-start">
							<div class="col-3"><label for="">A concepto de </label> </div>
							<div class="col-9"><input name="concepto" type="text"  disabled value="{{ $datos->concepto }}" class="form-control form-control-sm"></div>
						</div>
						
					</div>
				</div>
				<div class="row justify-content-end mt-2">
					<div class="col-6 text-center">
						<input type="date" name="fecha"  disabled value="{{ $datos->fecha }}" class="form-control form-control-sm" >
						<label for="">Fecha</label>
					</div>
				</div>
				<div class="row justify-content-lg-between">
					<div class="col-4 text-center">
						<input name="vto_bueno" type="text" disabled  value="{{ $datos->vto_bueno }}" class="form-control form-control-sm" >
						<label >Vto. Bno.</label>
					</div>
					<div class="col-4 text-center">
						<input name="conforme" type="text"  disabled value="{{ $datos->conforme }}" class="form-control form-control-sm" >
						<label >Recibi conforme</label>
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
                <input type="text" disabled value="{{ $relacion[0]->calificacion }}" class="form-control" name="calificacion" placeholder="A??ada una nota al estudiante">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Retroalimentacion</label>
                <textarea class="form-control" disabled="" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{  $relacion[0]->retroalimentacion }}</textarea>
              </div> 
            </div>
        </div>
        @endif
        </div>


	</div>

@endsection