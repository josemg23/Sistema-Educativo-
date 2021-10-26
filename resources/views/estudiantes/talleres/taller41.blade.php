@extends('layouts.nav')

@section('title',  $datos->nombre )
@section('content')
       <li class="d-none">
        @if (Auth::check())
        @foreach (auth()->user()->roles as $role)
        {{ $rol = $role->descripcion}}
        @endforeach
        @endif
    </li>
	<div class="container mb-5">
	<h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>
          	
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>

           <div class="row justify-content-center mb-2">
			<div class="col-10">
				<div class="row justify-content-center">
					<div class="col-6  align-self-center">
						<h4  class="text-center bg-success p-2 rounded">FORMAS DE TRANSACCIONES</h4 >
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-4 align-self-center">
						<h5 class="bg-warning border border-secondary p-1 rounded text-center">VENDER</h5>
						<h4 class="font-weight-bold text-center"> {{ $datos->vender }}</h4>
					</div>
					<div class="col-4 text-center">
						<img class="img-fluid" src="{{ asset('img/talleres/imagen-32.jpg') }}" alt="">
					</div>
					<div class="col-4 align-self-center">
						<h5 class="bg-warning border border-secondary p-1 rounded text-center">COMPRAR</h5>
						<h4 class="font-weight-bold text-center"> {{ $datos->vender }}</h4>
					</div>
				</div>
				<div class="row justify-content-lg-between">
					<div class="col-3 align-self-center text-center border-danger border p-3">
						<h5>1</h5>
					
							<h4 class="font-weight-bold text-center"> {{ $datos->seccion1a }}</h4>

							<img class="img-fluid mb-1 mt-1 " src="{{ asset('img/talleres/img-1.jpg') }}" alt="">
							<h4 class="font-weight-bold text-center"> {{ $datos->seccion1b }}</h4>
					</div>
					<div class="col-3 align-self-center text-center border-danger border p-3">
						<h5>2</h5>
							<h4 class="font-weight-bold text-center"> {{ $datos->seccion2a }}</h4>
						<img class="img-fluid mb-1 mt-1 " src="{{ asset('img/talleres/img-2.jpg') }}" alt="">
							<h4 class="font-weight-bold text-center"> {{ $datos->seccion2b }}</h4>
					</div>
					<div class="col-3 align-self-center text-center border-danger border p-3">
						<h5>3</h5>
							<h4 class="font-weight-bold text-center"> {{ $datos->seccion3a }}</h4>
						<img class="img-fluid mb-1 mt-1 " src="{{ asset('img/talleres/img-3.jpg') }}" alt="">
							<h4 class="font-weight-bold text-center"> {{ $datos->seccion3b }}</h4>

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
                <textarea disabled="" class="form-control" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }}</textarea>
              </div>   
              
            </div>
        </div>
        @endif
        </div>
	</div>

@endsection