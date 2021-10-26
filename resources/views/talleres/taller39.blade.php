@extends('layouts.nav')

@section('title', $datos->taller->nombre)
@section('content')

{{-- ARMA  UNA  PALABRA  DE  9  LETRAS  REFERENTE  A TRANSACCIÓN  COMERCIAL.  (Las  letras  deben  estar  unidas por  líneas) --}}
<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->taller->nombre }}</h1>
<h3 class="text-center mt-5 mb-3 text-info">{{ $datos->enunciado }}</h3>

	<div class="container" id="taller39" class="mb-5">
		<div class="row justify-content-center ">
			<div class="col-9">
				<div class="row justify-content-between">
				<div class="col-5">
					      <draggable class="row justify-content-around p-3" style="box-shadow: 5px 5px 15px 0px  #087980" :list="letras" group="people">
					        <div
					        style="font-size: 20px; cursor: move;" 
					          class="col-3 drag align-items-center text-center p-2 border border-danger m-2"
					          v-for="(element, index) in letras"
					          :key="element.name">
					          @{{ element }}
					        </div>
					      </draggable>
					{{-- <div class="row justify-content-around ">
							@foreach ($datos as $element)
								<div  class="col-3 drag align-items-center text-center p-2 border border-danger m-2"><h6>{{ $element }}</h6></div>
							@endforeach
					</div> --}}
				</div>
				<div class="col-6 align-self-start ">
				<h2>La  palabra  es :</h2>
				<draggable class="row p-1 bg-light" :list="orden" group="people" >
					<h6 class="text-muted" v-if="orden.length == 0">Arrastre aqui...</h6>
			        <div v-else
			          v-for="(element, index) in orden"
			          :key="element.name">
			          <span
			          style="font-size: 20px; cursor: move;" 
			           class="badge badge-warning ml-1 p-1">@{{ element }}</span>
			        </div>
			      </draggable>
				</div>
			</div>
			</div>
		</div>
		<div class="row justify-content-center">
        	<input type="submit" value="Enviar Respuesta" @click.prevent="warning()" class="btn p-2 mt-3 btn-danger">
    	</div>
	</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
	let palabra = @json($letra);
	let taller_id = @json($d);
	const taller39 = new Vue({
	  el: "#taller39",
	  data:{
	  	letras: palabra,
	  	orden:[]
	  },
	  methods:{
	  	warning(){
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
    this.enviarTaller();
  }
})
	  	},
	  	enviarTaller: function() {
	  	let _this = this;
        let url = '/sistema/admin/taller39/'+taller_id;

        if (_this.letras.length !== 0) {
        	toastr.error("No has completado toda la palabra", "Smarmoddle", {
                 "timeOut": "3000"
              });
        } else {
        axios.post(url,{
              id: taller_id,
              respuesta: _this.orden
        }).then(response => {
        	if (response.data.rol == 'docente') {
  window.location = "/sistema/contenido/"+response.data.id+"/talleres/resueltos";

} else if(response.data.rol == 'estudiante'){
  window.location = "/sistema/unidad/"+response.data.id;
}

        	// // console.log(response.data)
        	// window.location = "/sistema/homees";   
        }).catch(function(error){

        }); 
        }
     
	  	}
	  }
	});

</script>

@endsection