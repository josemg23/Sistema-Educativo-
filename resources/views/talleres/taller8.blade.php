@extends('layouts.nav')


@section('title', 'Taller 9')
@section('content')

<!--ESCRIBA  EN  LOS  CÍRCULOS  EJEMPLOS. -->

<h1 class="text-center  mt-5 text-danger  font-weight-bold display-4">{{ $datos->taller->nombre }}</h1>
     <h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>

<form action="{{ route('taller8', ['idtaller' => $d]) }}" method="POST" id="taller8">
    @csrf
    <div class="container">
    @if ($datos->cantidad == 3)
        <div class="row justify-content-center">
            <div class="col-4 align-self-center mt-5">
                <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign" name="respuesta1"  id="">
            </div>
        </div>
    <div class="row row justify-content-md-center">
        <div class="col-4 align-self-center mt-5">
            <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta2" id="">
        </div>
            <div class="col-3 text-center mt-3 mb-3 ">
                <img class="img-fluid" width="200" style="border: double 5px #17D6E2; box-shadow: 3px 3px 3px 3px #28BEE4" src="{{ asset($datos->img) }}" alt="">
            </div>
        <div class="col-4 align-self-center mt-5">
            <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign" name="respuesta3"  id="">
        </div>
    </div>
   

    @elseif ($datos->cantidad == 4)
        <div class="row justify-content-center">
            <div class="col-4 align-self-center mt-5">
                <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta1" id="">
            </div>
        </div>
    <div class="row row justify-content-md-center">
        <div class="col-4 align-self-center mt-5 ">
            <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta2" id="">
        </div>
            <div class="col-3 text-center mt-3 mb-3 ">
                <img class="img-fluid" width="200" style="border: double 5px #17D6E2; box-shadow: 3px 3px 3px 3px #28BEE4" src="{{ asset($datos->img) }}" alt="">
            </div>
        <div class="col-4 align-self-center mt-5 ">
            <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta3" id="">
        </div>
    </div>
    <div class="row justify-content-center">
            <div class="col-4 align-self-center m-2">
                <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta4" id="">
            </div>
    </div>
        
        @elseif($datos->cantidad == 5)
    <div class="row justify-content-center">
            <div class="col-4 align-self-center mt-5">
                <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta1" id="">
            </div>
        </div>
    <div class="row row justify-content-md-center">
        <div class="col-4 align-self-center mt-5">
            <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta2" id="">
        </div>
            <div class="col-3 text-center mt-3 mb-3 ">
                <img class="img-fluid" width="200" style="border: double 5px #17D6E2; box-shadow: 3px 3px 3px 3px #28BEE4" src="{{ asset($datos->img) }}" alt="">
            </div>
        <div class="col-4 align-self-center mt-5">
            <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta3" id="">
        </div>
    </div>
    <div class="row justify-content-center">
            <div class="col-4 align-self-center m-2">
                <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta4" id="">
            </div>
            <div class="col-4 align-self-center m-2">
                <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta5" id="">
            </div>
    </div>
    @elseif($datos->cantidad == 6)
    <div class="row justify-content-center">
            <div class="col-4 align-self-center mt-5">
                <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta1" id="">
            </div>
            <div class="col-4 align-self-center mt-5">
                <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta2" id="">
            </div>
        </div>
    <div class="row row justify-content-md-center">
        <div class="col-4 align-self-center mt-5">
            <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta3" id="">
        </div>
            <div class="col-3 text-center mt-3 mb-3 ">
                <img class="img-fluid" width="200" style="border: double 5px #17D6E2; box-shadow: 3px 3px 3px 3px #28BEE4" src="{{ asset($datos->img) }}" alt="">
            </div>
        <div class="col-4 align-self-center mt-5">
            <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta4" id="">
        </div>
    </div>
    <div class="row justify-content-center">
            <div class="col-4 align-self-center m-2">
                <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta5" id="">
            </div>
            <div class="col-4 align-self-center m-2">
                <input style="box-shadow: 2px 3px 3px 5px #30E8F8" class="form-control inputdesign"  name="respuesta6" id="">
            </div>
    </div>
        @endif
        <div class="row justify-content-center">
            <input  type="button" id="button" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
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
    $( "#taller8" ).submit();
  }
})
});

</script>
@endsection
