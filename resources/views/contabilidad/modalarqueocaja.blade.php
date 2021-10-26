<div class="modal fade" data-backdrop="static" data-keyboard="false" id="arqueo-caja" tabindex="-1" role="dialog"
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

            <div class="modal-body">
                <a class="btn btn-dark mb-2" href="" @click.prevent="calculadora()">CALCULADORA</a>

                <div class="row justify-content-center">
                    <div class="col-6 border border-bottom-0 border-left-0 border-top-0 border-danger">

                        <ul class="nav nav-tabs" id="arqueoCaja" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active  text-dark font-weight-bold" id="ht-dato-saldo-tab"
                                    data-toggle="tab" href="#ht-dato-saldo" role="tab" aria-controls="ht-dato-saldo"
                                    aria-selected="true">SALDO</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  text-dark font-weight-bold" id="ht-dato-exis-tab" data-toggle="tab"
                                    href="#ht-dato-exis" role="tab" aria-controls="ht-dato-exis"
                                    aria-selected="false">EXISTENCIAS</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="dato">
                            {{--SALDO --}}
                            <div class="tab-pane fade show active" id="ht-dato-saldo" role="tabpanel"
                                aria-labelledby="ht-dato-saldo-tab">

                                <h2 class="text-center">AGREGAR SALDO</h2>
                                <table class="table table-bordered table-sm">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th align="center" class="text-center">Detalle</th>
                                            <th align="center" class="text-center">Debe</th>
                                            <th align="center" class="text-center">Haber</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" v-model="saldo.detalle" name="detalle"
                                                    class="form-control" required></td>
                                            <td width="125"><input type="number" v-model="saldo.s_debe" name="s_debe"
                                                    class="form-control" required></td>
                                            <td width="125"><input type="number" v-model="saldo.s_haber" name="s_haber"
                                                    class="form-control" required></td>

                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <div v-if="!saldo.edit" class="row justify-content-center">
                                    <a href="#" class="btn btn-success" @click.prevent="agregarsaldo()">Agregar</a>

                                </div>
                                <div v-else class="row justify-content-center">
                                    <a href="#" class="btn btn-success"
                                        @click.prevent="actualizarSaldo()">Actualizar</a>
                                    <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEditSaldo()"><i
                                            class="fa fa-window-close"></i></a>

                                </div>
                            </div>

                            {{--EXISTENCIAS --}}
                            <div class="tab-pane fade" id="ht-dato-exis" role="tabpanel"
                                aria-labelledby="ht-dato-exis-tab">

                                <h2 class="text-center">AGREGAR EXISTENCIAS</h2>

                                <table class="table table-bordered table-sm">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th align="center" class="text-center">Detalle</th>
                                            <th align="center" class="text-center">Debe</th>
                                            <th align="center" class="text-center">Haber</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" v-model="exis.detalle" name="detalle"
                                                    class="form-control" required></td>
                                            <td width="125"><input type="number" v-model="exis.e_debe" name="e_debe"
                                                    class="form-control" required></td>
                                            <td width="125"><input type="number" v-model="exis.e_haber" name="e_haber"
                                                    class="form-control" required></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <br>
                                <div v-if="!exis.edit" class="row justify-content-center">
                                    <a href="#" class="btn btn-success" @click.prevent="agregarExistencia()">Agregar</a>

                                </div>
                                <div v-else class="row justify-content-center">
                                    <a href="#" class="btn btn-success" @click.prevent="actualizarExis()">Actualizar</a>
                                    <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEditExis()"><i
                                            class="fa fa-window-close"></i></a>

                                </div>

                            </div>
                        </div>
                    </div>
                    @if($datos->metodo == 'individual')

                    <div class="col-6" style=" height:300px; overflow-y: scroll; overflow-x: hidden;">
                        {!! $transacciones->transacciones !!}
                    </div>
                    @elseif($datos->metodo == 'concatenado')

                    <div class="col-6 mt-2 ">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-arqueo-caja-tab" data-toggle="tab"
                                    href="#nav-arqueo-caja" role="tab" aria-controls="nav-arqueo-caja"
                                    aria-selected="true">ENUNCIADOS</a>
                                <a class="nav-link" id="nav-libro-caja-tab" data-toggle="tab" href="#nav-libro-caja"
                                    role="tab" aria-controls="nav-libro-caja" aria-selected="false">LIBRO CAJA</a>

                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-arqueo-caja" role="tabpanel"
                                aria-labelledby="nav-arqueo-caja-tab"
                                style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                                @isset ($arqueocaja->transacciones)
                                {!! $arqueocaja->transacciones !!}
                                @endisset
                            </div>
                            <div class="tab-pane fade" id="nav-libro-caja" role="tabpanel"
                                aria-labelledby="nav-libro-caja-tab"
                                style=" height:300px; overflow-y: scroll; border: double 8px #E71822;  overflow-x: hidden;">
                                <h3 class="text-center font-weight-bold">Datos para realizar el Arqueo de Caja</h3>

                                <h2 class="text-center display-4 font-weight-bold text-danger">Libro Caja</h2>

                                <div class="row p-3  mb-2 justify-content-center ">
                                    <div class="col-5 mb-3">
                                        <h3 class="text-center font-weight-bold">
                                            @{{ nombre_lb }}</h3>
                                    </div>
                                </div>
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr class="text-center bg-dark">
                                            <th width="125">Fecha</th>
                                            <th width="300">Detalle</th>
                                            <th width="100">Debe</th>
                                            <th width="100">Haber</th>
                                            <th width="100">Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(caja, index) in libros_caja">
                                            <td align="left">@{{formatoFecha(caja.fecha)}}</td>
                                            <td align="left">@{{caja.detalle}}</td>
                                            <td align="right">@{{decimales( caja.debe)}}</td>
                                            <td align="right">@{{decimales(caja.haber)}}</td>
                                            <td align="right">@{{decimales(caja.saldo)}}</td>
                                        </tr>
                                        <tr class="bg-secondary">
                                            <td class="text-left font-weight-bold">TOTALES</td>
                                            <td class="text-left font-weight-bold"></td>
                                            <td class="text-right font-weight-bold">@{{ debe_lb }}</td>
                                            <td class="text-right font-weight-bold">@{{ haber_lb }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    <br>
                </div>
                <div class="col-12 mt-2" v-if="t_saldo.length > 0 || t_exis.length > 0"
                    style=" height:400px; overflow-y: scroll; overflow-x: hidden;">
                    <h2 class="text-center">ACTUALIZAR REGISTROS</h2>

                    <table style="border: hidden" class="table table-bordered table-sm mb-2">
                        <thead>
                            <tr style="border: hidden" class="text-center bg-dark">
                                <th style="border: hidden; color:red" width="500"></th>
                                <th style="border: hidden" align="right"><em>
                                        <h5>Debe</h5>
                                    </em></th>
                                <th style="border: hidden" align="right"><em>
                                        <h5>Haber</h5>
                                    </em></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody group="people" :list="t_saldo" tag="tbody" style="border: hidden">
                            <tr style="border: hidden" v-for="(s, index) in t_saldo">
                                <td style="border: hidden;">@{{s.detalle}}</td>
                                <td style="border: hidden" align="right">@{{decimales(s.s_debe)}}</td>
                                <td style="border: hidden"  align="right">@{{decimales(s.s_haber)}}</td>
                                <td style="border: hidden" align="center" width="50">
                                    <a @click.prevent="editSaldo(index)" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td style="border: hidden" align="center" width="50">
                                    <a @click.prevent="WarningEliminarSaldo(index)" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>

                            </tr>
                        </tbody>
                        <td style="border: hidden"><em>Existencia física al momento del arqueo:</em></td>
                        <td style="border: hidden"></td>
                        <td style="border: hidden"></td>
                        <td style="border: hidden"></td>
                        <td style="border: hidden"></td>

                        <tbody is="draggable" group="people" :list="t_exis" tag="tbody">
                            <tr style="border: hidden" v-for="(e, index) in t_exis">
                                <td style="padding-left:50px">@{{e.detalle}}</td>
                                <td style="border: hidden"  align="right">@{{decimales(e.e_debe)}}</td>
                                <td style="border: hidden"  align="right">@{{decimales(e.e_haber)}}</td>

                                <td style="border: hidden" align="center" width="50">
                                    <a @click.prevent="editExis(index)" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td style="border: hidden" align="center" width="50">
                                    <a @click.prevent="WarningEliminarExis(index)" class="btn btn-danger">
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