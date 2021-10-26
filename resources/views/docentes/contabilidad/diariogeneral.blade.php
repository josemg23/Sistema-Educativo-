<div id="diario">
    <h1 class="text-center text-danger font-weight-bold mt-2">DIARIO GENERAL</h1>
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
                    <tr v-for="(diardebe, index) in registro.debe">
                        <td align="center" width="50">@{{ formatoFecha(diardebe.fecha)}}</td>
                        <td align="rigth">@{{ diardebe.nom_cuenta}}</td>
                        <td class="text-right" width="125">@{{ decimales(diardebe.saldo) }}</td>
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
                        <td class="bg-dark" align="center" colspan="2" width="450" valign="middle">SUMAN</td>
                        <td class="bg-dark text-right"  width="125">
                            @{{ decimales(pasan.debe) }}
                        </td>
                        <td class="bg-dark text-right"  width="125">
                            @{{ decimales(pasan.haber) }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-if="ajustes.length > 0">
                <h2 class="font-weight-bold text-center">Asientos de ajustes </h2>
                <table class="table table-bordered table-sm">
                    <tbody v-for="(registro, id) in ajustes">
                        <tr v-for="(diardebe, index) in registro.debe">
                            <td align="center"width="200">@{{ formatoFecha(diardebe.fecha)}}</td>
                            <td align="rigth" width="450">@{{ diardebe.nom_cuenta}}</td>
                            <td align="center" width="125">@{{ decimales(diardebe.saldo) }}</td>
                            <td align="center" width="125"></td>
                        </tr>
                        <tr v-for="(diar, index) in registro.haber">
                            <td align="center" width="50"></td>
                            <td style="padding-left:50px">@{{ diar.nom_cuenta}}</td>
                            <td align="center" width="125"></td>
                            <td align="center" width="125">@{{ decimales(diar.saldo) }}</td>
                            
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
                                @{{ decimales(total.debe) }}
                            </td>
                            <td class="bg-dark text-right"  width="125">
                                @{{ decimales(total.haber) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-center">
            </div>
        </div>
        
    </div>
</div>
<h2 class="text-center font-weight-bold">Aplicacion de Documentos</h2>
<div class="row justify-content-center mb-5 p-5" id="documentos" >
    <div class="col-12"  style="height: 200px; overflow-y: scroll; overflow-x: hidden;">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col">Tipo de Documento</th>
                    <th scope="col">Fecha</th>
                    <th  width="200" class="text-center">Ver Documento</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(cheque, index) in cheques">
                    <td>@{{ cheque.tipo_documento }}</td>
                    <td>@{{ formatoFecha(cheque.modulo) }}</td>
                    <td class="text-center"><a class="btn btn-success" href="" @click.prevent="verCheque(cheque.id, index)"><i class="fa fa-money-bill"></i></a>
                </td>
            </tr>
            <tr v-for="(nota_credito, index) in nota_creditos">
                <td>@{{ nota_credito.tipo_documento }}</td>
                <td>@{{ formatoFecha(nota_credito.modulo) }}</td>
                <td class="text-center"><a class="btn btn-danger" href="" @click.prevent="verNota(nota_credito.id, index)"><i class="fa fa-file-invoice-dollar"></i></a>
            </td>
        </tr>
        <tr v-for="(factura, index) in facturas">
            <td>@{{ factura.tipo_documento }}</td>
            <td>@{{ formatoFecha(factura.modulo) }}</td>
            <td class="text-center"><a class="btn btn-info" href="" @click.prevent="verFactura(factura.id, index)"><i class="fa fa-file-invoice-dollar"></i></a>
        </td>
    </tr>
    <tr v-for="(letra_cambio, index) in letra_cambios">
        <td>@{{ letra_cambio.tipo_documento }}</td>
        <td>@{{ formatoFecha(letra_cambio.modulo) }}</td>
        <td class="text-center"><a class="btn btn-warning" href="" @click.prevent="verLetra(letra_cambio.id, index)"><i class="fa fa-file-invoice-dollar"></i></td>
    </tr>
    <tr v-for="(pagare, index) in pagares">
        <td>@{{ pagare.tipo_documento }}</td>
        <td>@{{ formatoFecha(pagare.modulo) }}</td>
        <td class="text-center"><a class="btn btn-secondary" href="" @click.prevent="verPagare(pagare.id, index)"><i class="fa fa-file-invoice-dollar"></i></td>
    </tr>
    <tr v-for="(papeleta_deposito, index) in papeleta_depositos">
        <td>@{{ papeleta_deposito.tipo_documento }}</td>
        <td>@{{ formatoFecha(papeleta_deposito.modulo) }}</td>
        <td class="text-center"><a class="btn btn-primary" href="" @click.prevent="verPapeleta(papeleta_deposito.id, index)"><i class="fa fa-file-invoice-dollar"></i></td>
    </tr>
</tbody>
</table>
</div>
@include('docentes.contabilidad.modales.modaldocumentos')
</div>