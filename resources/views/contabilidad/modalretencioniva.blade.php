<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-retencion" tabindex="-1" role="dialog"
    aria-labelledby="bc-transaccionLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl " role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <template v-if="update">
                    <div>
                        <h5 class="modal-title" id="bg-transaccionLabel">ACTUALIZAR TRANSACCION</h5>
                    </div>
                </template>
                <template v-else="!update">
                    <div>
                        <h5 class="modal-title" id="bg-transaccionLabel">AGREGAR REGISTRO DE COMPRAS Y VENTAS</h5>
                    </div>
                </template>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="height: 700px; overflow-y: scroll;  width: 100%;">
                <a class="btn btn-dark mb-2" href="" @click.prevent="calculadora()">CALCULADORA</a>

                <div class="row justify-content-center">
                    <h2 class="text-center font-weight-bold mt-2">Datos para elaborar la Retención del IVA</h2>
                    @if($datos->metodo == 'individual')
                    <div class="col-12"
                        style=" height:200px; overflow-y: scroll; overflow-x: hidden; border: double 4px red;">
                        {!! $transacciones->transacciones !!}
                    </div>
                    @elseif($datos->metodo == 'concatenado')
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="diarioGeneral" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="ht-diario-general-tab" data-toggle="tab"
                                    href="#ht-diario-general" role="tab" aria-controls="ht-diario-general"
                                    aria-selected="true">Diario General</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="ht-enunciado-retencion-tab" data-toggle="tab"
                                    href="#ht-enunciado-retencion" role="tab" aria-controls="ht-enunciado-retencion"
                                    aria-selected="false">Enunciados</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="diario">
                            <div class="tab-pane fade show active" id="ht-diario-general" role="tabpanel"
                                aria-labelledby="ht-diario-general-tab" style=" height:200px; overflow-y: scroll;">
                                <h1 class="text-center text-danger font-weight-bold mt-2">DIARIO GENERAL</h1>

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
                            </div>

                            <div class="tab-pane fade" id="ht-enunciado-retencion" role="tabpanel"
                                aria-labelledby="ht-enunciado-retencion-tab"
                                style=" height:200px; overflow-y: scroll; overflow-x: hidden;">
                                <h1 class="text-center text-danger font-weight-bold mt-2">ENUNCIADOS DEL DIARIO GENERAL
                                </h1>
                                @isset ($diariogeneral->transacciones)
                                {!! $diariogeneral->transacciones !!}
                                @endisset

                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-12 mt-2 border border-bottom-0 border-left-0 border-right-0 border-danger">

                        <br>
                        <h2 class="text-center"> AGREGAR REGISTRO DE COMPRAS Y VENTAS</h2>
                        <div class="col-12">
                            <ul class="nav nav-tabs" id="compra" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="ht-retencion-compra-tab" data-toggle="tab"
                                        href="#ht-retencion-compra" role="tab" aria-controls="ht-retencion-compra"
                                        aria-selected="true">Compras</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="ht-retencion-venta-tab" data-toggle="tab"
                                        href="#ht-retencion-venta" role="tab" aria-controls="ht-retencion-venta"
                                        aria-selected="false">Ventas</a>
                                </li>
                            </ul>


                            <div class="tab-content" id="compraretencion">
                                {{--COMPRAS DE RETENCION --}}
                                <div class="tab-pane fade show active" id="ht-retencion-compra" role="tabpanel"
                                    aria-labelledby="ht-retencion-compra-tab">
                                    <h1 class="text-center text-danger font-weight-bold mt-2">COMPRAS</h1>

                                    <table class="table table-bordered table-sm">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th class="text-center " style="vertical-align: middle;" rowspan="2">
                                                    FECHA</th>
                                                <th class="text-center " style="vertical-align: middle;" rowspan="3">
                                                    COMPRA DE BIENES Y SERVICIOS</th>
                                                <th class="text-center " style="vertical-align: middle;" rowspan="2">
                                                    PROVEEDOR</th>
                                                <th class="text-center" style="vertical-align: middle;" colspan="3">
                                                    RETENCIÓN EN LA FUENTE</th>
                                                <th class="text-center " style="vertical-align: middle;" rowspan="2">IVA
                                                </th>
                                                <th class="text-center" style="vertical-align: middle;" colspan="5">
                                                    RETENCIÓN DEL IVA</th>

                                            </tr>
                                            <tr>
                                                <td class="text-center" width="100">BASE IMPONIBLE</td>
                                                <td class="text-center" width="100">%</td>
                                                <td class="text-center" width="100">VALOR RETENIDO</td>
                                                <td class="text-center" width="100">10%</td>
                                                <td class="text-center" width="100">20%</td>
                                                <td class="text-center" width="100">30%</td>
                                                <td class="text-center" width="100">70%</td>
                                                <td class="text-center" width="100">100%</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td class="text-right" align="center" width="100"><input
                                                        v-model="compra.fecha_c" type="date"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="300"><input
                                                        v-model="compra.detalle" type="text"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="100"><input
                                                        v-model="compra.proveedor" type="text"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="125"><input
                                                        v-model="compra.base_im" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="50"><input
                                                        v-model="compra.porcentaje" type="text"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="compra.v_retenido" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="compra.iva" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="compra.ret_10" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="compra.ret_20" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="compra.ret_30" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="compra.ret_70" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="compra.ret_100" type="number"
                                                        class="form-control form-control-sm"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div v-if="!compra.edit" class="row justify-content-center">
                                        <a href="#" class="btn btn-success" @click.prevent="agregarCompra()">Agregar Registros de Compra</a>

                                    </div>
                                    <div v-else class="row justify-content-center">
                                        <a href="#" class="btn btn-success"
                                            @click.prevent="actualizarCompra()">Actualizar Compra</a>
                                        <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEditCompra()"><i
                                                class="fa fa-window-close"></i></a>
                                    </div>

                                    <div class="col-12 mt-2" v-if="t_compras.length > 0"  style=" height:200px; overflow-y: scroll;">
                                        <h2 class="text-center">REGISTRO DE COMPRAS</h2>

                                        <table class="table table-bordered table-sm">
                                            <thead class="bg-dark">
                                                <tr>
                                                    <th class="text-center " style="vertical-align: middle;"
                                                        rowspan="2">
                                                        FECHA</th>
                                                    <th class="text-center " style="vertical-align: middle;"
                                                        rowspan="3">
                                                        COMPRA DE BIENES Y SERVICIOS</th>
                                                    <th class="text-center " style="vertical-align: middle;"
                                                        rowspan="2">
                                                        PROVEEDOR</th>
                                                    <th class="text-center" style="vertical-align: middle;" colspan="3">
                                                        RETENCIÓN EN LA FUENTE</th>
                                                    <th class="text-center " style="vertical-align: middle;"
                                                        rowspan="2">IVA
                                                    </th>
                                                    <th class="text-center" style="vertical-align: middle;" colspan="5">
                                                        RETENCIÓN DEL IVA</th>
                                                    <th class="text-center" valign="center" v-if="t_compras.length >=1"
                                                        colspan="2" rowspan="2">ACCIONES
                                                    </th>

                                                </tr>
                                                <tr>
                                                    <td class="text-center" width="125">BASE IMPONIBLE</td>
                                                    <td class="text-center" width="125">%</td>
                                                    <td class="text-center" width="125">VALOR RETENIDO</td>
                                                    <td class="text-center" width="125">10%</td>
                                                    <td class="text-center" width="125">20%</td>
                                                    <td class="text-center" width="125">30%</td>
                                                    <td class="text-center" width="125">70%</td>
                                                    <td class="text-center" width="125">100%</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(c , index) in t_compras">
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ formatoFecha(c.fecha_c)}}</td>
                                                    <td class="text-left" align="center" width="300">
                                                        @{{ c.detalle}}
                                                    </td>
                                                    <td class="text-left" align="center" width="100">
                                                        @{{ c.proveedor}}
                                                    </td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(c.base_im) }}</td>
                                                    <td class="text-right" align="center" width="100">
                                                        @{{ c.porcentaje }}
                                                    </td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(c.v_retenido) }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(c.iva) }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(c.ret_10) }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(c.ret_20) }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(c.ret_30) }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(c.ret_70) }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(c.ret_100) }}</td>
                                                    <td align="center" width="50"><a @click.prevent="editCompra(index)"
                                                            class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                    </td>
                                                    <td align="center" width="50"><a
                                                            @click.prevent="WarningEliminarCompra(index)"
                                                            class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                {{--VENTAS DE RETENCION --}}
                                <div class="tab-pane fade" id="ht-retencion-venta" role="tabpanel"
                                    aria-labelledby="ht-retencion-venta-tab">
                                    <h1 class="text-center text-danger font-weight-bold mt-2">VENTAS</h1>

                                    <table class="table table-bordered table-sm">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th class="text-center " style="vertical-align: middle;" rowspan="2">
                                                    FECHA</th>
                                                <th class="text-center " style="vertical-align: middle;" rowspan="3">
                                                    VENTA DE BIENES Y SERVICIOS</th>
                                                <th class="text-center " style="vertical-align: middle;" rowspan="2">
                                                    CLIENTE</th>
                                                <th class="text-center" style="vertical-align: middle;" colspan="3">
                                                    RETENCIÓN EN LA FUENTE</th>
                                                <th class="text-center " style="vertical-align: middle;" rowspan="2">IVA
                                                </th>
                                                <th class="text-center" style="vertical-align: middle;" colspan="5">
                                                    RETENCIÓN DEL IVA</th>

                                            </tr>
                                            <tr>
                                                <td class="text-center" width="100">BASE IMPONIBLE</td>
                                                <td class="text-center" width="100">%</td>
                                                <td class="text-center" width="100">VALOR RETENIDO</td>
                                                <td class="text-center" width="100">10%</td>
                                                <td class="text-center" width="100">20%</td>
                                                <td class="text-center" width="100">30%</td>
                                                <td class="text-center" width="100">70%</td>
                                                <td class="text-center" width="100">100%</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td class="text-right" align="center" width="100"><input
                                                        v-model="venta.fecha_v" type="date"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="300"><input
                                                        v-model="venta.detalle" type="text"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="100"><input
                                                        v-model="venta.cliente" type="text"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="125"><input
                                                        v-model="venta.base_im" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="50"><input
                                                        v-model="venta.porcentaje" type="text"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="venta.v_retenido" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="venta.iva" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="venta.ret_10" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="venta.ret_20" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="venta.ret_30" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="venta.ret_70" type="number"
                                                        class="form-control form-control-sm"></td>
                                                <td class="text-right" align="center" width="150"><input
                                                        v-model="venta.ret_100" type="number"
                                                        class="form-control form-control-sm"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div v-if="!venta.edit" class="row justify-content-center">
                                        <a href="#" class="btn btn-success" @click.prevent="agregarVenta()">Agregar Registros de Venta</a>

                                    </div>
                                    <div v-else class="row justify-content-center">
                                        <a href="#" class="btn btn-success"
                                            @click.prevent="actualizarVenta()">Actualizar Venta</a>
                                        <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEditVenta()"><i
                                                class="fa fa-window-close"></i></a>
                                    </div>
                                    <br>
                                    <div class="col-12 mt-2" v-if="t_ventas.length > 0"
                                        style=" height:200px; overflow-y: scroll;">
                                        <h2 class="text-center">REGISTRO DE VENTAS</h2>

                                        <table class="table table-bordered table-sm">
                                            <thead class="bg-dark">
                                                <tr>
                                                    <th class="text-center " style="vertical-align: middle;"
                                                        rowspan="2">
                                                        FECHA</th>
                                                    <th class="text-center " style="vertical-align: middle;"
                                                        rowspan="3">
                                                        VENTA DE BIENES Y SERVICIOS</th>
                                                    <th class="text-center " style="vertical-align: middle;"
                                                        rowspan="2">
                                                        CLIENTE</th>
                                                    <th class="text-center" style="vertical-align: middle;" colspan="3">
                                                        RETENCIÓN EN LA FUENTE</th>
                                                    <th class="text-center " style="vertical-align: middle;"
                                                        rowspan="2">IVA
                                                    </th>
                                                    <th class="text-center" style="vertical-align: middle;" colspan="5">
                                                        RETENCIÓN DEL IVA</th>
                                                    <th class="text-center" valign="center" v-if="t_ventas.length >=1"
                                                        colspan="2" rowspan="2">ACCIONES
                                                    </th>

                                                </tr>
                                                <tr>
                                                    <td class="text-center" width="125">BASE IMPONIBLE</td>
                                                    <td class="text-center" width="125">%</td>
                                                    <td class="text-center" width="125">VALOR RETENIDO</td>
                                                    <td class="text-center" width="125">10%</td>
                                                    <td class="text-center" width="125">20%</td>
                                                    <td class="text-center" width="125">30%</td>
                                                    <td class="text-center" width="125">70%</td>
                                                    <td class="text-center" width="125">100%</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(v , index) in t_ventas">
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ formatoFecha(v.fecha_v)}}</td>
                                                    <td class="text-left" align="center" width="300">@{{ v.detalle}}
                                                    </td>
                                                    <td class="text-left" align="center" width="100">@{{ v.cliente}}
                                                    </td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(v.base_im) }}</td>
                                                    <td class="text-right" align="center" width="100">
                                                        @{{ v.porcentaje }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(v.v_retenido) }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(v.iva) }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(v.ret_10) }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(v.ret_20) }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(v.ret_30) }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(v.ret_70) }}</td>
                                                    <td class="text-right" align="center" width="125">
                                                        @{{ decimales(v.ret_100) }}</td>
                                                    <td align="center" width="50"><a @click.prevent="editVenta(index)"
                                                            class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                                                    <td align="center" width="50"><a
                                                            @click.prevent="WarningEliminarVenta(index)"
                                                            class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
            </div>
        </div>
    </div>
</div>



{{--Compras eliminar--}}

<div class="modal fade" id="eliminar-retencion" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="eliminar-retencionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminar-retencionLabel">Eliminar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Deseas eliminar el registro de @{{ eliminar.nombre }}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" @click="eliminarCompra()">Eliminar</button>
            </div>
        </div>
    </div>
</div>
{{--Ventas eliminar--}}

<div class="modal fade" id="eliminar-retencion1" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="eliminar-retencion1Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminar-retencion1Label">Eliminar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Deseas eliminar el registro de @{{ eliminar.nombre }}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" @click="eliminarCompra()">Eliminar</button>
            </div>
        </div>
    </div>
</div>