<div id="mayor_general" class="border border-danger   p-4">
    <h1 class="text-center text-danger font-weight-bold mt-2">MAYOR GENERAL</h1>
    <div class="row justify-content-center">
        <div class="col-3 mb-2">
            <input autocomplete="ÑÖcompletes" type="text" v-model="nombre" class="form-control text-center"
            placeholder="Nombre de la Empresa">
        </div>
    </div>
    @if ($rol === 'estudiante' or 'docente')
    <a href="#" v-if="registros.length >= 1" class="btn btn-outline-primary" @click.prevent="abrirTransaccion()">Transacciones</a>
    <a href="#" v-if="registros.length >= 1" class="addDiario btn btn-outline-secondary ml-1" @click.prevent="guardarMayor()">Guardar Mayor General</a>
    @endif
    <div class="row justify-content-center">
        <div v-for="(cuenta, index) in registros" class="col-11">
            <a href="" class="float-right btn bt-sm btn-danger ml-2" @click.prevent="warningEliminar(index)"><i
            class="fas fa-trash"></i> </a>
            <a href="" class="float-right btn bt-sm btn-warning " @click.prevent="editarTransaccion(index)"><i
            class="fas fa-edit"></i> </a>
            <h3 class="text-center font-weight-bold text-danger">@{{ cuenta.cuenta }} </h3>
            <table class="table table-bordered table-sm">
                <thead class="thead-dark">
                    <tr align="center">
                        <th scope="col" width="200">FECHA</th>
                        <th scope="col" width="450">DETALLE</th>
                        <th scope="col" width="125">DEBE</th>
                        <th scope="col">HABER</th>
                        <th scope="col">SALDO</th>
                        {{-- <th width="75" colspan="2" v-if="registros.length > 0">ACCION</th> --}}
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
                        <td class="text-right font-weight-bold text-gray-dark">@{{ cuenta.total_saldo }}
                        </td>
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
    @if ($rol === 'estudiante' or 'docente')
    <div class="row justify-content-around mb-2">
        <a href="#" class="btn btn-outline-primary" @click.prevent="abrirTransaccion()">Transacciones</a>
    </div>
    <div class="row justify-content-center">
        <a href="#" class="addDiario btn btn-outline-secondary" @click.prevent="guardarMayor()">Guardar Mayor General</a>
    </div>
    @endif
    @include ('contabilidad.modales.modalmayorgeneral')
</div>