<div class="modal fade" data-backdrop="static" data-keyboard="false" id="libro-banco" tabindex="-1" role="dialog"
    aria-labelledby="bc-transaccionLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl " role="document">
        <div class="modal-content bg-light">

            <div class="modal-header">
                <div v-if="update">
                    <h5 class="modal-title" id="bg-transaccionLabel">ACTUALIZAR TRANSACCION</h5>
                </div>
                <div v-else="!update">
                    <h5 class="modal-title" id="bg-transaccionLabel">AGREGAR TRANSACCION</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 700px; overflow-y: scroll;  width: 100%;">
                <a class="btn btn-dark mb-2" href="" @click.prevent="calculadora()">CALCULADORA</a>

                <div class="row justify-content-center">
                    <div class="col-6 border border-bottom-0 border-left-0 border-top-0 border-danger">
                        <h2 class="text-center">AGREGAR TRANSACCIÓN</h2>

                        <table class="table table-bordered table-sm mb-2">
                            <thead class="bg-success">
                                <tr>
                                    <th width="50" align="center">fecha</th>
                                    <th width="250" align="center" class="text-center">Detalle</th>
                                    <th width="100" align="center">Ch/</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="date" name="fecha" v-model="banco.fecha"
                                            class="form-control text-center" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" v-model="banco.detalle"
                                            placeholder="Detalle">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" v-model="banco.cheque"
                                            placeholder="ch/">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered table-sm mb-2">
                            <thead class="bg-success">
                                <tr>
                                    <th width="50" align="center">Debe</th>
                                    <th width="50" align="center" class="text-center">Haber</th>
                                    <th width="50" align="center" class="text-center">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" class="form-control" v-model="banco.debe"
                                            placeholder="Debe">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" v-model="banco.haber"
                                            placeholder="Haber">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" v-model="banco.saldo"
                                            placeholder="Saldo">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-if="!banco.edit" class="row justify-content-center">
                            <a href="#" class="btn btn-success" @click.prevent="agregarBanco()">Agregar</a>

                        </div>
                        <div v-else class="row justify-content-center">
                            <a href="#" class="btn btn-success" @click.prevent="actualizarLibroBanco()">Actualizar</a>
                            <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEditlibroBanco()"><i
                                    class="fa fa-window-close"></i></a>
                        </div>
                    </div>
                    @if($datos->metodo == 'individual')

                    <div class="col-6" style=" height:300px; overflow-y: scroll; overflow-x: hidden;">
                        {!! $transacciones->transacciones !!}
                    </div>
                    @elseif($datos->metodo == 'concatenado')
                    <div class="col-6" style=" height:300px; overflow-y: scroll;">
                        <h3 class="text-center font-weight-bold">Datos para realizar el Libro Banco</h3>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="col-12 mt-2" v-if="lb_banco.length > 0" style=" height:300px; overflow-y: scroll;">
                        <h2 class="text-center">REGISTROS</h2>

                        <table style="border: hidden" class="table table-bordered table-sm mb-2">
                            <thead style="border: hidden">
                                <tr style="border: hidden" class="text-center bg-dark">
                                    <th width="100">Fecha</th>
                                    <th width="300">Detalle</th>
                                    <th width="50"><i>Ch/</i></th>
                                    <th width="90">Debe</th>
                                    <th width="90">Haber</th>
                                    <th width="100">Saldo</th>
                                    <th class="text-center" v-if="lb_banco.length >=1" colspan="2">ACCIONES</th>
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
                                    <td align="center" width="50">
                                        <a @click.prevent="editLibroBanco(index)" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td align="center" width="50">
                                        <a @click.prevent="WarningEliminarLibro(index)" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="eliminar-banco" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="eliminar-bancoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminar-bancoLabel">Eliminar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Deseas eliminar el registro @{{ eliminar.nombre }}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" @click="eliminarCompra()">Eliminar</button>
            </div>
        </div>
    </div>
</div>