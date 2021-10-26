<div id="balance_ajustado" class="border border-danger p-4">
        <h2 class="text-center display-4 font-weight-bold text-danger">Balance de Comprobacion Ajustado</h2>
        <div class="row p-3  mb-2 justify-content-center ">
    <div class="col-5 mb-3">
            <h2 class="text-center font-weight-bold display-4">@{{ nombre }}</h2>
            <h2 class="text-center font-weight-bold display-4">@{{ fecha }}</h2>
        </div>
   
</div>
  <table class="table table-bordered table-sm mb-2">
<thead>
  <tr class="text-center bg-dark">
    <th>CUENTAS</th>
    <th width="200">DEBE</th>
    <th width="200">HABER</th>

  </tr>
</thead>
<tbody>

    <tr v-for="(balan, index) in balances_ajustados">
      <td class="text-left">@{{ balan.cuenta}}</td>
      <td class="text-right">@{{ decimales(balan.debe)}}</td>
      <td class="text-right" width="125">@{{ decimales(balan.haber) }}</td>
    </tr>
  <tr class="bg-secondary">
    <td class="text-left font-weight-bold">SUMAN</td>
    <td class="text-right">@{{ suman.debe }}</td>
    <td class="text-right">@{{ suman.haber }}</td>
  </tr>
</tbody>
</table>
</div>