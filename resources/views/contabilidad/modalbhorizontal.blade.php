{{-- ACTIVO CORRIENTE --}}
<div class="modal fade" id="a_corriente" tabindex="-1"  role="dialog" aria-labelledby="taller1Label" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="taller1Label">ACTIVO CORRIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
          <thead class="thead-dark">
        <tr>
          <th  align="center" class="text-center">Cuentas</th>
          <th  align="center" class="text-center">Saldo</th>    
        </tr>
       </thead>
        <tbody >
            
          <tr>
        <td>
             <model-select :options="options" 
                                v-model="activo.a_corriente.nom_cuenta"
                                placeholder="ELEGIR CUENTA" >
        </model-select>
       {{--  <select name="n_cuenta" id="" required v-model="activo.a_corriente.nom_cuenta" class="custom-select">
          <option value="" disabled>ELIGE UNA CUENTA</option>
          <option value="Banco">Bancos</option>
          <option value="Muebles">Muebles</option>
          <option value="Caja">Caja</option>
          <option value="Vehiculo">Vehiculo</option>
          <option value="Inv. Mercaderías">Inv. Mercaderías</option>
          <option value="Doc. por Cob">Doc. por Cob</option>
          <option value="Doc. por Pagar">Doc. por Pagar</option>
          <option value="Muebles Oficina">Muebles Oficina</option>
          <option value="Equipo Oficina">Equipo Oficina</option>
          <option value="Eq. de Comp">Eq. de Comp</option>
          <option value="Hip. por Pagar">Hip. por Pagar</option>
          <option value="Capital">Capital</option>
        </select> --}}
        </td>
        <td width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="activo.a_corriente.saldo" name="debe" class="form-control" required></td>
              
        </tr>
      </tbody>
    </table>
    <div class="row justify-content-center">
      <a href="#" class="btn btn-light" @click.prevent="agregarActivoCorriente()">Agregar Activo</a>
      
                      </div>
                  </div>
                </div>
                            </div>
           <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


{{-- ACTIVO NO CORRIENTE --}}
<div class="modal fade" id="a_nocorriente" tabindex="-1" role="dialog" aria-labelledby="a_nocorrienteLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="a_nocorriente1Label">ACTIVO NO CORRIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
          <thead class="thead-dark">
        <tr>
          <th  align="center" class="text-center">Cuentas</th>
          <th  align="center" class="text-center">Saldo</th>    
        </tr>
       </thead>
        <tbody >
            
          <tr>
        <td>
          <model-select :options="options" 
                v-model="activo.a_nocorriente.nom_cuenta"
                                placeholder="ELEGIR CUENTA" >
        </model-select>
{{--         <select name="n_cuenta" id="" v-model="" class="custom-select">
          <option value="" disabled>ELIGE UNA CUENTA</option>
          <option value="Banco">Bancos</option>
          <option value="Muebles">Muebles</option>
          <option value="Caja">Caja</option>
          <option value="Vehiculo">Vehiculo</option>
          <option value="Inv. Mercaderías">Inv. Mercaderías</option>
          <option value="Doc. por Cob">Doc. por Cob</option>
          <option value="Doc. por Pagar">Doc. por Pagar</option>
          <option value="Muebles Oficina">Muebles Oficina</option>
          <option value="Equipo Oficina">Equipo Oficina</option>
          <option value="Eq. de Comp">Eq. de Comp</option>
          <option value="Hip. por Pagar">Hip. por Pagar</option>
          <option value="Capital">Capital</option>
        </select> --}}
        </td>
        <td width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="activo.a_nocorriente.saldo" name="debe" class="form-control" required></td>
              
        </tr>
      </tbody>
    </table>
    <div class="row justify-content-center">
      <a href="#" class="addDiario btn btn-light" @click.prevent="agregarActivoNoCorriente()">Agregar Activo</a>
                      </div>
                  </div>
                </div>
                            </div>
           <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


{{-- PASIVO CORRIENTE --}}
<div class="modal fade" id="p_corriente" tabindex="-1" role="dialog" aria-labelledby="p_corrienteLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-success" >
            <div class="modal-header">
                <h5 class="modal-title" id="p_corriente1Label">PASIVO CORRIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
          <thead class="thead-dark">
        <tr>
          <th  align="center" class="text-center">Cuentas</th>
          <th  align="center" class="text-center">Saldo</th>    
        </tr>
       </thead>
        <tbody >
            
          <tr>
        <td>
             <model-select :options="options" 
                                v-model="pasivo.p_corriente.nom_cuenta"
                                placeholder="ELEGIR CUENTA" >
        </model-select>
       {{--  <select name="n_cuenta" id="" v-model="pasivo.p_corriente.nom_cuenta" class="custom-select">
        <option value="" disabled>ELIGE UNA CUENTA</option>
          <option value="Banco">Bancos</option>
          <option value="Muebles">Muebles</option>
          <option value="Caja">Caja</option>
          <option value="Vehiculo">Vehiculo</option>
          <option value="Inv. Mercaderías">Inv. Mercaderías</option>
          <option value="Doc. por Cob">Doc. por Cob</option>
          <option value="Doc. por Pagar">Doc. por Pagar</option>
          <option value="Muebles Oficina">Muebles Oficina</option>
          <option value="Equipo Oficina">Equipo Oficina</option>
          <option value="Eq. de Comp">Eq. de Comp</option>
          <option value="Hip. por Pagar">Hip. por Pagar</option>
          <option value="Capital">Capital</option>
        </select> --}}
        </td>
        <td width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="pasivo.p_corriente.saldo" name="debe" class="form-control" required></td>
              
        </tr>
      </tbody>
    </table>
    <div class="row justify-content-center">
      <a href="#"  class="addDiario btn btn-light" @click.prevent="agregarPasivoCorriente()">Agregar Pasivo</a>
     
                      </div>
                  </div>
                </div>
                            </div>
           <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


{{-- PASIVO NO CORRIENTE --}}
<div class="modal fade" id="p_nocorriente" tabindex="-1" role="dialog" aria-labelledby="p_nocorrienteLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h5 class="modal-title" id="p_nocorrienteLabel">PASIVO NO CORRIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
          <thead class="thead-dark">
        <tr>
          <th  align="center" class="text-center">Cuentas</th>
          <th  align="center" class="text-center">Saldo</th>    
        </tr>
       </thead>
        <tbody >
            
          <tr>
        <td>
             <model-select :options="options" 
                                v-model="pasivo.p_nocorriente.nom_cuenta"
                                placeholder="ELEGIR CUENTA" >
        </model-select>
{{--         <select name="n_cuenta" id="" v-model="pasivo.p_nocorriente.nom_cuenta" class="custom-select">
         <option value="" disabled>ELIGE UNA CUENTA</option>
          <option value="Banco">Bancos</option>
          <option value="Muebles">Muebles</option>
          <option value="Caja">Caja</option>
          <option value="Vehiculo">Vehiculo</option>
          <option value="Inv. Mercaderías">Inv. Mercaderías</option>
          <option value="Doc. por Cob">Doc. por Cob</option>
          <option value="Doc. por Pagar">Doc. por Pagar</option>
          <option value="Muebles Oficina">Muebles Oficina</option>
          <option value="Equipo Oficina">Equipo Oficina</option>
          <option value="Eq. de Comp">Eq. de Comp</option>
          <option value="Hip. por Pagar">Hip. por Pagar</option>
          <option value="Capital">Capital</option>
        </select> --}}
        </td>
        <td width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="pasivo.p_nocorriente.saldo" name="debe" class="form-control" required></td>
              
        </tr>
      </tbody>
    </table>
    <div class="row justify-content-center">
      <a href="#" class="addDiario btn btn-light" @click.prevent="agregarPasivoNoCorriente()">Agregar Pasivo</a>
                      </div>
                  </div>
                </div>
                            </div>
           <div class="modal-footer">
            </div>
        </div>
    </div>
</div>





{{-- PATRIMONIO --}}
<div class="modal fade" id="patrimonio" tabindex="-1" role="dialog" aria-labelledby="patrimonioLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="patrimonio1Label">PATRIMONIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
          <thead class="thead-dark">
        <tr>
          <th  align="center" class="text-center">Cuentas</th>
          <th  align="center" class="text-center">Saldo</th>    
        </tr>
       </thead>
        <tbody >
            
          <tr>
        <td>
             <model-select :options="options" 
                                v-model="patrimonio.nom_cuenta"
                                placeholder="ELEGIR CUENTA" >
        </model-select>
{{--         <select name="n_cuenta" id="" v-model="a" class="custom-select">
          <option value="" disabled>ELIGE UNA CUENTA</option>
          <option value="Banco">Bancos</option>
          <option value="Muebles">Muebles</option>
          <option value="Caja">Caja</option>
          <option value="Vehiculo">Vehiculo</option>
          <option value="Inv. Mercaderías">Inv. Mercaderías</option>
          <option value="Doc. por Cob">Doc. por Cob</option>
          <option value="Doc. por Pagar">Doc. por Pagar</option>
          <option value="Muebles Oficina">Muebles Oficina</option>
          <option value="Equipo Oficina">Equipo Oficina</option>
          <option value="Eq. de Comp">Eq. de Comp</option>
          <option value="Hip. por Pagar">Hip. por Pagar</option>
          <option value="Capital">Capital</option>
        </select> --}}
        </td>
        <td width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="patrimonio.saldo" name="debe" class="form-control" required></td>
              
        </tr>
      </tbody>
    </table>
    <div class="row justify-content-center">
      <a href="#" class="addDiario btn btn-light" @click.prevent="agregarPatrimonio()">Agregar Patrimonio</a>
     
                      </div>
                  </div>
                </div>
                            </div>
           <div class="modal-footer">
            </div>
        </div>
    </div>
</div>



{{-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}


{{-- ACTIVO CORRIENTE --}}
<div class="modal fade" id="a_corriente_e" tabindex="-1" role="dialog" aria-labelledby="taller1Label" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="taller1Label">ACTIVO CORRIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
          <thead class="thead-dark">
        <tr>
          <th  align="center" class="text-center">Cuentas</th>
          <th  align="center" class="text-center">Saldo</th>    
        </tr>
       </thead>
        <tbody >
            
          <tr>
        <td>
             <model-select :options="options" 
                                v-model="activo.a_corriente.nom_cuenta"
                                placeholder="ELEGIR CUENTA" >
        </model-select>
  {{--       <select name="n_cuenta" id="" v-model="activo.a_corriente.nom_cuenta" class="custom-select">
          <option value="" disabled>ELIGE UNA CUENTA</option>
          <option value="Banco">Bancos</option>
          <option value="Muebles">Muebles</option>
          <option value="Caja">Caja</option>
          <option value="Vehiculo">Vehiculo</option>
          <option value="Inv. Mercaderías">Inv. Mercaderías</option>
          <option value="Doc. por Cob">Doc. por Cob</option>
          <option value="Doc. por Pagar">Doc. por Pagar</option>
          <option value="Muebles Oficina">Muebles Oficina</option>
          <option value="Equipo Oficina">Equipo Oficina</option>
          <option value="Eq. de Comp">Eq. de Comp</option>
          <option value="Hip. por Pagar">Hip. por Pagar</option>
          <option value="Capital">Capital</option>
        </select> --}}
        </td>
        <td width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="activo.a_corriente.saldo" name="debe" class="form-control" required></td>
              
        </tr>
      </tbody>
    </table>
    <div class="row justify-content-center">
      
      <a href="#" class="btn btn-light" @click.prevent="updateACorriente()">Actualizar Activo</a>
                      </div>
                  </div>
                </div>
                            </div>
           <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


{{-- ACTIVO NO CORRIENTE --}}
<div class="modal fade" id="a_nocorriente_e" tabindex="-1" role="dialog" aria-labelledby="a_nocorrienteLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="a_nocorriente1Label">ACTIVO NO CORRIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
          <thead class="thead-dark">
        <tr>
          <th  align="center" class="text-center">Cuentas</th>
          <th  align="center" class="text-center">Saldo</th>    
        </tr>
       </thead>
        <tbody >
            
          <tr>
        <td>
             <model-select :options="options" 
                                v-model="activo.a_nocorriente.nom_cuenta"
                                placeholder="ELEGIR CUENTA" >
        </model-select>
{{--         <select name="n_cuenta" id="" v-model="activo.a_nocorriente.nom_cuenta" class="custom-select">
          <option value="" disabled>ELIGE UNA CUENTA</option>
          <option value="Banco">Bancos</option>
          <option value="Muebles">Muebles</option>
          <option value="Caja">Caja</option>
          <option value="Vehiculo">Vehiculo</option>
          <option value="Inv. Mercaderías">Inv. Mercaderías</option>
          <option value="Doc. por Cob">Doc. por Cob</option>
          <option value="Doc. por Pagar">Doc. por Pagar</option>
          <option value="Muebles Oficina">Muebles Oficina</option>
          <option value="Equipo Oficina">Equipo Oficina</option>
          <option value="Eq. de Comp">Eq. de Comp</option>
          <option value="Hip. por Pagar">Hip. por Pagar</option>
          <option value="Capital">Capital</option>
        </select> --}}
        </td>
        <td width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="activo.a_nocorriente.saldo" name="debe" class="form-control" required></td>
              
        </tr>
      </tbody>
    </table>
    <div class="row justify-content-center">
      <a href="#" class="addDiario btn btn-light"  @click.prevent="updateANoCorriente()">Actualizar Activo</a>
                      </div>
                  </div>
                </div>
                            </div>
           <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


{{-- PASIVO CORRIENTE --}}
<div class="modal fade" id="p_corriente_e" tabindex="-1"  role="dialog" aria-labelledby="p_corrienteLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-success" >
            <div class="modal-header">
                <h5 class="modal-title" id="p_corriente1Label">PASIVO CORRIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
          <thead class="thead-dark">
        <tr>
          <th  align="center" class="text-center">Cuentas</th>
          <th  align="center" class="text-center">Saldo</th>    
        </tr>
       </thead>
        <tbody >
            
          <tr>
        <td>
             <model-select :options="options" 
                                v-model="pasivo.p_corriente.nom_cuenta"
                                placeholder="ELEGIR CUENTA" >
        </model-select>
       {{--  <select name="n_cuenta" id="" v-model="pasivo.p_corriente.nom_cuenta" class="custom-select">
        <option :value="pasivo.p_corriente.nom_cuenta" disabled>@{{ pasivo.p_corriente.nom_cuenta }}</option>
         <option value="" disabled>ELIGE UNA CUENTA</option>
          <option value="Banco">Bancos</option>
          <option value="Muebles">Muebles</option>
          <option value="Caja">Caja</option>
          <option value="Vehiculo">Vehiculo</option>
          <option value="Inv. Mercaderías">Inv. Mercaderías</option>
          <option value="Doc. por Cob">Doc. por Cob</option>
          <option value="Doc. por Pagar">Doc. por Pagar</option>
          <option value="Muebles Oficina">Muebles Oficina</option>
          <option value="Equipo Oficina">Equipo Oficina</option>
          <option value="Eq. de Comp">Eq. de Comp</option>
          <option value="Hip. por Pagar">Hip. por Pagar</option>
          <option value="Capital">Capital</option>
        </select> --}}
        </td>
        <td width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="pasivo.p_corriente.saldo" name="debe" class="form-control" required></td>
              
        </tr>
      </tbody>
    </table>
    <div class="row justify-content-center">
      
      <a href="#"  class="btn btn-light" @click.prevent="updatePCorriente()">Actualizar Activo</a>
                      </div>
                  </div>
                </div>
                            </div>
           <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


{{-- PASIVO NO CORRIENTE --}}
<div class="modal fade" id="p_nocorriente_e" tabindex="-1" role="dialog" aria-labelledby="p_nocorrienteLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h5 class="modal-title" id="p_nocorrienteLabel">PASIVO NO CORRIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
          <thead class="thead-dark">
        <tr>
          <th  align="center" class="text-center">Cuentas</th>
          <th  align="center" class="text-center">Saldo</th>    
        </tr>
       </thead>
        <tbody >
            
          <tr>
        <td>
             <model-select :options="options" 
                                v-model="pasivo.p_nocorriente.nom_cuenta"
                                placeholder="ELEGIR CUENTA" >
        </model-select>
{{--         <select name="n_cuenta" id="" v-model="pasivo.p_nocorriente.nom_cuenta" class="custom-select">
         <option value="" disabled>ELIGE UNA CUENTA</option>
          <option value="Banco">Bancos</option>
          <option value="Muebles">Muebles</option>
          <option value="Caja">Caja</option>
          <option value="Vehiculo">Vehiculo</option>
          <option value="Inv. Mercaderías">Inv. Mercaderías</option>
          <option value="Doc. por Cob">Doc. por Cob</option>
          <option value="Doc. por Pagar">Doc. por Pagar</option>
          <option value="Muebles Oficina">Muebles Oficina</option>
          <option value="Equipo Oficina">Equipo Oficina</option>
          <option value="Eq. de Comp">Eq. de Comp</option>
          <option value="Hip. por Pagar">Hip. por Pagar</option>
          <option value="Capital">Capital</option>
        </select> --}}
        </td>
        <td width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="pasivo.p_nocorriente.saldo" name="debe" class="form-control" required></td>
              
        </tr>
      </tbody>
    </table>
    <div class="row justify-content-center">
      <a href="#" class="addDiario btn btn-light" @click.prevent="updatePNoCorriente()">Actualizar Pasivo</a>
                      </div>
                  </div>
                </div>
                            </div>
           <div class="modal-footer">
            </div>
        </div>
    </div>
</div>





{{-- PATRIMONIO --}}
<div class="modal fade" id="patrimonio_e" tabindex="-1" role="dialog" aria-labelledby="patrimonioLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="patrimonio1Label">PATRIMONIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
          <thead class="thead-dark">
        <tr>
          <th  align="center" class="text-center">Cuentas</th>
          <th  align="center" class="text-center">Saldo</th>    
        </tr>
       </thead>
        <tbody >
            
          <tr>
        <td>
             <model-select :options="options" 
                                v-model="patrimonio.nom_cuenta"
                                placeholder="ELEGIR CUENTA" >
        </model-select>
{{--         <select name="n_cuenta" id="" v-model="patrimonio.nom_cuenta" class="custom-select">
          <option value="" disabled>ELIGE UNA CUENTA</option>
          <option value="Banco">Bancos</option>
          <option value="Muebles">Muebles</option>
          <option value="Caja">Caja</option>
          <option value="Vehiculo">Vehiculo</option>
          <option value="Inv. Mercaderías">Inv. Mercaderías</option>
          <option value="Doc. por Cob">Doc. por Cob</option>
          <option value="Doc. por Pagar">Doc. por Pagar</option>
          <option value="Muebles Oficina">Muebles Oficina</option>
          <option value="Equipo Oficina">Equipo Oficina</option>
          <option value="Eq. de Comp">Eq. de Comp</option>
          <option value="Hip. por Pagar">Hip. por Pagar</option>
          <option value="Capital">Capital</option>
        </select> --}}
        </td>
        <td width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="patrimonio.saldo" name="debe" class="form-control" required></td>
              
        </tr>
      </tbody>
    </table>
    <div class="row justify-content-center">
      <a href="#" class="addDiario btn btn-light" @click.prevent="updatePatrimonio()">Actualizar Patrimonio</a>
                      </div>
                  </div>
                </div>
                            </div>
           <div class="modal-footer">
            </div>
        </div>
    </div>
</div>



{{-- TOTAL PASIVO + PATRIMONIO --}}
<div class="modal fade" id="pasivo_patrimonio" tabindex="-1"  role="dialog" aria-labelledby="p_corrienteLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-sm" role="document">
        <div class="modal-content bg-success" >
            <div class="modal-header">
                <h5 class="modal-title" id="p_corriente1Label">TOTAL PASIVO - PATRIMONIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
          <thead class="thead-dark">
        <tr>
          <th  align="center" class="text-center">Total</th>    
        </tr>
       </thead>
        <tbody > 
          <tr>
            <td width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="total_balance_inicial.t_patrimonio_pasivo" name="debe" class="form-control" required></td>   
        </tr>
      </tbody>
    </table>
    <div class="row justify-content-center">     
      <a href="#"  class="btn btn-light" @click.prevent="totalPasivoPatrimonio()">Aceptar</a>
                      </div>
                  </div>
                </div>
                            </div>
           <div class="modal-footer">
            </div>
        </div>
    </div>
</div>