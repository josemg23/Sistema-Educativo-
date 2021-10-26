<div id="balance_ajustado" class="border border-danger p-4">
        <h2 class="text-center display-4 font-weight-bold text-danger">Balance de Comprobacion Ajustado</h2>
        <div class="row p-3  mb-2 justify-content-center ">
    <div class="col-5 mb-3">
          <input autocomplete="ÑÖcompletes" class="form-control text-center mb-2" type="text" v-model="nombre" placeholder="Nombre de la empresa" name="" >
          <input autocomplete="ÑÖcompletes" class="form-control text-center" type="date" v-model="fecha" name="" >

        </div>

   
</div>
        {{-- <h2 class="text-center">Agregar Cuenta</h2> --}}
{{--     <div class="form-row mb-2 justify-content-center">
        <div class="col-xl col-sm-12 mb-sm-1">
           <select name="n_cuenta" id="" v-model="balance.cuenta" class="custom-select">
            <option value="" disabled>ELIGE UNA CUENTA</option>
            <option value="banco">BANCO</option>
            <option value="muebles">MUEBLES</option>
            <option value="caja">CAJA</option>
            <option value="vehiculo">VEHICULO</option>
            </select>
        </div>
        <div class="col-xl col-sm-12 mb-sm-1">
          <input autocomplete="ÑÖcompletes" type="text" class="form-control" v-model="balance.debe" placeholder="Debe">
        </div>
         <div class="col-xl col-sm-12 mb-sm-1" >
          <input autocomplete="ÑÖcompletes" type="text" class="form-control" v-model="balance.haber"  placeholder="Haber">
        </div>

        <a  v-if="!update" href="#" class=" addDiario btn btn-outline-danger  " @click.prevent="agregarRegistro()">Agregar Registro</a>
        <a  v-if="update" href="#" class="  addDiario btn btn-outline-danger  " @click.prevent="actualizarBalance()">Actualizar Registro</a>

  </div> --}}
  @if ($rol === 'estudiante' or 'docente')
   <div class="row justify-content-start mb-2">
      <a  href="#" class="addDiario btn btn-outline-info mr-2 " @click.prevent="abrirTransaccion()">Agregar Movimientos</a>
      <a  href="#" class="addDiario btn btn-outline-success " @click.prevent="guardarBalance()">Guardar Balance Ajustado</a>
  </div>
@endif
  <table class="table table-bordered table-sm mb-2">
<thead>
  <tr class="text-center bg-dark">
    <th>CUENTAS</th>
    <th width="200">DEBE</th>
    <th width="200">HABER</th>
    <th class="text-center" v-if="balances_ajustados.length >=1" colspan="2">ACCIONES</th>

  </tr>
</thead>
<tbody is="draggable" group="people" :list="balances_ajustados" tag="tbody">

    <tr v-for="(balan, index) in balances_ajustados">
      <td class="text-left">@{{ balan.cuenta}}</td>
      <td class="text-right">@{{ decimales(balan.debe)}}</td>
      <td class="text-right" width="125">@{{ decimales(balan.haber) }}</td>
       <td class="text-right"  width="50">
        <a @click.prevent="editBalanceFuera(index)" class="btn btn-warning">
          <i class="fas fa-edit"></i>
        </a>
      </td>
      <td align="center" width="50">
        <a @click.prevent="warningEliminar(index)" class="btn btn-danger">
          <i class="fas fa-trash-alt"></i>
        </a>
      </td>
     
    </tr>
  <tr class="bg-secondary">
    <td class="text-left font-weight-bold">SUMAN</td>
    <td class="text-right">@{{ suman.debe }}</td>
    <td class="text-right">@{{ suman.haber }}</td>
  </tr>
</tbody>
</table>
 @if ($rol === 'estudiante' or 'docente')
 <div class="row justify-content-center mb-2">
      <a  href="#" class="addDiario btn btn-outline-info " @click.prevent="abrirTransaccion()">Agregar Movimientos</a>
  </div>
    <div class="row justify-content-center">
        <a  href="#" class="addDiario btn btn-outline-success " @click.prevent="guardarBalance()">Guardar Balance Ajustado</a>
        
    </div>
  @endif
    @include ('contabilidad.modales.modalbalanceajustado')

</div>