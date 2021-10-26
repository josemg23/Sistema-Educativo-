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
	<h1 class="text-center  mt-5 text-danger font-weight-bold display-4">{{ $datos->nombre }}</h1>
    <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>
<form action="{{ route('taller30', ['idtaller' => $d]) }}" method="POST" id="taller30">
           @csrf
	<div class="container mb-4 ">
		<div class="row justify-content-center">
		<div class="p-3 mb-3 col-8" style="box-shadow: 5px 5px 15px 0px  #087980;">
			<h2 class="text-center"><strong>EDITORIAL</strong></h2>
			<p class="text-justify" style="font-size: 16px;">
				El <strong>SRI</strong>   dejó  claro  que  serán  clausurados  todos  los  negocios  que no  entreguen  sus  respectivos  comprobantes  de  ventas destacando  lo siguiente  con  respecto  a  la <strong>Fra</strong> ,  que  en  ella deberá  constar  el <strong>RUC</strong>   de  la  empresa,  la  determinación  de <strong>C/u</strong>  de los <strong>artículos</strong>   y se  debe  desglosar  el <strong>IVA</strong>   y su  respectivo <strong>Dcto.</strong>   
			</p>
			<p class="text-justify"  style="font-size: 16px;">
				La <strong>OEA</strong>   felicitó  por  su  buen  desempeño  al <strong>BCE</strong> , por  administrar sus  fondos  de  una  manera  eficaz  a  las  distintas  entidades públicas  tales  como:  el <strong>IESS</strong>   por  la  implementación  de  sus equipos  quirúrgicos,  al <strong>MIDUVI</strong>   por  ofrecer  a  las  personas  de bajos  recursos  un  hogar  digno,  entre  otros.
			</p>
		</div>
		<div class="col-8 form-inline p-3" style="box-shadow: 5px 5px 15px 0px  #800830;">
			<h2 class="text-center"><strong>EDITORIAL</strong></h2>
			<p class="text-justify " style="font-size: 16px;">
				El <input style="box-shadow: 5px 5px 15px 0px  #72DDE4;"  type="text" class="input-css m-1" name="abreviatura1" size="40"> dejó  claro  que  serán  clausurados  todos  los  negocios  que no  entreguen  sus  respectivos  comprobantes  de  ventas destacando  lo siguiente  con  respecto  a  la <input style="box-shadow: 5px 5px 15px 0px  #72DDE4;"  size="40" type="text" class="input-css m-1" name="abreviatura2"> ,  que  en  ella deberá  constar  el <input style="box-shadow: 5px 5px 15px 0px  #72DDE4;"  size="40" type="text" size="40" class="input-css m-1" name="abreviatura3">   de  la  empresa,  la  determinación  de <input style="box-shadow: 5px 5px 15px 0px  #72DDE4;"  size="40" type="text" size="40" class="input-css m-1" name="abreviatura4">  de los <input style="box-shadow: 5px 5px 15px 0px  #72DDE4;"  size="40" type="text" class="input-css m-1" name="abreviatura5">   y se  debe  desglosar  el <input style="box-shadow: 5px 5px 15px 0px  #72DDE4;"  size="40" type="text" class="input-css m-1" name="abreviatura6">   y su  respectivo <input style="box-shadow: 5px 5px 15px 0px  #72DDE4;"  size="40" type="text" class="input-css m-1" name="abreviatura7">   
			</p>
			<p class="text-justify" style="font-size: 16px;">
				La <input style="box-shadow: 5px 5px 15px 0px  #72DDE4;"  size="40" type="text" class="input-css m-1" name="abreviatura8">   felicitó  por  su  buen  desempeño  al <input style="box-shadow: 5px 5px 15px 0px  #72DDE4;"  size="40" type="text" class="input-css m-1" name="abreviatura9"> , por  administrar sus  fondos  de  una  manera  eficaz  a  las  distintas  entidades públicas  tales  como:  el <input style="box-shadow: 5px 5px 15px 0px  #72DDE4;"  size="40" type="text" class="input-css m-1" name="abreviatura10">   por  la  implementación  de  sus equipos  quirúrgicos,  al <input style="box-shadow: 5px 5px 15px 0px  #72DDE4;"  size="40" type="text" class="input-css m-1" name="abreviatura11">   por  ofrecer  a  las  personas  de bajos  recursos  un  hogar  digno,  entre  otros.
			</p>
		</div>
	</div>
	 <div class="row justify-content-center">
        	<input style="box-shadow: 5px 5px 15px 0px  #72DDE4;" type="button" id="button" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
    	</div>
	</div>
</form>

@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">

 $( "#button" ).click(function( event ) {
  event.preventDefault();
  Swal.fire({
  title: 'Seguro que deseas completar el taller?',
  text: "Esta accion ya no se puede revertir!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Completar!',
  cancelButtonText: 'Cancelar!'
}).then((result) => {
  if (result.isConfirmed) {
    $( "#taller30" ).submit();
  }
})
});

</script>
@endsection