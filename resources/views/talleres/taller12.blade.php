@extends('layouts.nav')

@section('title',  $datos->taller->nombre)
@section('content')

<!--IDENTIFICA  EL  ENUNCIADO  ESCRIBIENDO  (V) DE  VERDADERO   O  (F)  DE 
FALSO,  CON  CERTEZA. -->
<h1 class="text-center  mt-5 text-danger display-4  font-weight-bold">{{ $datos->taller->nombre }}</h1>
     <h3 class="text-center mt-5 text-info">{{ $datos->enunciado }}</h3>

     <form action="{{ route('taller12', ['idtaller' => $d]) }}" id="taller12" method="POST">
           @csrf
     	<div class="container">
     		<div class="row justify-content-center bg-light" style="box-shadow: 5px 5px 15px 0px  #18DEF0">
     			<div class="col-7">
                         @foreach ($datos->tallerVerFalOp as $element)
                         <div class="row mt-4 p-2">
                              <div class="col-10 ">
                                   <label class="col-form-label " for="">{{ $element->descripcion }} </label>
                                   
                              </div>
                              <div class="col-2">
                                   <select name="respuestas[]" id="" class="custom-select p-2 text-center font-weight-bold" style="outline: none; background-color: #94F0E4; box-shadow: 5px 5px 15px 0px  #18DEF0">
                                        <option value="V" class="p-2" >V</option>
                                        <option value="F" class="p-2" >F</option>
                                   </select>
                              </div>
                         </div>
                         <br> 
                         @endforeach			
     			</div>
     		</div>
     		<div class="row justify-content-center">
        		<input type="button" id="button" value="Enviar Respuestas" class="btn p-2 mt-3 btn-danger">
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
    $( "#taller12" ).submit();
  }
})
});

</script>
@endsection
