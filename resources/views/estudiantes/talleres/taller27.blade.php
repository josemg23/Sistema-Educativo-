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

<!-- TALLER PARA ABREVIARURAS-->
<div class="container">
	<h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;">
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>

          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
           		<div class="row justify-content-center">
		<div class="col-6">
			<div class="row justify-content-center">
				@foreach ($taller->abreviaturaImg as $key => $dato)
				<div class="card" style="width: 18rem;">
				  <img class="img-fluid" src="{{ asset($dato->col_a) }}" alt="">
				  <div class="card-body bg-primary">
				    <p class="card-text text-center">{{ $datos->abreviaturaRe[$key]->col_a_res }}</p>
				  </div>
				</div>
					{{-- <div class="col-6"><img class="img-fluid" src="{{ asset($dato->col_a) }}" alt=""></div>
					<div class="col-6 align-self-center"><input type="text" name="col_a[]" class="form-control"></div> --}}
				@endforeach
			</div>
		</div>
		<div class="col-6">
			<div class="row justify-content-center">
				@foreach ($taller->abreviaturaImg as $key => $dato)
				<div class="card" style="width: 18rem;">
				  <img class="img-fluid" src="{{ asset($dato->col_b) }}" alt="">
				  <div class="card-body bg-primary">
				    <p class="card-text text-center">{{ $datos->abreviaturaRe[$key]->col_b_res }}</p>
				  </div>
				</div>
					{{-- <div class="col-6"><img class="img-fluid" src="{{ asset($dato->col_b) }}" alt=""></div>
					<div class="col-6 align-self-center"><input type="text" name="col_b[]" class="form-control"></div> --}}
				@endforeach
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
                <textarea disabled class="form-control" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }} </textarea>
              </div>   
            </div>
        </div>
        @endif
        </div>
          </div>


</div>
</form>

@endsection