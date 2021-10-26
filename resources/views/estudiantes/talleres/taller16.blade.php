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
<!-- ENDOSE  EL  CHEQUE  A  NOMBRE DE  LA  ING. ISABEL  PANTOJA -->

     	<div class="container">
           <h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          <div class="card-header font-weight-bold" style="font-size: 25px;"> 
            <h1 class="display-3">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h1></div>
          
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
               <div class="row justify-content-center">
                    <div class="col-5 border-success border">
                         <div class="text-center">
                              <h2>ESPACIO PARA ENDOSO</h2>
                    <h6 class="mt-0">(en caso de requerirse)</h6>
                         </div>

                         <div class="text-justify">
                              ENDOSO A: 
                         </div>
                    
                  </div>
               </div>
               <div class="row justify-content-center">
                    <div class="col-5 border border-success">
                         <div class="row justify-content-center mt-3 mb-2">
                              <div class="col-8 text-center">
                                   <div class="alert alert-primary" role="alert">
                                    {{ $datos->endoso }}
                                   </div>
                                   <label for="">Nombre</label>
                              </div>
                              <div class="col-8 text-center">
                                   <div class="alert alert-primary" role="alert">
                                     {{ $datos->firma }} 
                                   </div>
                                   <label for="">Firma del endosante</label>
                                   <h6>(1 beneficiario)</h6>
                              </div>
                         </div>
                    </div>
               </div>
                    <div class="row justify-content-center ">
                         <div class="col-5 border-success border ">
                              <div class="text-center mt-1">
                                   <h5 class="text-gray-dark">ESPACIO PARA DEPOSITANTE O PERSONA QUE COBRA</h5>
                              </div>
                         </div>
                    </div>
                    <div class="row justify-content-center">
                    <div class="col-5 border border-success">
                         <div class="row justify-content-center mt-3 mb-2">
                              <div class="col-8 text-center">
                                   <div class="alert alert-primary" role="alert">
                                    {{ $datos->firma2 }}
                                   </div>
                                   
                                   <label for="">Firma</label>
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
                <input type="text" disabled="" value="{{ $relacion[0]->calificacion }}" class="form-control" name="calificacion" placeholder="Añada una nota al estudiante">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Retroalimentacion</label>
                <textarea disabled="" class="form-control" value="{{ $relacion[0]->calificacion }}" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion"> {{ $relacion[0]->retroalimentacion }}</textarea>
              </div>   
             
            </div>
        </div>
        @endif
        </div> 
     	</div>


 @endsection