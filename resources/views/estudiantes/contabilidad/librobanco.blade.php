<div id="librosbanco" class="border border-danger p-4">
    <h2 class="text-center display-4 font-weight-bold text-danger">Anexos de Control Interno</h2>
    <h3 class="text-center display-4 font-weight-bold text-danger">Libro Banco</h3>
    <div class="row p-3  mb-2 justify-content-center ">
        <div class="col-5">
            <h3 class="text-center font-weight-bold display-4">@{{ nombre }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3 class="text-center font-weight-bold display-4">@{{ n_banco }}</h3>
        </div>
        <div class="col">
            <h3 class="text-center font-weight-bold display-4">@{{ c_banco }}</h3>
        </div>
    </div>
    <br>
    <table style="border: hidden" class="table table-bordered table-sm mb-2">
        <thead style="border: hidden">
            <tr style="border: hidden" class="text-center bg-dark">
                <th width="100">Fecha</th>
                <th width="300">Detalle</th>
                <th width="50"><i>Ch/</i></th>
                <th width="90">Debe</th>
                <th width="90">Haber</th>
                <th width="100">Saldo</th>
            </tr>
        </thead>
        <tbody style="border: hidden" is="draggable" group="people" :list="lb_banco" tag="tbody">
            <tr style="border: hidden" v-for="(banco, index) in lb_banco">
                <td align="left">@{{formatoFecha(banco.fecha)}}</td>
                <td align="left">@{{banco.detalle}}</td>
                <td align="left">@{{banco.cheque}}</td>
                <td align="right">@{{decimales(banco.debe)}}</td>
                <td align="right">@{{decimales(banco.haber)}}</td>
                <td align="right">@{{decimales(banco.saldo)}}</td>
            </tr>
            <tr style="border: hidden" class="bg-secondary">
                <td class="text-center font-weight-bold">SUMAN</td>
                <td class="text-left font-weight-bold"></td>
                <td class="text-left font-weight-bold"></td>
                <td class="text-right font-weight-bold">@{{ suman.debe }}</td>
                <td class="text-right font-weight-bold">@{{ suman.haber }}</td>
            </tr>
        </tbody>
    </table>
    <br>
</div>