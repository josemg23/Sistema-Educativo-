@extends('layouts.nav')
@section('title', $datos->nombre)
@section('content')
<h1 class="text-center  mt-5 text-danger font-weight-bold display-4"> {{ $datos->taller->nombre }}</h1>
<h3 class="text-center mt-5 mb-3 text-info">{{ $datos->taller->enunciado }}</h3>
<form action="{{ route('taller47', ['idtaller' => $d]) }}" method="POST">
  @csrf
  <div class="container mb-3" id="cuentas">
    <div class="row justify-content-center">
      <div class="col-12">
        {!! $datos->detalles !!}
      </div>
      <div class="col-6"  style="border: solid 8px #CD1D1D; overflow-y: scroll; height: 500px;">
        <h2 class="text-center font-weight-bold text-danger">ACTIVOS</h2>
        <div class="row p-3">
          <input type="text" class="col-10 form-control form-control-sm mr-2" v-model="activo.cuenta"  placeholder="Agregar Activo">
          <button class="btn btn-success btn-sm" @click.prevent="agregarActivo">Agregar</button>
        </div>
        <ul class="list-group list-group-flush">
          <li v-for="(activo, index) in activos" class="list-group-item d-flex justify-content-between align-items-center">
            <input type="text" class="form-control form-control-plaintext" v-model="activo.cuenta">
            <span class=""><a href="" class="btn btn-sm btn-danger" @click.prevent="borrarActivo"><i class="fa fa-trash"></i></a></span>
          </li>
        </ul>
      </div>
      <div class="col-6" style="border: solid 8px #CD1D1D; overflow-y: scroll; height: 500px;">
        <h2 class="text-center font-weight-bold text-danger">PASIVOS</h2>
        <div class="row p-3">
          <input type="text" class="col-10 form-control form-control-sm mr-2" v-model="pasivo.cuenta" placeholder="Agregar Pasivo">
          <button class="btn btn-success btn-sm" @click.prevent="agregarPasivo">Agregar</button>
        </div>
        <ul class="list-group list-group-flush">
          <li v-for="(pasivo, index) in pasivos" class="list-group-item d-flex justify-content-between align-items-center">
            <input type="text" class="form-control form-control-plaintext" v-model="pasivo.cuenta">
            <span class=""><a href="" class="btn btn-sm btn-danger" @click.prevent="borrarPasivo"><i class="fa fa-trash"></i></a></span>
          </li>
        </ul>
      </div>
    </div>
    <div class="row justify-content-center mt-3">
     <a href="" @click.prevent="warning()" class="btn btn-danger">Enviar Respuesta</a>
    </div>
  </div>
</form>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
  let taller_id = @json($d);
  const cuentas = new Vue({
    el: "#cuentas",
    data:{
      pasivos:[],
      activos:[],
      activo:{
        cuenta:''
      },
      pasivo:{
        cuenta:''
      },
      taller_id: taller_id

    },
    methods:{
      agregarActivo(){
        if (this.activo.nombre === '') {
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else{
           let activo ={cuenta:this.activo.cuenta}
            this.activos.push(activo);
            this.activo.cuenta = '';
        }
      },
      agregarPasivo(){
          if (this.pasivo.nombre === '') {
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else{
           let pasivo ={cuenta:this.pasivo.cuenta}
            this.pasivos.push(pasivo);
            this.pasivo.cuenta = '';
        }
      },
      borrarActivo(index){
        this.activos.splice(index, 1);
      },
      borrarPasivo(index){
        this.pasivos.splice(index, 1);
      },
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
   this.completarTaller();
  }
})
      },
      completarTaller: function(){
        let set = this;
        let id = this.taller_id;
        let url = '/sistema/admin/taller49/'+id;
            axios.post(url,{
              id: id,
              activos: set.activos,
              pasivos: set.pasivos
        }).then(response => {
           Swal.fire({
            title: 'Smarmoddle',
            text: response.data.mensaje,
          }).then(function() {
            if (response.data.rol == 'docente') {
  window.location = "/sistema/contenido/"+response.data.id+"/talleres/resueltos";

} else if(response.data.rol == 'estudiante'){
  window.location = "/sistema/unidad/"+response.data.id;
}

                // window.location = "/sistema/homees";
            });
            
        }).catch(function(error){

        }); 
    }
    }
  
    
  })
</script>

@endsection
