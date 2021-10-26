{{-- TRANSACCION --}}
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="mg-transaccion" tabindex="-1" role="dialog"
    aria-labelledby="dg-mg-transaccionLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl " role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <div v-if="update">
                    <h5 class="modal-title" id="mg-transaccionLabel">ACTUALIZAR TRANSACCION</h5>
                </div>
                <div v-else="!update">
                    <h5 class="modal-title" id="mg-transaccionLabel">AGREGAR TRANSACCION</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" {{-- style=" overflow-y: scroll; overflow-x: hidden; height: 700px" --}}>
                <a class="btn btn-dark mb-2" href="" @click.prevent="calculadora()">CALCULADORA</a>

                <div class="row justify-content-center">
                    <div class="col-6 ">
                        <h2 class="text-center">AGREGAR MOVIMIENTOS</h2>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Selecciona la Cuenta</label>
                            <div class="col-sm-7">
                                <multiselect v-model="mayor.seleccion" :options="options" placeholder="Elige Una Cuenta"
                                    label="text" track-by="value" @input="onSelect()"></multiselect>
                                {{-- <model-select :options="options" v-model="mayor.cuenta" placeholder="ELEGIR CUENTA"  @click="onSelect"></model-select> --}}
                            </div>
                            {{-- <div class="col-sm-2">
                                <a href="" class="btn btn-danger" @click.prevent="onSelect">Seleccionar</a>
                            </div> --}}
                        </div>
                        <table class="table table-bordered table-sm mb-2">
                            <thead class="bg-success">
                                <tr>
                                    <th>Fecha</th>
                                    <th align="center" class="text-center">Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="20">
                                        <input autocomplete="ÑÖcompletes" type="date" v-model="mayor.registro.fecha"
                                            name="fecha" class="form-control">
                                    </td>
                                    <td>
                                        <input autocomplete="ÑÖcompletes" type="text" v-model="mayor.registro.detalle"
                                            name="debe" class="form-control">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered table-sm mb-2">
                            <thead class="bg-success">
                                <tr>
                                    <th width="50">Debe</th>
                                    <th width="50" align="center" class="text-center">Haber</th>
                                    <th width="50" align="center" class="text-center">Saldo</th>
                                    <th v-if="registros_cierres.length > 0" width="50" align="center"
                                        class="text-center">Cierre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input autocomplete="ÑÖcompletes" type="number" v-model="mayor.registro.debe"
                                            name="fecha" class="form-control">
                                    </td>
                                    <td>
                                        <input autocomplete="ÑÖcompletes" type="number" v-model="mayor.registro.haber"
                                            name="fecha" class="form-control">
                                    </td>
                                    <td width="125">
                                        <input autocomplete="ÑÖcompletes" type="number" v-model="mayor.registro.saldo"
                                            name="debe" class="form-control">
                                    </td>
                                    <td v-if="registros_cierres.length > 0" align="center">
                                        <input autocomplete="ÑÖcompletes" type="checkbox"
                                            v-model="mayor.registro.cierre" name="debe" class="custom-checkbox">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-if="!mayor.registro.edit" class="row justify-content-center">
                            <a href="#" class="btn btn-success" @click.prevent="agregarCelda()">Agregar</a>
                        </div>
                        <div v-else class="row justify-content-center">
                            <a href="#" class="btn btn-success" @click.prevent="updateDebe()">Actualizar</a>
                            <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEdicion('debe')"><i
                                    class="fa fa-window-close"></i></a>
                        </div>
                    </div>
                    @if($datos->metodo == 'individual')
                    <div class="col-6"
                        style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                        {!! $transacciones->transacciones !!}
                    </div>
                    @elseif($datos->metodo == 'concatenado')
                    <div class="col-6" style="border: double 8px #E71822;">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="diario-mayor-tab" data-toggle="tab" href="#diario-mayor"
                                    role="tab" aria-controls="diario-mayor" aria-selected="true">DIARIO GENERAL</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="mayor-recargar-tab" data-toggle="tab" href="#mayor-recargar"
                                    role="tab" aria-controls="mayor-recargar" aria-selected="false">MAYOR GENERAL</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="diario-mayor" role="tabpanel"
                                aria-labelledby="diario-mayor-tab"
                                style=" height:300px; overflow-y: scroll; overflow-x: hidden;">
                                <h3 class="text-center font-weight-bold">Datos para realizar el Mayor General</h3>
                                <h3 class="text-center">Diario General</h3>
                                <table class="table table-bordered table-sm">
                                    <thead class="thead-dark">
                                        <tr align="center">
                                            <th scope="col" width="200">FECHA</th>
                                            <th scope="col" width="450">NOMBRE DE CUENTAS</th>
                                            <th scope="col " width="125">DEBE</th>
                                            <th scope="col">HABER</th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="(registro, id) in dgeneral">
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
                                </table>
                                <div v-if="ajustes.length > 0">
                                    <h2 class="font-weight-bold text-center">Asientos de ajustes </h2>
                                    <table class="table table-bordered table-sm">
                                        <tbody v-for="(registro, id) in ajustes">
                                            <tr v-for="(diar, index) in registro.debe">
                                                <td align="center" width="200">@{{ formatoFecha(diar.fecha)}}</td>
                                                <td align="rigth" width="450">@{{ diar.nom_cuenta}}</td>
                                                <td align="center" width="125">@{{ decimales(diar.saldo) }}</td>
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
                                    </table>
                                </div>
                                <div v-if="registros_cierres.length > 0">
                                    <h1 class="text-center text-danger font-weight-bold mt-2">ASIENTOS DE CIERRE</h1>
                                    <div class="row justify-content-center">
                                        <div class="col-3">
                                            <h4 class="text-center font-weight-bold">@{{ nombre_cierre }}</h4>
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
                                                <tbody v-for="(registro, id) in registros_cierres">
                                                    <tr v-for="(diar, index) in registro.debe">
                                                        <td align="center" width="50">@{{ formatoFecha(diar.fecha)}}
                                                        </td>
                                                        <td align="rigth">@{{ diar.nom_cuenta}}</td>
                                                        <td class="text-right" width="125">@{{ decimales(diar.saldo) }}
                                                        </td>
                                                        <td class="text-right" width="125"></td>
                                                    </tr>
                                                    <tr v-for="(diar, index) in registro.haber">
                                                        <td align="center" width="50"></td>
                                                        <td style="padding-left:50px">@{{ diar.nom_cuenta}}</td>
                                                        <td class="text-right" width="125"></td>
                                                        <td class="text-right" width="125">@{{ decimales(diar.saldo) }}
                                                        </td>
                                                    </tr>
                                                    <tr class="text-muted">
                                                        <td></td>
                                                        <td>@{{ registro.comentario }}</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="mayor-recargar" role="tabpanel"
                                aria-labelledby="mayor-recargar-tab"
                                style=" height:300px; overflow-y: scroll; overflow-x: hidden;">
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
                                                    <td class="text-right font-weight-bold text-gray-dark">
                                                        @{{ decimales(cuenta.total_debe )}}</td>
                                                    <td class="text-right font-weight-bold text-gray-dark">
                                                        @{{ decimales(cuenta.total_haber) }}</td>
                                                    <td class="text-right font-weight-bold text-gray-dark">
                                                        @{{ cuenta.total_saldo }}
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
                            </div>

                        </div>

                    </div>
                    @endif
                    <div class="col-12 mt-2" v-if="mayores.registros.length > 0 || mayores.cierres.length > 0">
                        <h2 class="text-center">ACTUALIZAR REGISTROS</h2>
                        <div class="row justify-content-end mb-2">
                            <a v-if="update" href="#" class="addDiario btn btn-success"
                                @click.prevent="updaterRegister()">Actualizar Transaccion</a>
                            <a v-if="!update" href="#" class="addDiario btn btn-success"
                                @click.prevent="guardarRegistro()">Agregar Transaccion</a>
                        </div>
                        <div style=" height:300px; overflow-y: scroll; overflow-x: hidden;">
                            <table class="table table-bordered table-sm">
                                <thead class="thead-dark">
                                    <tr align="center">
                                        <th scope="col" width="200">FECHA</th>
                                        <th scope="col" width="450">DETALLE</th>
                                        <th scope="col " width="125">DEBE</th>
                                        <th scope="col" width="125">HABER</th>
                                        <th scope="col" width="125">SALDO</th>
                                        <th width="50" v-if="mayores.registros.length > 0 ">ACCION</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-light" is="draggable" group="people" :list="mayores.registros"
                                    tag="tbody">
                                    <tr v-for="(diar, index) in mayores.registros">
                                        <td align="center" width="50"><input autocomplete="ÑÖcompletes"
                                                class=" form-control-plaintext text-right" type="date"
                                                v-model="diar.fecha">
                                        </td>
                                        <td align="center" width="200"><input autocomplete="ÑÖcompletes"
                                                class=" form-control-plaintext text-left" type="text"
                                                v-model="diar.detalle"></td>
                                        <td class="text-right"><input autocomplete="ÑÖcompletes"
                                                class=" form-control-plaintext text-right" type="number"
                                                v-model="diar.debe"></td>
                                        <td class="text-right"><input autocomplete="ÑÖcompletes"
                                                class=" form-control-plaintext text-right" type="number"
                                                v-model="diar.haber"></td>
                                        <td class="text-right" width="125"><input autocomplete="ÑÖcompletes"
                                                class="form-control-plaintext text-right" type="number"
                                                v-model="diar.saldo"></td>
                                        {{--   <td align="center">
                                            <a @click="habediarioEdit(index)" class="btn btn-warning btn-sm"><i class="fas fas fa-edit"></i>
                                            </a>
                                        </td> --}}
                                        <td align="center" width="25"><a @click="deleteNormal(index)"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>
                                </tbody>
                                <tbody is="draggable" group="cierres" :list="mayores.cierres" tag="tbody">
                                    <tr v-for="(diar, index) in mayores.cierres">
                                        <td align="center" width="50"><input autocomplete="ÑÖcompletes"
                                                class=" form-control-plaintext text-right" type="date"
                                                v-model="diar.fecha">
                                        </td>
                                        <td align="center" width="200"><input autocomplete="ÑÖcompletes"
                                                class=" form-control-plaintext text-left" type="text"
                                                v-model="diar.detalle"></td>
                                        <td class="text-right"><input autocomplete="ÑÖcompletes"
                                                class=" form-control-plaintext text-right" type="number"
                                                v-model="diar.debe"></td>
                                        <td class="text-right"><input autocomplete="ÑÖcompletes"
                                                class=" form-control-plaintext text-right" type="number"
                                                v-model="diar.haber"></td>
                                        <td class="text-right" width="125"><input autocomplete="ÑÖcompletes"
                                                class="form-control-plaintext text-right" type="number"
                                                v-model="diar.saldo"></td>
                                        {{--   <td align="center">
                                            <a @click="habediarioEdit(index)" class="btn btn-warning btn-sm"><i class="fas fas fa-edit"></i>
                                            </a>
                                        </td> --}}
                                        <td align="center" width="25"><a @click="deleteCierre(index)"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-around mb-2">
                            <a v-if="update" href="#" class="addDiario btn btn-success"
                                @click.prevent="updaterRegister()">Actualizar Transaccion</a>
                            <a v-if="!update" href="#" class="addDiario btn btn-success"
                                @click.prevent="guardarRegistro()">Agregar Transaccion</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="eliminar-mg" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="eliminar-mgLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminar-mgLabel">Eliminar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Deseas eliminar el registro de @{{ eliminar.nombre }}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" @click="eliminarRegistro()">Eliminar</button>
            </div>
        </div>
    </div>
</div>