@extends('layouts.nav')

@section('title', 'Crear Plan de Cuenta')



@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> Parece que hay porblemas  <br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section class="content">
    <div class="container" id="cuentas">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="font-weight-light">Editar Cuenta</h1>
                <div class="row">
                    <div class="col-md-8">

                        <form method="POST" action="{{route('pcuentas.update', $pcuentas->id)}} ">
                        @method('PUT')   
                        @csrf
                        
                            <div class=" card-body">
                                <div class="form-group">
                                    <label>Tip de Cuenta</label>
                                    <select class="form-control select" v-model="cuenta.tpcuenta" name="tpcuenta" style="width: 99%;">
                                        <option selected disabled value="{{$pcuentas->tpcuenta}}">{{$pcuentas->tpcuenta}}</option>
                                        <option value="activos">Activo</option>
                                        {{-- <option>Activo Corriente</option>
                                        <option>Activo Diferido</option> --}}
                                        {{-- <option value="">Activo Fijo</option> --}}
                                        <option value="pasivos">Pasivo</option>
                                        {{-- <option>Pasivo Corriente</option>
                                        <option>Pasivo Fijo</option> --}}
                                      {{--   <option>Pasivo Diferido</option> --}}
                                        <option value="patrimonios">Patrimonio</option>
                                        <option value="ingresos">Ingresos</option>
                                        <option value="costos y gastos">Costos y Gastos</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="cuenta">Cuenta</label>
                                    <input type="text" class="form-control"  name="nombre"
                                        id="cuenta" placeholder="Cuenta" v-model="cuenta.nombre">
                                </div>
                                   <div class="form-group">
                                    <label for="cuenta">Porcentual</label>
                                    <input type="checkbox" v-model="porcentual" name="porcentual" class="custom-checkbox">
                                </div>
                                   <div v-if="porcentual" class="form-group">
                                    <label for="cuenta">Porcentaje</label>
                                    <input type="text" class="form-control"  name="porcentaje"
                                        id="cuenta" placeholder="Cuenta" v-model="cuenta.porcentaje">
                                </div>

                                <div class="form-group">
                                <label for="nombre">Estado</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" v-model="cuenta.estado" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" >
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" v-model="cuenta.estado" id="estadooff" name="estado" class="custom-control-input"
                                        value="off">
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                                </div>
                                <a href="{{route('pcuentas.index')}}" class="btn btn-primary">Atras</a>
                                <a href="" class="btn btn-dark" @click.prevent="actualizar()">Guardar</a>
                                {{-- <input type="submit" class="btn btn-dark " value="Guardar"> --}}
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>





@stop



@section('css')

@stop

@section('js')
<script>
$(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
});
let por = @json($pcuentas);
console.log(por);
let cuentas = new Vue({

  el: "#cuentas",
  data:{
    cuenta: por,
    porcentual:false

  },
  mounted: function () {
      if (this.cuenta.porcentual == 1) {
        this.porcentual = true
      }else{
        this.porcentual = false
      }
  },
methods:{
      actualizar: function() {
        let set = this;

        if (this.porcentual == true){

            if (this.cuenta.porcentaje == null) {
        toastr.info("Debes agregar un porcentaje", "Smarmoddle", {
            "timeOut": "3000"
            });
             return
            }
        }
        let id = set.cuenta.id;
        let url = '/sistema/pcuentas/actualizar';
        console.log(url)
            axios.post(url,{
                id:set.cuenta.id,
                nombre: set.cuenta.nombre,
                tpcuenta: set.cuenta.tpcuenta,
                porcentual: set.porcentual,
                porcentaje: set.cuenta.porcentaje,
                estado: set.cuenta.estado 
        }).then(response => {
          if (response.data.success == true) {
                window.location.href = '/sistema/pcuentas';
            }          
        }).catch(function(error){

        }); 
     } 
}
});
</script>


@stop