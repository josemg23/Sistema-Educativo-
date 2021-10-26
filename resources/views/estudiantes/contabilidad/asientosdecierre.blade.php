<div id="asientos_cierre">
    <h1 class="text-center text-danger font-weight-bold mt-2">ASIENTOS DE CIERRE</h1>
    <div class="row justify-content-center">
        <div class="col-3">
            <h2 class="text-center font-weight-bold display-4">@{{ nombre }}</h2>
        </div>
    </div>
    <div class="row p-3  mb-2 ">
        <div class="col-12">
            <table class="table table-bordered table-sm">
                <thead class="thead-dark">
                    <tr align="center">
                        <th scope="col" width="200">FECHA</th>
                        <th scope="col" width="450">NOMBRE DE CUENTAS</th>
                        <th scope="col " width="125">DEBE</th>
                        <th scope="col">HABER</th>
                        
                    </tr>
                </thead>
                <tbody v-for="(registro, id) in registros" >
                    <tr v-for="(diar, index) in registro.debe">
                        <td align="center" width="50">@{{ formatoFecha(diar.fecha)}}</td>
                        <td align="rigth">@{{ diar.nom_cuenta}}</td>
                        <td class="text-right" width="125">@{{ decimales(diar.saldo) }}</td>
                        <td class="text-right" width="125"></td>
                    </tr>
                    <tr v-for="(diar, index) in registro.haber">
                        <td align="center" width="50"></td>
                        <td style="padding-left:50px">@{{ diar.nom_cuenta}}</td>
                        <td class="text-right" width="125"></td>
                        <td class="text-right" width="125">@{{ decimales(diar.saldo) }}</td>
                    </tr>
                    <tr class="text-muted">
                        <td></td>
                        <td>@{{ registro.comentario }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr >
                        <td class="bg-dark" align="center" colspan="2" width="450" valign="middle">TOTAL</td>
                        <td class="bg-dark text-right"  width="125">
                            @{{ decimales(pasan.debe) }}
                        </td>
                        <td class="bg-dark text-right"  width="125">
                            @{{ decimales(pasan.haber) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>