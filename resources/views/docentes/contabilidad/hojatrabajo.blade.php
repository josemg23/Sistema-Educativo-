<div id="hoja_trabajo" class="border border-danger p-4">
    <h2 class="text-center display-4 font-weight-bold text-danger">HOJA DE TRABAJO</h2>
    <div class="row p-3  mb-2 justify-content-center ">
        <div class="col-5 mb-3">
            <h2 class="text-center font-weight-bold display-4">@{{ nombre }}</h2>
        </div>
    </div>
    <table class="table table-bordered table-sm">
        <thead class="bg-dark">
            <tr>
                <th class="text-center " style="vertical-align: middle;"  rowspan="2">CUENTAS</th>
                <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE DE COMPROBACION</th>
                <th class="text-center" style="vertical-align: middle;" colspan="2">AJUSTES</th>
                <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE AJUSTADO</th>
                <th class="text-center" style="vertical-align: middle;" colspan="2">ESTADO DE RESULTADO</th>
                <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE GENERAL</th>
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
            </tr>
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
</div>