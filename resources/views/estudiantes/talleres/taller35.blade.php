@extends('layouts.nav')
@section('title', $datos->nombre)
@section('content')
<li class="d-none">
	@if (Auth::check())
	@foreach (auth()->user()->roles as $role)
	{{ $rol = $role->descripcion}}
	@endforeach
	@endif
</li>
{{-- >DESARROLLE  FÓRMULAS  DE  LA  ECUACIÓN  CONTABLE,  CON  EXACTITUD. --}}
<div class="container">
	<h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
	<div class="card border border-danger mb-3" >
		<div class="card-header font-weight-bold" style="font-size: 25px;">
		<h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>
		<div class="card-body">
			<h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
			<div class="row justify-content-center ">
				<div class="col-8">
					@foreach (json_decode($taller->datos) as $key => $ecuacion)
					
					<div class="row">
						<div class="col-5 text-center">
							<table class="table">
								<thead>
									<tr>
										<th colspan="2" scope="col">
											Activo <br>
											@isset ($ecuacion->activo)
											{{ $ecuacion->activo }}
											
											@else
											?
											@endisset
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											Pasivo <br>
											@isset ($ecuacion->pasivo)
											{{ $ecuacion->pasivo }}
											
											@else
											?
											@endisset
										</td>
										<td>
											Patrimonio <br>
											@isset ($ecuacion->patrimonio)
											{{ $ecuacion->patrimonio }}
											
											@else
											?
											@endisset
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-7 text-center  align-self-center">
							<span style="font-size: 20px" class="badge-primary badge text-justify">
								{!! nl2br($respuestas[$key]) !!}
								
							</span>
							{{-- 	<textarea cols="30" rows="3" class="form-control" name="respuesta[]">
							
							</textarea> --}}
							{{-- <input style="box-shadow: 5px 5px 15px 0px  #FF1C87;" type="text" name="formula1"   class="form-control"> --}}
						</div>
					</div>
					@endforeach
					
				</div>
			</div>
		</div>
		@if ($rol === 'estudiante')
		<div class="row justify-content-center">
			<div class="col-5">
				<div class="form-group">
					<label for="exampleFormControlInput1">Calificacion</label>
					{{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
					<input type="text"disabled value="{{ $relacion[0]->calificacion }}" class="form-control" name="calificacion" placeholder="Añada una nota al estudiante">
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
@endsection