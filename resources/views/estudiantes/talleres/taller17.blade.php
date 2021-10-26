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
<!-- CONVIERTA  Y  COMPLETE  EL  CHEQUE  CERTIFICADO  CORRECTAMENTE -->

	 <div class="container">
	 		<h1 class="text-center text-danger  display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>

          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
            		 	<div class="row">
     		<div class="col-8 ">
     			<div class="border border-info p-2">
				<div class="row ">
					<div class="col-6">
					<div class="alert alert-secondary" role="alert">
							 {{ $datos->tipo_cheque }}
							</div>
							<div class="alert alert-secondary" role="alert">
							 {{ $taller->n_banco }}
							</div>
					</div>	
					<div class="col-2 align-self-center">
						<p>16457 <br>
							152
						</p>
					</div>	
				</div>
				<div class="row">
					<div class="col-2">
						<label class="text-capitalize" for="">PAGUESE A LA ORDEN DE:</label>
						
					</div>
					<div class="col-7">
						<div class="alert alert-secondary" role="alert">
							 {{ $taller->nombre }}
							</div>
					</div>
					<div class="col-3">
						<label for="">
							CHEQUE 0145
						</label><br>
						<div class="row">
							<div class="col-2"><label for="">
							US
						</label></div>
							<div class="col-8">
									<div class="alert alert-secondary" role="alert">
									{{ $taller->numero }}
									</div>
							</div>
						</div>
						
					</div>

				</div>
				<div class="row mb-2">
					<div class="col-2">
						<label for="">LA SUMA DE</label>
					</div>
					<div class="col-8">
						<div class="alert alert-secondary" role="alert">
							{{ $taller->cantidad }}
						</div>
					</div>
					<div class="col-2">
						DOLARES
					</div>
				</div>
				<div class="row">
					<div class="col-6 align-self-start pb-5">
						<div class="row">
							<div class="col-6">
								<div class="alert alert-secondary" role="alert">
									{{ $taller->lugar }}
								</div>
							
							</div>
							<div class="col-6">
								<div class="alert alert-secondary" role="alert">
									{{ $taller->fecha }}
								</div>
								
							</div>
						</div>
							<div class="row">
							<div class="col-6"> <label for="">CIUDAD</label> </div>
							<div class="col-6 text-center"> <label for="">FECHA</label> </div>
						</div>
					</div>
					<div class="col-6 col align-self-end text-center">
						<div class="alert alert-secondary" role="alert">
							 {{ $datos->firma2 }}
							  
							</div>
						<label class="" for="">FIRMA</label>
					</div>
				</div>
				</div>
			</div>

			<div class="col-4">
				<div class="row justify-content-center">
     			    <div class="col-10 border-success border">
     				<div class="text-center">
     					<div class="text-center mt-1">
	     					<div class="alert alert-secondary mt-2" role="alert">
							 {{ $datos->espacio1 }}
							</div>
	     				</div>
     				</div>

     				<div class="text-justify">
     					ENDOSO A: 
     				</div>
     			
		        </div>
     		</div>
     		<div class="row justify-content-center">
     			<div class="col-10 border border-success">
     				<div class="row justify-content-center mt-3 mb-2">
     					<div class="col-8 text-center">
     						<div class="alert alert-secondary" role="alert">
							 {{ $datos->endoso }}
							</div>
     						
     						<label for="">Nombre</label>
     					</div>
     					<div class="col-8 text-center">
     						<div class="alert alert-secondary" role="alert">
							 {{ $datos->firma }}
							</div>
     						<label for="">Firma del endosante</label>
     						<h6>(1 beneficiario)</h6>
     					</div>
     				</div>
     			</div>
     		</div>
     			<div class="row justify-content-center ">
	     			<div class="col-10 border-success border ">
	     				<div class="text-center mt-1">
	     					<div class="text-center mt-1">
							 <h5>Espacio para depositante o persona que cobra</h5>
	     					<div class="alert alert-secondary" role="alert">
							 {{ $datos->espacio2 }}
							</div>
	     				</div>
	     				</div>
					</div>
     			</div>
     			<div class="row justify-content-center">
     			<div class="col-10 border border-success">
     				<div class="row justify-content-center mt-3 mb-2">
     					<div class="col-8 text-center">
     						<div class="alert alert-secondary" role="alert">
							  ING. JUAN PEREZ
							</div>
     						
     						<label for="">Firma</label>
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
                <input type="text"value="{{ $relacion[0]->calificacion }}" disabled class="form-control" name="calificacion" placeholder="Añada una nota al estudiante">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Retroalimentacion</label>
                <textarea class="form-control" disabled name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }} </textarea>
              </div>   
            </div>
        </div>
        @endif
        </div>

</div>


@endsection