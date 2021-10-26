<div id="balance_comp" class="border border-danger p-4">
    <h2 class="text-center display-4 font-weight-bold text-danger">Balance de Comprobacion</h2>
    <div class="row p-3  mb-2 justify-content-center ">
        <div class="col-8 mb-3">
            <h2 class="text-center font-weight-bold display-4">@{{ nombre }}</h2>
        </div>
        <div class="col-5">
            <h4 class="text-center font-weight-bold display-4">@{{ fecha }}</h4>
            
        </div>
        
    </div>
    <table class="table table-bordered table-sm mb-2">
        <thead>
            <tr class="bg-dark">
                <th rowspan="2" align="center" class="text-center">CUENTAS</th>
                <th colspan="2" align="center" class="text-center">SUMAS</th>
                <th colspan="2" align="center" class="text-center">SALDOS</th>
            </tr>
            <tr class="bg-dark">
                <td align="center">Debe</td>
                <td align="center">Haber</td>
                <td align="center">Debe</td>
                <td align="center">Haber</td>
            </tr>
        </thead>
        <tbody >
            <tr v-for="(balan, index) in balances" >
                <td class="text-left">@{{ balan.cuenta}}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(balan.suma_debe)}}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(balan.suma_haber) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(balan.saldo_debe) }}</td>
                <td  class="text-right"align="center" width="125">@{{ decimales(balan.saldo_haber) }}</td>
            </tr>
            <tr class="text-center bg-secondary">
                <td align="center" valign="middle">SUMAN</td>
                <td class="text-right">@{{ suman.sum_debe }}</td>
                <td class="text-right">@{{ suman.sum_haber }}</td>
                <td class="text-right">@{{ suman.sal_debe }}</td>
                <td class="text-right">@{{ suman.sal_haber }}</td>
            </tr>
        </tbody>
    </table>
</div>