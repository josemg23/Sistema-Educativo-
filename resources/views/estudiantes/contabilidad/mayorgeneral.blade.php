<div id="mayor_general" class=" p-4">
    <h1 class="text-center text-danger font-weight-bold mt-2">MAYOR GENERAL</h1>
    <div class="row justify-content-center">
        <div class="col-3 mb-2">
            <h2 class="text-center font-weight-bold display-4">@{{ nombre }}</h2>
            
        </div>
    </div>
    <div class="row justify-content-center">
        <div v-for="(cuenta, index) in registros" class="col-11">
            <h3 class="text-center font-weight-bold text-danger">@{{ cuenta.cuenta }} </h3>
            <table class="table table-bordered table-sm">
                <thead class="thead-dark">
                    <tr align="center">
                        <th scope="col" width="200">FECHA</th>
                        <th scope="col" width="450">DETALLE</th>
                        <th scope="col" width="125">DEBE</th>
                        <th scope="col">HABER</th>
                        <th scope="col">SALDO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(diar, index) in cuenta.registros">
                        <td align="center" width="50">@{{ formatoFecha(diar.fecha)}}</td>
                        <td align="rigth">@{{ diar.detalle}}</td>
                        <td class="text-right" width="125">@{{ decimales(diar.debe) }}</td>
                        <td class="text-right" width="125">@{{ decimales(diar.haber) }}</td>
                        <td class="text-right" width="125">@{{ decimales(diar.saldo) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="font-weight-bold text-gray-dark">SUMAN</td>
                        <td class="text-right font-weight-bold text-gray-dark">@{{ decimales(cuenta.total_debe )}}</td>
                        <td class="text-right font-weight-bold text-gray-dark">@{{ decimales(cuenta.total_haber) }}</td>
                        <td class="text-right font-weight-bold text-gray-dark">{{-- @{{ decimales(cuenta.total_saldo) }} --}}</td>
                    </tr>
                    <tr v-for="(diar, index) in cuenta.cierres">
                        <td align="center" width="50">@{{ formatoFecha(diar.fecha)}}</td>
                        <td align="rigth">@{{ diar.detalle}}</td>
                        <td class="text-right" width="125">@{{ decimales(diar.debe) }}</td>
                        <td class="text-right" width="125">@{{ decimales(diar.haber) }}</td>
                        <td class="text-right" width="125">@{{ decimales(diar.saldo) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>