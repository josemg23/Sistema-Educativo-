@extends('layouts.nav')

@section('css')
<style type="text/css">

#paper {
    color:#FFF;
    font-size:20px;
}
#margin {
    margin-left:12px;
    margin-bottom:20px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none; 
}
#text {
   /* width:500px;*/
    overflow:hidden;
    background-color:#FFF;
    color:#222;
    font-family:Courier, monospace;
    font-weight:normal;
    font-size:24px;
    resize:none;
    line-height:40px;
    padding-left:100px;
    padding-right:100px;
    padding-top:45px;
    padding-bottom:34px;
    background-image:url(https://static.tumblr.com/maopbtg/E9Bmgtoht/lines.png), url(https://static.tumblr.com/maopbtg/nBUmgtogx/paper.png);
    background-repeat: repeat;
    -webkit-border-radius:12px;
    border-radius:12px;
    -webkit-box-shadow: 0px 2px 14px #000;
    box-shadow: 0px 2px 14px #000;
    border-top:1px solid #FFF;
    border-bottom:1px solid #FFF;
}

#wrapper {
    width:700px;
    height:auto;
    margin-left:auto;
    margin-right:auto;
    margin-top:24px;
    margin-bottom:100px;
}
</style>
@endsection
@section('titulo', $datos->taller->nombre)
@section('content')

<form action="{{ route('taller1', ['idtaller' => $d]) }}" id="taller1" method="POST">
    @csrf
	 <div class="container">
        
	 	<h1 class="text-center mt-5 display-4 font-weight-bold text-danger">{{ $datos->taller->nombre }}</h1>
     <h3 class="text-center mt-3">{{ $datos->enunciado }}</h3>

     <div class="row justify-content-md-center">
            @if ($datos->img == true)
                <div class="col-5">
                        <img src="{{ $datos->img }}" width="400" alt="" style="outline: none; background-color: #94F0E4; box-shadow: 5px 5px 15px 0px  #18DEF0;" >
                    </div>
            @endif
         <div class="col ">
            <textarea  class="form-control inputdesign" name="respuesta" id="text"  cols="40" rows="10">{{ $datos->leyenda }}

            </textarea>
        </div>

     </div>

     <div class="row justify-content-center">
        <input type="button" id="button" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
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
    $( "#taller1" ).submit();
  }
})
});

</script>
@endsection
