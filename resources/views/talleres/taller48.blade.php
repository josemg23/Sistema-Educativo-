@extends('layouts.nav')
 @section('css')
 <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
 <style type="text/css">
   .container .dropzone{
    border: dotted;
    height: 250px;
      background-color: #6DF8E7;
      box-shadow: 5px 5px 15px 0px  #27D5F4;
  outline: 2px dashed #F59696;
  outline-offset: -10px;
   }
   .dropzone .dz-message {
    font-weight: bold;
    text-align: center;
    margin: 2em 0;
    color: red;
    font-size: 20px;
   line-height: 150px;
}
 </style>
 @endsection
 {{-- EN EL SIGUIENTE COLLAGE APLIQUE FIGURAS QUE SE  RELACIONEN CON CONTABILIDAD HOTELERA, CON EFICACIA --}}
@section('title', $datos->taller->nombre)
@section('content')
<h1 class="text-center  mt-5 text-danger font-weight-bold display-4">{{$datos->taller->nombre }} </h1>
<h3 class="text-center mt-5 mb-3 text-info">{{ $datos->taller->enunciado }}</h3>
<div class="container">
	<form action="{{ route('taller48', ['idtaller' => $d]) }}"
      class="dropzone"
      id="my-awesome-dropzone"
     enctype="multipart/form-data">
     @csrf
		</form>

		<div class="row justify-content-center">
     <button class="btn btn-outline-danger mt-5 text-center" id="sendAll">Enviar Archivos</button>
		</div>
	</div>

 @endsection


@section('js')
<script type="text/javascript" src="{{ asset('js/dropzone.min.js') }}"></script>
<script type="text/javascript">
  let rol = @json($rol);
  let materia = @json($contenido->materia_id);
  let contenido = @json($contenido->id);
  let numero = @json($datos->ar_num);

  Dropzone.options.myAwesomeDropzone = {
    autoProcessQueue: false,
    dictDefaultMessage: "AGREGUE LOS ARCHIVOS EN EL RECUADRO",
      maxFilesize: 50, // MB
      // acceptedFiles: "application/pdf",
      maxFiles: numero,
      parallelUploads:5,
      addRemoveLinks: true,
      dictRemoveFile: 'Eliminar',
    //   success: function (file, response) {
    //     // console.log(response);
    // },
    // error: function(response){
    //   // console.log(response);
    // },
      init:function () {
        var submitButon = document.querySelector("#sendAll");
      myDropzone = this;
      submitButon.addEventListener('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        myDropzone.processQueue();
      });
      // this.on("addedfile", function(file) {
      //       toastr.success("Imagen Agregada Correctamente", "Smarmoddle",{
      //              "timeOut": "1000"
      //           });
      //   });
       this.on("removedfile", function(file) {
            toastr.success("Imagen Eliminada Correctamente", "Smarmoddle",{
                   "timeOut": "1000"
                });
        });

      this.on("complete", function(){
        if (this.getQueuedFiles().length == 0 && this. getUploadingFiles().length == 0) {
          var _this = this;
          _this.removeAllFiles();
          Swal.fire({
            title: 'Smarmoddle',
            text: 'Datos enviados correctamente',
          }).then(function() {
             if (rol == 'estudiante') {
  window.location = "/sistema/unidad/"+contenido;

              } else if((rol == 'docente')) {
  window.location = "/sistema/contenido/"+materia+"/talleres/resueltos";

              }
                // window.location = "/sistema/homees";
            });
        }
      });
        }
      };
</script>
 @endsection