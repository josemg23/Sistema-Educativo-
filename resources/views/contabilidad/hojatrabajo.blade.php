<div id="hoja_trabajo" class="border border-danger p-4">
        <h2 class="text-center display-4 font-weight-bold text-danger">HOJA DE TRABAJO</h2>
<div class="row p-3  mb-2 justify-content-center ">
    <div class="col-5 mb-3">
          <input autocomplete="ÑÖcompletes" class="form-control text-center" type="text" v-model="nombre" placeholder="Nombre de la empresa" name="" >
        </div>
   
</div>
 @if ($rol === 'estudiante' or 'docente')
   <div class="row justify-content-start mb-2">
            <a  href="#" class="addDiario btn btn-outline-info " @click.prevent="abrirTransaccion()">Agregar Movimientos</a>
            <a  href="#" class="addDiario btn btn-outline-success ml-1" @click.prevent="guardarHoja()">Guardar Hoja</a>
            
</div>
@endif
<table class="table table-bordered table-sm table-responsive">
<thead class="bg-dark">
  <tr>
    <th class="text-center " style="vertical-align: middle;"  rowspan="2">CUENTAS</th>
    <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE DE COMPROBACION</th>
    <th class="text-center" style="vertical-align: middle;" colspan="2">AJUSTES</th>
    <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE AJUSTADO</th>
    <th class="text-center" style="vertical-align: middle;" colspan="2">ESTADO DE RESULTADO</th>
    <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE GENERAL</th>
    <th  class="text-center" valign="center" v-if="registros.length >=1" colspan="2" rowspan="2">ACCIONES</th>

  </tr>
  <tr>
    <td class="text-center" width="125">DEBE</td>
    <td class="text-center" width="125">HABER</td>
    <td class="text-center" width="125">DEBE</td>
    <td class="text-center" width="125">HABER</td>
    <td class="text-center" width="125">DEBE</td>
    <td class="text-center" width="125">HABER</td>
    <td class="text-center" width="125">DEBE</td>
    <td class="text-center" width="125">HABER</td>
    <td class="text-center" width="125">DEBE</td>
    <td class="text-center" width="125">HABER</td>
  </tr>
</thead>
<tbody>
     <tr v-for="(balan, index) in registros" >
                <td class="text-left" width="200">@{{ balan.cuenta}}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(balan.bc_debe)}}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(balan.bc_haber) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(balan.ajuste_debe) }}</td>
                <td  class="text-right"align="center" width="125">@{{ decimales(balan.ajuste_haber) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(balan.ba_debe) }}</td>
                <td  class="text-right"align="center" width="125">@{{ decimales(balan.ba_haber) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(balan.er_debe) }}</td>
                <td  class="text-right"align="center" width="125">@{{ decimales(balan.er_haber) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(balan.bg_debe) }}</td>
                <td  class="text-right"align="center" width="125">@{{ decimales(balan.bg_haber) }}</td>
                <td align="center"  width="50"><a @click.prevent="editBalanceFuera(index)" class="btn btn-warning"><i
                            class="fas fa-edit"></i></a></td>
                <td align="center" width="50"><a @click.prevent="warningEliminar(index)"  class="btn btn-danger"><i
                            class="fas fa-trash-alt"></i></a></td>
        </tr>
       {{--  <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2050000</td>
            <td></td>
            <td></td>
            <td></td>
        </tr> --}}
  <tr>
    <td class="font-weight-bold">SUMAN</td>
    <td class="text-right">@{{ suman.balance_comp.total_debe }}</td>
    <td class="text-right">@{{ suman.balance_comp.total_haber }}</td>
    <td class="text-right">@{{ suman.ajustes.total_debe }}</td>
    <td class="text-right">@{{ suman.ajustes.total_haber }}</td>
    <td class="text-right">@{{ suman.balance_ajustado.total_debe }}</td>
    <td class="text-right">@{{ suman.balance_ajustado.total_haber }}</td>
    <td class="text-right">@{{ suman.estado_resultado.total_debe }}</td>
    <td class="text-right">@{{ suman.estado_resultado.total_haber }}</td>
    <td class="text-right">@{{ suman.balance_general.total_debe }}</td>
    <td class="text-right">@{{ suman.balance_general.total_haber }}</td>
  </tr>
</tbody>
</table>
 @if ($rol === 'estudiante' or 'docente')

	    <div class="row justify-content-center mb-2">
            <a  href="#" class="addDiario btn btn-outline-info " @click.prevent="abrirTransaccion()">Agregar Movimientos</a>
        </div>

        <div class="row justify-content-center">
            <a  href="#" class="addDiario btn btn-outline-success " @click.prevent="guardarHoja()">Guardar Hoja</a>
        </div>
@endif

    @include ('contabilidad.modales.modalhojatrabajo')

</div>