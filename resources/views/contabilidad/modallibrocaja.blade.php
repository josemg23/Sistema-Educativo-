<div class="modal fade" data-backdrop="static" data-keyboard="false" id="libro-caja" tabindex="-1" role="dialog"
    aria-labelledby="bc-transaccionLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl " role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <div v-if="update">
                    <h5 class="modal-title" id="bg-transaccionLabel">ACTUALIZAR TRANSACCION</h5>
                </div>
                <div v-else="!update">
                    <h5 class="modal-title" id="bg-transaccionLabel">AGREGAR  TRANSACCION</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"   style="height: 700px; overflow-y: scroll;  width: 100%;">
                <a class="btn btn-dark mb-2" href="" @click.prevent="calculadora()">CALCULADORA</a>

                <div class="row justify-content-center">
                    <div class="col-6 border border-bottom-0 border-left-0 border-top-0 border-danger">
                        <h2 class="text-center">AGREGAR MOVIMIENTO</h2>
                        <table class="table table-bordered table-sm mb-2">
                            <thead class="bg-success">
                                <tr>
                                    <th width="50" align="center">fecha</th>
                                    <th width="250" align="center" class="text-center">Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="date" name="fecha" v-model="caja.fecha"
                                            class="form-control text-center" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" v-model="caja.detalle"
                                            placeholder="Detalle">
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
                                        <input type="number" class="form-control" v-model="caja.debe"
                                            placeholder="Debe">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" v-model="caja.haber"
                                            placeholder="Haber">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" v-model="caja.saldo"
                                            placeholder="Saldo">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div v-if="!caja.edit" class="row justify-content-center">
                            <a href="#" class="btn btn-success" @click.prevent="agregarRegistro()">Agregar</a>

                        </div>
                        <div v-else class="row justify-content-center">
                            <a href="#" class="btn btn-success" @click.prevent="actualizarLibroCaja()">Actualizar</a>
                            <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEditlibro()"><i
                                    class="fa fa-window-close"></i></a>
                        </div>
                    </div>
                    @if($datos->metodo == 'individual')

                    <div class="col-6" style=" height:300px; overflow-y: scroll; overflow-x: hidden;">
                        {!! $transacciones->transacciones !!}
                    </div>
                    @elseif($datos->metodo == 'concatenado')
                    <div class="col-6" style=" height:300px; overflow-y: scroll;">
                        <h3 class="text-center font-weight-bold">Datos para realizar el Libro Caja</h3>
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

                        <div v-if="registros_cierres.length > 0" >
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
                    <div class="col-12 mt-2" v-if="libros_caja.length > 0" style=" height:300px; overflow-y: scroll; overflow-x: hidden;">
                        <h2 class="text-center">REGISTROS</h2>

                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr class="text-center bg-dark">
                                    <th width="100">Fecha</th>
                                    <th width="300">Detalle</th>
                                    <th width="100">Debe</th>
                                    <th width="100">Haber</th>
                                    <th width="100">Saldo</th>
                                    <th class="text-center" v-if="libros_caja.length >=1" colspan="2">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody is="draggable" group="people" :list="libros_caja" tag="tbody">
                                <tr v-for="(caja, index) in libros_caja">
                                    <td align="left">@{{formatoFecha(caja.fecha)}}</td>
                                    <td align="left">@{{caja.detalle}}</td>
                                    <td align="right">@{{decimales( caja.debe)}}</td>
                                    <td align="right">@{{decimales(caja.haber)}}</td>
                                    <td align="right">@{{decimales(caja.saldo)}}</td>
                                   
                                    <td align="center" width="50">
                                        <a @click.prevent="editLibroCaja(index)" class="btn btn-warning">
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



<div class="modal fade" id="eliminar-libro" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="eliminar-libroLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminar-libroLabel">Eliminar Registro</h5>
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