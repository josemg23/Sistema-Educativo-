@extends('layouts.nav')
@section('titulo', $datos->taller->nombre)
@section('css')
<style type="text/css">
  #partida .btn-success{
    box-shadow: -3px 3px 15px 0px  #5EFB8A;
  }
</style>
@endsection
@section('content')
<div class="container-fluid">
  <h1 class="text-center  mt-5 display-4 font-weight-bold text-danger">{{ $datos->taller->nombre }}</h1>
  <h3 class="text-center mt-3 font-weight-bold">{{ $datos->enunciado }}</h3>
  <div class="row justify-content-between p-3">
    <div class="col-5" style="border: double 8px #19CAEA; ">
      {!! $datos->transacciones !!}
    </div>
    <div class="col-7" style="border: double 8px #19CAEA; ">
        <h2 class="text-center font-weight-bold">Ejercicios</h2>
  <div id="partida">
    <div class="row justify-content-between" >
      <div v-for="(item, index) in partida_array" class="col-5">
        <table class="table">
          <thead>
            <tr>
              <th colspan="2" scope="col">
                <div class="row justify-content-around">
                  <div class="col-2">D</div>
                  <div class="col-8 text-center"><input value="" v-model="partida_array[index].cuenta" type="text" class="form-control-sm form-control text-center"></div>
                  <div class="col-2 text-right">H</div>
                </div>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td width="100" class="border-left-0 border-bottom-0 border-top-0 border">
                <div class="row justify-content-end">
                  <div class="col-12 align-self-end">
                    <div v-for="(debe, id) in partida_array[index].debe">
                      <p  class="text-right">@{{ debe.valor }} <a href="" @click.prevent="eliminarDebe(index, id)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></p>
                    </div>
                    <p v-if="partida_array[index].debe.length > 1" class="border border-bottom-0 border-left-0 border-right-0 border-danger text-right">$ @{{ partida_array[index].total_debe }}</p>
                    <a {{-- v-if="partida_array[index].haber.length == 0 " --}} href="" @click.prevent="agregarDebe(index)" class="btn btn-sm btn-danger">Agregar</a>
                  </div>
                  
                </div>
              </td>
              <td width="100">
                <div class="row justify-content-end">
                  <div class="col-12">
                    <div v-for="(haber, id) in partida_array[index].haber">
                      <p  class="text-right">@{{ haber.valor }} <a href="" @click.prevent="eliminarHaber(index, id)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></p>
                    </div>
                    <p v-if="partida_array[index].haber.length > 1" class=" text-right border border-bottom-0 border-left-0 border-right-0 border-danger">$ @{{ partida_array[index].total_haber }}</p>
                    <a {{-- v-if="partida_array[index].debe.length == 0" --}} href=""  @click.prevent="agregarHaber(index)"  class="btn btn-sm btn-success float-right">Agregar</a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal fade" id="valores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Agregar Debe</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
              <input type="number" v-model="reco[crear].debe" class="form-control mb-2" placeholder="Ingrese un valor" name="">
              <a href="" @click.prevent="insertarDebe()" class="btn btn-sm btn-light">Guardar</a>
            </div>
            <div class="modal-footer">
              
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="haber" tabindex="-1" aria-labelledby="haberLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content bg-success">
            <div class="modal-header">
              <h5 class="modal-title" id="haberLabel">Agregar Haber</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
              <input type="number" v-model="reco[crear].haber" class="form-control mb-2" placeholder="Ingrese un valor" name="">
              <a href="" @click.prevent="insertarHaber()" class="btn btn-sm btn-light">Guardar</a>
            </div>
            <div class="modal-footer">
              
            </div>
          </div>
        </div>
      </div>
      
    </div>
    @if ($datos->estado_resultado == 'si')
    <h2 class="text-center font-weight-bold text-danger mt-2">Estado de Resultado</h2>
    <div class="row justify-content-center">
      <input v-model="estado.descripcion" type="text" class="col-5 form-control mr-2" placeholder="Descripcion">
      <input v-model="estado.saldo1" type="number" class="text-right form-control col-2 mr-2" placeholder="Saldo">
      <input v-model="estado.saldo2" type="number" class="text-right form-control col-2 mr-2" placeholder="Saldo">
      <button @click.prevent="agregarRegistro" class="btn btn-block btn-success col-2">Agregar</button>
    </div>
    <div class="row mt-2 justify-content-center">
      <div class="col-10">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th class="text-center" scope="col">Descripcion</th>
              <th class="text-center" scope="col" width="150">.</th>
              <th class="text-center" scope="col" width="150">.</th>
              <th class="text-center" scope="col" width="50">Accion</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in registros">
              <td><input type="text" class="form-control form-control-sm" v-model="item.descripcion"></td>
              <td><input type="number" class="form-control form-control-sm text-right" v-model="item.saldo1"></td>
              <td><input type="number" class="form-control form-control-sm text-right" v-model="item.saldo2"></td>
              <td><button @click.prevent="eliminarRegistro(index)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    @endif
    <div class="row justify-content-center mb-2">
      <a href="" @click.prevent="warning()" class="btn p-2 mt-3 btn-danger">Enviar Respuesta</a>
    </div>
  </div>
    </div>
    {{--       @foreach ($datos->partidaDobleEnn as $key =>$element)
    <div class="col-6">
      <div class="card border border-info mb-3">
        <div class="card-header">Enunciado {{ $key +1 }}</div>
        <div class="card-body text-info">
          <p class="card-text">{{ $element->enunciados }}</p>
        </div>
      </div>
    </div>
    @endforeach --}}
  </div>

  {{--    @endfor --}}
  
  
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
let taller = @json($d);
let dobles = @json($array);
let recorrido = @json($recorrido);
const partida = new Vue({
el: "#partida",
data:{
partida_array: dobles,
// caja:{
//     valor_haber:[],
//     valor_debe:[],
//     total_debe:0,
//     total_haber:0,
// },
reco: recorrido,
estado:{
descripcion:'',
saldo1:'',
saldo2:''
},
registros:[],
crear:0,
id_editar:0,

},
methods:{
agregarDebe:function(index){
this.crear = index
$('#valores').modal('show');
},
insertarDebe(){
//      let array =   this.partida_array[index]
// console.log(array);
let id= this.crear;
if(this.reco[id].debe.trim() ===''){
toastr.error("El valor es obligatorio", "Smarmoddle", {
"timeOut": "3000"
});
}else {
let debe ={ valor:this.reco[id].debe}
this.partida_array[id].debe.push(debe);
toastr.success("Valor agregado correctamente", "Smarmoddle", {
"timeOut": "3000"
});
this.reco[id].debe = '';
$('#valores').modal('hide')
this.cambioDebe(id);
// this.totaldebe();
}
},
eliminarRegistro(index){
this.registros.splice(index, 1);
toastr.info("Registro eliminado", "Smarmoddle", {
"timeOut": "3000"
});
},
agregarRegistro(){
if (this.estado.descripcion == '') {
toastr.success("No has agregado una descripcion", "Smarmoddle", {
"timeOut": "3000"
});
} else {
let descripcion = this.estado.descripcion;
let saldo1       = this.estado.saldo1;
let saldo2       = this.estado.saldo2;
let registro = {descripcion: descripcion, saldo1: saldo1,  saldo2: saldo2}
this.registros.push(registro);
this.estado.descripcion = '';
this.estado.saldo1 = '';
this.estado.saldo2 = '';
}
},
agregarHaber:function(index){
this.crear = index
$('#haber').modal('show');
},
insertarHaber(){
//      let array =   this.partida_array[index]
// console.log(array);
let id= this.crear;
if(this.reco[id].haber.trim() ===''){
toastr.error("El valor es obligatorio", "Smarmoddle", {
"timeOut": "3000"
});
}else {
let haber ={ valor:this.reco[id].haber}
this.partida_array[id].haber.push(haber);
toastr.success("Valor agregado correctamente", "Smarmoddle", {
"timeOut": "3000"
});
this.reco[id].haber = '';
$('#haber').modal('hide')
this.cambioHaber(id);
// this.totalhaber();
}
},
cambioDebe(index){
let t_debe = this.partida_array[index].debe;           //CARGAR EL ARRAY DE LOS ACTIVOS
let total = 0;
t_debe.forEach(function(obj){           //RECORRER ESE ARRAY
total += Number(obj.valor);           //SUMAR EL SALDO DE CADA CUENTA EN EL ARRAY UNA Y OTRA VEZ
});
console.log(total);
this.partida_array[index].total_debe = total;          //IGUALAR LA letIABLE QUE CONTIENE LA SUMA TOTAL CON LA SUMA REALIZADA
},
cambioHaber(index){
let t_haber = this.partida_array[index].haber;           //CARGAR EL ARRAY DE LOS ACTIVOS
let total = 0;
t_haber.forEach(function(obj){           //RECORRER ESE ARRAY
total += Number(obj.valor);           //SUMAR EL SALDO DE CADA CUENTA EN EL ARRAY UNA Y OTRA VEZ
});
console.log(total);
this.partida_array[index].total_haber = total;          //IGUALAR LA letIABLE QUE CONTIENE LA SUMA TOTAL CON LA SUMA REALIZADA
},
eliminarDebe(index, id){
this.partida_array[index].debe.splice(id, 1);
this.cambioDebe(index);
this.totaldebe();

},
eliminarHaber(index, id){
this.partida_array[index].haber.splice(id, 1);
this.cambioHaber(index)
this.totalhaber();

},
//  totaldebe(){
// let t_haber = this.partida_array;
//   let total = 0;
//   t_haber.forEach(function(obj, id){
//    t_haber[id].debe.forEach(function(ob){
//     total += Number(ob.valor);

//     });
//   });
//   this.caja.total_debe = total
//  },
//    totalhaber(){
// let t_haber = this.partida_array;
//   let total = 0;
//   t_haber.forEach(function(obj, id){
//    t_haber[id].haber.forEach(function(ob){
//     total += Number(ob.valor);

//     });
//   });
//   this.caja.total_haber = total
//  },
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
    this.guardarTaller();
  }
})
},
guardarTaller: function(){

let t_haber = this.partida_array;
let t_debe = this.partida_array;
let _this = this;
let url = '/sistema/admin/taller2/'+taller;

// t_haber.forEach(function(obj, id){
//    t_haber[id].haber.forEach(function(ob){
//    _this.caja.valor_debe.push(ob.valor);
//     });
//   });
//  t_debe.forEach(function(obj, id){
//    t_debe[id].debe.forEach(function(ob){
//    _this.caja.valor_haber.push(ob.valor);
//     });
//   });

// console.log('activado')
axios.post(url,{
id: taller,
datos: _this.partida_array,
estado_resultado: _this.registros,
}).then(response => {
if (response.data.rol == 'docente') {
  window.location = "/sistema/contenido/"+response.data.id+"/talleres/resueltos";

} else if(response.data.rol == 'estudiante'){
  window.location = "/sistema/unidad/"+response.data.id;
}

}).catch(function(error){
});
},

}
})
</script>
@endsection