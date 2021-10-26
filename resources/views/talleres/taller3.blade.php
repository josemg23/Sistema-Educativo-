@extends('layouts.nav')

@section('css')
<style type="text/css">
#paper {
    color: #FFF;
    font-size: 20px;
}

#margin {
    margin-left: 3px;
    margin-bottom: 5px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
}

.text {
    /* width:500px;*/
    overflow: hidden;
    background-color: #FFF;
    color: #222;
    font-family: Courier, monospace;
    font-weight: normal;
    font-size: 24px;
    resize: none;
    line-height: 25px;
    padding-left: 50px;
    padding-right: 50px;
    padding-top: 20px;
    padding-bottom: 15px;
    background-image:
        /*url(https://static.tumblr.com/maopbtg/E9Bmgtoht/lines.png),*/
        url(https://static.tumblr.com/maopbtg/nBUmgtogx/paper.png);
    background-repeat: repeat;
    -webkit-border-radius: 12px;
    border-radius: 12px;
    -webkit-box-shadow: 0px 2px 14px #000;
    box-shadow: 0px 2px 14px #000;
    border-top: 1px solid #FFF;
    border-bottom: 1px solid #FFF;
}

#wrapper {
    width: 700px;
    height: auto;
    margin-left: auto;
    margin-right: auto;
    margin-top: 24px;
    margin-bottom: 100px;
}
</style>
@endsection

@section('title', 'Taller'.$consul->id)
@section('content')
<h1 class="text-center  mt-5 text-danger display-4 font-weight-bold text-dark">Taller {{ $consul->id }}</h1>
<h3 class="text-center mt-5 text-info">{{ $consul->enunciado }}</h3>
<form action="{{ route('taller3', ['idtaller' => $d]) }}" method="POST" id="taller3">
    @csrf
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-">
                @foreach ($datos->completarEnlist as $dato)
                <div class="row mt-4 p-2">
                    <div class="col-4 align-self-center">
                        <h3 class="font-weight-bold text-danger">{{ $dato->enunciados }}</h3>
                        <label class="col-form-label display-4 font-weight-bold" for=""></label>
                    </div>
                    <div class="col-8">
                        <textarea name="respuesta[]" class="form-control inputcurrent text" id="" cols="30"
                            rows="5" ></textarea>
                    </div>
                </div>
                <br>
                @endforeach

            </div>
        </div>
        <div class="row justify-content-center">
            <input type="button" id="button" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
        </div>
    </div>
</form>
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function() {
    $('textarea').autoResize();
});
</script>
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
    $( "#taller3" ).submit();
  }
})
});

</script>
@endsection
@endsection