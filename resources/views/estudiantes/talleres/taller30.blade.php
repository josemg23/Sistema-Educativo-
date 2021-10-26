@extends('layouts.nav')
@section('css')
<style>
	.input-css{
		color:#495057;
		background-color:#fff;
		background-clip:padding-box;
		border:1px solid #ced4da;
		border-radius:.25rem;
		box-shadow:inset 0 0 0 transparent;
		transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	}
</style>
@endsection
@section('title', $datos->nombre)
@section('content')
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
         	<div class="container mb-4 ">
		<div class="row justify-content-center">
		<div class="p-3 col-8">
			<h2 class="text-center"><strong>EDITORIAL</strong></h2>
			<p class="text-justify" style="font-size: 16px;">
				El <strong>SRI</strong>   dejó  claro  que  serán  clausurados  todos  los  negocios  que no  entreguen  sus  respectivos  comprobantes  de  ventas destacando  lo siguiente  con  respecto  a  la <strong>Fra</strong> ,  que  en  ella deberá  constar  el <strong>RUC</strong>   de  la  empresa,  la  determinación  de <strong>C/u</strong>  de los <strong>artículos</strong>   y se  debe  desglosar  el <strong>IVA</strong>   y su  respectivo <strong>Dcto.</strong>   
			</p>
			<p class="text-justify"  style="font-size: 16px;">
				La <strong>OEA</strong>   felicitó  por  su  buen  desempeño  al <strong>BCE</strong> , por  administrar sus  fondos  de  una  manera  eficaz  a  las  distintas  entidades públicas  tales  como:  el <strong>IESS</strong>   por  la  implementación  de  sus equipos  quirúrgicos,  al <strong>MIDUVI</strong>   por  ofrecer  a  las  personas  de bajos  recursos  un  hogar  digno,  entre  otros.
			</p>
		</div>
		<div class="col-8 form-inline border border-danger p-3">
			<h2 class="text-center"><strong>EDITORIAL</strong></h2>
			<p class="text-justify " style="font-size: 16px;">
				El <span class="badge badge-success badge badge-success">{{ $datos->abreviatura1 }}</span> dejó  claro  que  serán  clausurados  todos  los  negocios  que no  entreguen  sus  respectivos  comprobantes  de  ventas destacando  lo siguiente  con  respecto  a  la <span class="badge badge-success ">{{ $datos->abreviatura2 }}</span> ,  que  en  ella deberá  constar  el <span class="badge badge-success ">{{ $datos->abreviatura3 }}</span>   de  la  empresa,  la  determinación  de <span class="badge badge-success ">{{ $datos->abreviatura4 }}</span>  de los <span class="badge badge-success ">{{ $datos->abreviatura5 }}</span>   y se  debe  desglosar  el <span class="badge badge-success ">{{ $datos->abreviatura6 }}</span>   y su  respectivo <span class="badge badge-success ">{{ $datos->abreviatura7 }}</span>   
			</p>
			<p class="text-justify" style="font-size: 16px;">
				La <span class="badge badge-success ">{{ $datos->abreviatura8 }}</span>   felicitó  por  su  buen  desempeño  al <span class="badge badge-success ">{{ $datos->abreviatura9 }}</span> , por  administrar sus  fondos  de  una  manera  eficaz  a  las  distintas  entidades públicas  tales  como:  el <span class="badge badge-success ">{{ $datos->abreviatura10 }}</span>   por  la  implementación  de  sus equipos  quirúrgicos,  al <span class="badge badge-success ">{{ $datos->abreviatura11 }}</span>   por  ofrecer  a  las  personas  de bajos  recursos  un  hogar  digno,  entre  otros.
			</p>
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
                <textarea class="form-control" disabled="" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $relacion[0]->retroalimentacion }} </textarea>
              </div>   
               
            </div>
        </div>
        @endif
        </div>
        </div>
</form>

@endsection