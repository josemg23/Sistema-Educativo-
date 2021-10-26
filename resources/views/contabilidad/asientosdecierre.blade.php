<div id="asientos_cierre" class="border border-danger  p-3">
    <h1 class="text-center text-danger font-weight-bold mt-2">ASIENTOS DE CIERRE</h1>
    <div class="row justify-content-center">
        <div class="col-3">
            <input autocomplete="ÑÖcompletes" type="text" v-model="nombre" class="form-control text-center"
                placeholder="Nombre de la Empresa">
        </div>
    </div>

    <div class="row p-3  mb-2 justify-content-star">
        @if ($rol === 'estudiante' or 'docente')
        <div class="col-12 p-2">
            <a href="#" class="btn btn-sm btn-outline-primary ml-1" @click.prevent="abrirTransaccion()">Crear Asiento de
                        Cierre</a>
            <a href="#" class="addDiario btn-sm btn btn-danger ml-1" @click.prevent="guardarDiario()">GUARDAR ASIENTOS DE CIERRE</a>

            @if($datos->metodo == 'concatenado')
            <a href="#" class="btn btn-sm btn-outline-danger ml-1" @click.prevent="llamarDiario()">Ir al Mayor General</a>
                       
        @endif
        </div>
            
        @endif
        <div class="col-12">
            <table class="table table-bordered table-sm">
                <thead class="thead-dark">
                    <tr align="center">
                        <th scope="col" width="200">FECHA</th>
                        <th scope="col" width="450">NOMBRE DE CUENTAS</th>
                        <th scope="col " width="125">DEBE</th>
                        <th scope="col">HABER</th>
                        <th width="75" colspan="2" v-if="registros.length > 0">ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(diar, index) in balanceInicial.debe">
                        <td v-if="index == 0" align="center" width="100">@{{ fechabalance }} </td>
                        <td v-else align="center"></td>
                        <td align="rigth">@{{ diar.nom_cuenta}}</td>
                        <td align="center" width="125">@{{ diar.saldo }}</td>
                        <td align="center" width="125"></td>
                    </tr>
                    <tr v-for="(diar, index) in balanceInicial.haber">
                        <td align="center" width="50"></td>
                        <td style="padding-left:50px">@{{ diar.nom_cuenta}}</td>
                        <td align="center" width="125"></td>
                        <td align="center" width="125">@{{ diar.saldo }}</td>
                    </tr>

                </tbody>

                <tbody v-for="(registro, id) in registros" @change="totalDebe()">
                    <tr v-for="(diar, index) in registro.debe">
                        <td align="center" width="50">@{{ formatoFecha(diar.fecha)}}</td>
                        <td align="rigth">@{{ diar.nom_cuenta}}</td>
                        <td class="text-right" width="125">@{{ decimales(diar.saldo) }}</td>
                        <td class="text-right" width="125"></td>
                        <td v-if="diar.fecha !== '' && diar.fecha !== null && registro.tipo !== 'inicial'"
                            align="center" width="50"><a @click="debeEditRegister(id)" class="btn btn-warning btn-sm"><i
                                    class="fas fas fa-edit"></i></a></td>
                        <td v-if="registro.tipo == 'inicial' && diar.fecha !== '' && diar.fecha !== null"></td>
                        <td v-if="diar.fecha != '' && diar.fecha !== null" align="center" width="50"><a
                                @click="deleteRegistro(id)" class="btn btn-danger btn-sm"><i
                                    class="fas fa-trash-alt"></i></a></td>
                        <td colspan="2" v-else></td>
                    </tr>
                    <tr v-for="(diar, index) in registro.haber">
                        <td align="center" width="50"></td>
                        <td style="padding-left:50px">@{{ diar.nom_cuenta}}</td>
                        <td class="text-right" width="125"></td>
                        <td class="text-right" width="125">@{{ decimales(diar.saldo) }}</td>
                        <td colspan="2"></td>

                    </tr>
                    <tr class="text-muted">
                        <td></td>
                        <td>@{{ registro.comentario }}</td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td class="bg-dark" align="center" colspan="2" width="450" valign="middle">TOTAL</td>
                        <td class="bg-dark text-right" width="125">
                            @{{ decimales(pasan.debe) }}
                        </td>
                        <td class="bg-dark text-right" width="125">
                            @{{ decimales(pasan.haber) }}
                        </td>
                        <td v-if="registros.length > 0" width="90" style="border: none;"></td>

                    </tr>
                </tbody>
            </table>

   
            <div class="row justify-content-center">
                 @if ($rol === 'estudiante' or 'docente')
        <div class="col-3 mb-2">
            <a href="#" class="btn btn-sm btn-outline-primary" @click.prevent="abrirTransaccion()">Crear Asiento de
                        Cierre</a>
        </div>
    
         <div class="col-4 mb-2">
                    <a href="#" class="addDiario btn btn-danger" @click.prevent="guardarDiario()">GUARDAR ASIENTOS DE CIERRE</a>
             
        </div>
            @if($datos->metodo == 'concatenado')
        <div class="col-3">
            <a href="#" class="btn btn-sm btn-outline-danger" @click.prevent="llamarDiario()">Ir al Mayor General</a>
        </div>
        @endif
        @endif
            </div>

        </div>
        @include ('contabilidad.modales.modalasientosdecierre')

    </div>
</div>