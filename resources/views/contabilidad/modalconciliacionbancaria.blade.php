<div class="modal fade" data-backdrop="static" data-keyboard="false" id="conciliacion-bancaria" tabindex="-1"
    role="dialog" aria-labelledby="bg-transaccionLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl " role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <div v-if="update">
                    <h5 class="modal-title" id="er-ingresoLabel">ACTUALIZAR CUENTAS</h5>
                </div>
                <div v-else="!update">
                    <h5 class="modal-title" id="ba-transaccionLabel">AGREGAR TRANSACCIONES</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 700px; overflow-y: scroll;  width: 100%;">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <nav>
                            <div style="font-size: 15px" class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-bih-conciliacion-saldo-tab" data-toggle="tab"
                                    href="#nav-bih-conciliacion-saldo" role="tab"
                                    aria-controls="nav-bih-conciliacion-saldo" aria-selected="true">SALDOS</a>

                                <a class="nav-link" id="nav-bih-conciliacion-debito-tab" data-toggle="tab"
                                    href="#nav-bih-conciliacion-debito" role="tab"
                                    aria-controls="nav-bih-conciliacion-debito" aria-selected="false">DÉBITOS</a>

                                <a class="nav-link" id="nav-bih-conciliacion-deposito-tab" data-toggle="tab"
                                    href="#nav-bih-conciliacion-deposito" role="tab"
                                    aria-controls="nav-bih-conciliacion-deposito" aria-selected="false">DEPÓSITOS</a>

                                <a class="nav-link" id="nav-bih-conciliacion-credito-tab" data-toggle="tab"
                                    href="#nav-bih-conciliacion-credito" role="tab"
                                    aria-controls="nav-bih-conciliacion-credito" aria-selected="false">CRÉDITOS</a>

                                <a class="nav-link" id="nav-bih-conciliacion-cheque-tab" data-toggle="tab"
                                    href="#nav-bih-conciliacion-cheque" role="tab"
                                    aria-controls="nav-bih-conciliacion-cheque" aria-selected="false">CHEQUES</a>
                                <a class="nav-link bg-dark mb-2" href="" @click.prevent="calculadora()">CALCULADORA</a>

                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            <!-- saldos -->
                            <div class="tab-pane fade show active" id="nav-bih-conciliacion-saldo" role="tabpanel"
                                aria-labelledby="nav-bih-conciliacion-saldo-tab">

                                <div class="row">
                                    <div class="col-6">
                                        <h2 class="text-center">AGREGAR SALDO</h2>
                                        <table class="table table-bordered table-sm">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th align="center" class="text-center" width="50">Fecha</th>
                                                    <th align="center" class="text-center">Detalle</th>
                                                    <th align="center" class="text-center">Valor</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="date" v-model="saldo.fecha"
                                                            placeholder="Agrega la fecha" name="">
                                                    </td>

                                                    <td><input type="text" v-model="saldo.detalle" name="detalle"
                                                            class="form-control" required></td>
                                                    <td width="125"><input type="number" v-model="saldo.saldo"
                                                            name="saldo" class="form-control" required></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div v-if="!saldo.edit" class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="agregarSaldo()">Agregar</a>
                                        </div>
                                        <div v-else class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="actualizarSaldo()">Actualizar</a>
                                            <a href="#" class="btn btn-danger ml-1"
                                                @click.prevent="cancelarEditSaldo()"><i
                                                    class="fa fa-window-close"></i></a>
                                        </div>


                                    </div>
                                    <!-- fin del div col-6 -->
                                    @if($datos->metodo == 'individual')
                                    <div class="col-6"
                                        style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 4px red;">
                                        {!! $transacciones->transacciones !!}
                                    </div>
                                    @elseif($datos->metodo == 'concatenado')
                                    <div class="col-6 mt-2 ">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-link active" id="nav-conciliacion-tab" data-toggle="tab"
                                                    href="#nav-conciliacion" role="tab" aria-controls="nav-conciliacion"
                                                    aria-selected="true">ENUNCIADOS</a>
                                                <a class="nav-link" id="nav-libro-banco-tab" data-toggle="tab"
                                                    href="#nav-libro-banco" role="tab" aria-controls="nav-libro-banco"
                                                    aria-selected="false">LIBRO BANCO</a>

                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-conciliacion" role="tabpanel"
                                                aria-labelledby="nav-conciliacion-tab"
                                                style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                                                @isset ($conciliacionbancaria->transacciones)
                                                {!! $conciliacionbancaria->transacciones !!}
                                                @endisset
                                            </div>
                                            <div class="tab-pane fade" id="nav-libro-banco" role="tabpanel"
                                                aria-labelledby="nav-libro-banco-tab"
                                                style=" height:300px; overflow-y: scroll; border: double 8px #E71822;  overflow-x: hidden;">
                                                <h2 class="text-center  font-weight-bold text-danger">Anexos de Control
                                                    Interno</h2>
                                                <h3 class="text-center font-weight-bold text-danger">Libro Banco</h3>
                                                <div class="row p-3  mb-2 justify-content-center ">
                                                    <div class="col-5">
                                                        <h5 class="font-weight-bold">@{{ lb_nombre }}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="font-weight-bold">@{{ lb_n_banco }}</h5>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="font-weight-bold">@{{ lb_c_banco }}</h5>
                                                    </div>
                                                </div>
                                                <br>
                                                <table style="border: hidden"
                                                    class="table table-bordered table-sm mb-2">
                                                    <thead style="border: hidden">
                                                        <tr style="border: hidden" class="text-center bg-dark">
                                                            <th width="100">Fecha</th>
                                                            <th width="300">Detalle</th>
                                                            <th width="50"><i>Ch/</i></th>
                                                            <th width="90">Debe</th>
                                                            <th width="90">Haber</th>
                                                            <th width="100">Saldo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="border: hidden">
                                                        <tr style="border: hidden" v-for="(banco, index) in lb_banco">
                                                            <td align="left">@{{formatoFecha(banco.fecha)}}</td>
                                                            <td align="left">@{{banco.detalle}}</td>
                                                            <td align="left">@{{banco.cheque}}</td>
                                                            <td align="right">@{{decimales(banco.debe)}}</td>
                                                            <td align="right">@{{decimales(banco.haber)}}</td>
                                                            <td align="right">@{{decimales(banco.saldo)}}</td>
                                                        </tr>
                                                        <tr style="border: hidden" class="bg-secondary">
                                                            <td class="text-center font-weight-bold">SUMAN</td>
                                                            <td class="text-left font-weight-bold"></td>
                                                            <td class="text-left font-weight-bold"></td>
                                                            <td class="text-right font-weight-bold">@{{ debe_lbanco }}
                                                            </td>
                                                            <td class="text-right font-weight-bold">@{{ haber_lbanco }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    @endif
                                    <!-- fin del div col-6 mt-2-->
                                    <div class="col-12 mt-2 p-2" style=" height:300px; overflow-y: scroll;">
                                        <h2 class="text-center">SALDO</h2>
                                        <div class="row justify-content-around mb-2">
                                            <table class="table table-bordered table-sm mb-2 p-2">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th align="center" class="text-center" width="150">Fecha</th>
                                                        <th align="center" class="text-center">Detalle</th>
                                                        <th align="center" class="text-center">Valor</th>

                                                    </tr>
                                                </thead>
                                                <tbody is="draggable" group="people" :list="c_saldos" tag="tbody">
                                                    <tr v-for="(s, index) in c_saldos">
                                                        <td align="left">@{{formatoFecha(s.fecha)}}</td>
                                                        <td align="left">@{{ s.detalle}}</td>
                                                        <td class="text-right">@{{ decimales(s.saldo)}}</td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="editSaldo(index)"
                                                                class="btn btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="EliminarSaldo(index)"
                                                                class="btn btn-danger">
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
                            <!-- end saldos -->
                            <!-- debitos -->
                            <div class="tab-pane fade" id="nav-bih-conciliacion-debito" role="tabpanel"
                                aria-labelledby="nav-bih-conciliacion-debito-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <h2 class="text-center">AGREGAR DÉBITOS</h2>
                                        <table class="table table-bordered table-sm">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th align="center" class="text-center" width="100">Fecha</th>
                                                    <th align="center" class="text-center">Detalle</th>
                                                    <th align="center" class="text-center">Valor</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="date" v-model="debito.fecha"
                                                            placeholder="Agrega la fecha" name="">
                                                    </td>
                                                    <td><input type="text" v-model="debito.detalle" name="detalle"
                                                            class="form-control" required></td>
                                                    <td width="125"><input type="number" v-model="debito.saldo"
                                                            name="saldo" class="form-control" required></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div v-if="!debito.edit" class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="agregarDebitos()">Agregar</a>
                                        </div>
                                        <div v-else class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="actualizarDebito()">Actualizar</a>
                                            <a href="#" class="btn btn-danger ml-1"
                                                @click.prevent="cancelarEditDebito()"><i
                                                    class="fa fa-window-close"></i></a>
                                        </div>
                                    </div>
                                    @if($datos->metodo == 'individual')
                                    <div class="col-6"
                                        style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 4px red;">
                                        {!! $transacciones->transacciones !!}
                                    </div>
                                    @elseif($datos->metodo == 'concatenado')
                                    <div class="col-6 mt-2 ">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-link active" id="nav-conciliacion1-tab" data-toggle="tab"
                                                    href="#nav-conciliacion1" role="tab"
                                                    aria-controls="nav-conciliacion1"
                                                    aria-selected="true">ENUNCIADOS</a>
                                                <a class="nav-link" id="nav-libro-banco1-tab" data-toggle="tab"
                                                    href="#nav-libro-banco1" role="tab" aria-controls="nav-libro-banco1"
                                                    aria-selected="false">LIBRO BANCO</a>

                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-conciliacion1"
                                                role="tabpanel" aria-labelledby="nav-conciliacion1-tab"
                                                style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                                                @isset ($conciliacionbancaria->transacciones)
                                                {!! $conciliacionbancaria->transacciones !!}
                                                @endisset
                                            </div>
                                            <div class="tab-pane fade" id="nav-libro-banco1" role="tabpanel"
                                                aria-labelledby="nav-libro-banco1-tab"
                                                style=" height:300px; overflow-y: scroll; border: double 8px #E71822;  overflow-x: hidden;">
                                                <h2 class="text-center  font-weight-bold text-danger">Anexos de Control
                                                    Interno</h2>
                                                <h3 class="text-center font-weight-bold text-danger">Libro Banco</h3>
                                                <div class="row p-3  mb-2 justify-content-center ">
                                                    <div class="col-5">
                                                        <h5 class="font-weight-bold">@{{ lb_nombre }}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="font-weight-bold">@{{ lb_n_banco }}</h5>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="font-weight-bold">@{{ lb_c_banco }}</h5>
                                                    </div>
                                                </div>
                                                <br>
                                                <table style="border: hidden"
                                                    class="table table-bordered table-sm mb-2">
                                                    <thead style="border: hidden">
                                                        <tr style="border: hidden" class="text-center bg-dark">
                                                            <th width="100">Fecha</th>
                                                            <th width="300">Detalle</th>
                                                            <th width="50"><i>Ch/</i></th>
                                                            <th width="90">Debe</th>
                                                            <th width="90">Haber</th>
                                                            <th width="100">Saldo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="border: hidden">
                                                        <tr style="border: hidden" v-for="(banco, index) in lb_banco">
                                                            <td align="left">@{{formatoFecha(banco.fecha)}}</td>
                                                            <td align="left">@{{banco.detalle}}</td>
                                                            <td align="left">@{{banco.cheque}}</td>
                                                            <td align="right">@{{decimales(banco.debe)}}</td>
                                                            <td align="right">@{{decimales(banco.haber)}}</td>
                                                            <td align="right">@{{decimales(banco.saldo)}}</td>
                                                        </tr>
                                                        <tr style="border: hidden" class="bg-secondary">
                                                            <td class="text-center font-weight-bold">SUMAN</td>
                                                            <td class="text-left font-weight-bold"></td>
                                                            <td class="text-left font-weight-bold"></td>
                                                            <td class="text-right font-weight-bold">@{{ debe_lbanco }}
                                                            </td>
                                                            <td class="text-right font-weight-bold">@{{ haber_lbanco }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    @endif

                                    <div class="col-12 mt-2 p-2" style=" height:300px; overflow-y: scroll;">
                                        <h2 class="text-center">DÉBITOS</h2>
                                        <div class="row justify-content-around mb-2">
                                            <table class="table table-bordered table-sm mb-2 p-2">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th align="center" class="text-center" width="150">Fecha</th>
                                                        <th align="center" class="text-center">Detalle</th>
                                                        <th align="center" class="text-center">Valor</th>

                                                    </tr>
                                                </thead>
                                                <tbody is="draggable" group="people" :list="c_debitos" tag="tbody">
                                                    <tr v-for="(d, index) in c_debitos">
                                                        <td align="left">@{{formatoFecha(d.fecha)}}</td>
                                                        <td align="left">@{{ d.detalle}}</td>
                                                        <td class="text-right">@{{ decimales(d.saldo)}}</td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="editDebito(index)"
                                                                class="btn btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="EliminarDebito(index)"
                                                                class="btn btn-danger">
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
                            <!-- end debitos -->
                            <!-- DEPOSITOS -->

                            <div class="tab-pane fade" id="nav-bih-conciliacion-deposito" role="tabpanel"
                                aria-labelledby="nav-bih-conciliacion-deposito-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <h2 class="text-center">AGREGAR DEPÓSITOS</h2>
                                        <table class="table table-bordered table-sm">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th align="center" class="text-center" width="100">Fecha</th>
                                                    <th align="center" class="text-center">Detalle</th>
                                                    <th align="center" class="text-center">Valor</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="date" v-model="deposito.fecha"
                                                            placeholder="Agrega la fecha" name="">
                                                    </td>
                                                    <td><input type="text" v-model="deposito.detalle" name="detalle"
                                                            class="form-control" required></td>
                                                    <td width="125"><input type="number" v-model="deposito.saldo"
                                                            name="saldo" class="form-control" required></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div v-if="!deposito.edit" class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="agregarDeposito()">Agregar</a>
                                        </div>
                                        <div v-else class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="actualizarDeposito()">Actualizar</a>
                                            <a href="#" class="btn btn-danger ml-1"
                                                @click.prevent="cancelarEditDeposito()"><i
                                                    class="fa fa-window-close"></i></a>
                                        </div>
                                    </div>
                                    @if($datos->metodo == 'individual')
                                    <div class="col-6"
                                        style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 4px red;">
                                        {!! $transacciones->transacciones !!}
                                    </div>
                                    @elseif($datos->metodo == 'concatenado')
                                    <div class="col-6 mt-2 ">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-link active" id="nav-conciliacion4-tab" data-toggle="tab"
                                                    href="#nav-conciliacion4" role="tab"
                                                    aria-controls="nav-conciliacion4"
                                                    aria-selected="true">ENUNCIADOS</a>
                                                <a class="nav-link" id="nav-libro-banco4-tab" data-toggle="tab"
                                                    href="#nav-libro-banco4" role="tab" aria-controls="nav-libro-banco4"
                                                    aria-selected="false">LIBRO BANCO</a>

                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-conciliacion4"
                                                role="tabpanel" aria-labelledby="nav-conciliacion4-tab"
                                                style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                                                @isset ($conciliacionbancaria->transacciones)
                                                {!! $conciliacionbancaria->transacciones !!}
                                                @endisset
                                            </div>
                                            <div class="tab-pane fade" id="nav-libro-banco4" role="tabpanel"
                                                aria-labelledby="nav-libro-banco4-tab"
                                                style=" height:300px; overflow-y: scroll; border: double 8px #E71822;  overflow-x: hidden;">
                                                <h2 class="text-center  font-weight-bold text-danger">Anexos de Control
                                                    Interno</h2>
                                                <h3 class="text-center font-weight-bold text-danger">Libro Banco</h3>
                                                <div class="row p-3  mb-2 justify-content-center ">
                                                    <div class="col-5">
                                                        <h5 class="font-weight-bold">@{{ lb_nombre }}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="font-weight-bold">@{{ lb_n_banco }}</h5>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="font-weight-bold">@{{ lb_c_banco }}</h5>
                                                    </div>
                                                </div>
                                                <br>
                                                <table style="border: hidden"
                                                    class="table table-bordered table-sm mb-2">
                                                    <thead style="border: hidden">
                                                        <tr style="border: hidden" class="text-center bg-dark">
                                                            <th width="100">Fecha</th>
                                                            <th width="300">Detalle</th>
                                                            <th width="50"><i>Ch/</i></th>
                                                            <th width="90">Debe</th>
                                                            <th width="90">Haber</th>
                                                            <th width="100">Saldo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="border: hidden">
                                                        <tr style="border: hidden" v-for="(banco, index) in lb_banco">
                                                            <td align="left">@{{formatoFecha(banco.fecha)}}</td>
                                                            <td align="left">@{{banco.detalle}}</td>
                                                            <td align="left">@{{banco.cheque}}</td>
                                                            <td align="right">@{{decimales(banco.debe)}}</td>
                                                            <td align="right">@{{decimales(banco.haber)}}</td>
                                                            <td align="right">@{{decimales(banco.saldo)}}</td>
                                                        </tr>
                                                        <tr style="border: hidden" class="bg-secondary">
                                                            <td class="text-center font-weight-bold">SUMAN</td>
                                                            <td class="text-left font-weight-bold"></td>
                                                            <td class="text-left font-weight-bold"></td>
                                                            <td class="text-right font-weight-bold">@{{ debe_lbanco }}
                                                            </td>
                                                            <td class="text-right font-weight-bold">@{{ haber_lbanco }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-12 mt-2 p-2" style=" height:300px; overflow-y: scroll;">
                                        <h2 class="text-center">DEPÓSITOS</h2>
                                        <div class="row justify-content-around mb-2">
                                            <table class="table table-bordered table-sm mb-2 p-2">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th align="center" class="text-center" width="150">Fecha</th>
                                                        <th align="center" class="text-center">Detalle</th>
                                                        <th align="center" class="text-center">Valor</th>

                                                    </tr>
                                                </thead>
                                                <tbody is="draggable" group="people" :list="c_depositos" tag="tbody">
                                                    <tr v-for="(d, index) in c_depositos">
                                                        <td align="left">@{{formatoFecha(d.fecha)}}</td>
                                                        <td align="left">@{{ d.detalle}}</td>
                                                        <td class="text-right">@{{ decimales(d.saldo)}}</td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="editDepositos(index)"
                                                                class="btn btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="EliminarDeposito(index)"
                                                                class="btn btn-danger">
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
                            <!-- end DEPOSITOS -->
                            <!-- creditos -->
                            <div class="tab-pane fade " id="nav-bih-conciliacion-credito" role="tabpanel"
                                aria-labelledby="nav-bih-conciliacion-credito-tab">

                                <div class="row">
                                    <div class="col-6">
                                        <h2 class="text-center">AGREGAR CRÉDITO</h2>
                                        <table class="table table-bordered table-sm">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th align="center" class="text-center" width="50">Fecha</th>
                                                    <th align="center" class="text-center">Detalle</th>
                                                    <th align="center" class="text-center">Valor</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="date" v-model="credito.fecha"
                                                            placeholder="Agrega la fecha" name="">
                                                    </td>
                                                    <td><input type="text" v-model="credito.detalle" name="detalle"
                                                            class="form-control" required></td>
                                                    <td width="125"><input type="number" v-model="credito.saldo"
                                                            name="saldo" class="form-control" required></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div v-if="!credito.edit" class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="agregarCreditos()">Agregar</a>
                                        </div>
                                        <div v-else class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="actualizarCredito()">Actualizar</a>
                                            <a href="#" class="btn btn-danger ml-1"
                                                @click.prevent="cancelarEditCredito()"><i
                                                    class="fa fa-window-close"></i></a>
                                        </div>
                                    </div>

                                    @if($datos->metodo == 'individual')
                                    <div class="col-6"
                                        style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 4px red;">
                                        {!! $transacciones->transacciones !!}
                                    </div>
                                    @elseif($datos->metodo == 'concatenado')
                                    <div class="col-6 mt-2 ">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-link active" id="nav-conciliacion2-tab" data-toggle="tab"
                                                    href="#nav-conciliacion2" role="tab"
                                                    aria-controls="nav-conciliacion2"
                                                    aria-selected="true">ENUNCIADOS</a>
                                                <a class="nav-link" id="nav-libro-banco2-tab" data-toggle="tab"
                                                    href="#nav-libro-banco2" role="tab" aria-controls="nav-libro-banco2"
                                                    aria-selected="false">LIBRO BANCO</a>

                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-conciliacion2"
                                                role="tabpanel" aria-labelledby="nav-conciliacion2-tab"
                                                style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                                                @isset ($conciliacionbancaria->transacciones)
                                                {!! $conciliacionbancaria->transacciones !!}
                                                @endisset
                                            </div>
                                            <div class="tab-pane fade" id="nav-libro-banco2" role="tabpanel"
                                                aria-labelledby="nav-libro-banco2-tab"
                                                style=" height:300px; overflow-y: scroll; border: double 8px #E71822;  overflow-x: hidden;">
                                                <h2 class="text-center  font-weight-bold text-danger">Anexos de Control
                                                    Interno</h2>
                                                <h3 class="text-center font-weight-bold text-danger">Libro Banco</h3>
                                                <div class="row p-3  mb-2 justify-content-center ">
                                                    <div class="col-5">
                                                        <h5 class="font-weight-bold">@{{ lb_nombre }}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="font-weight-bold">@{{ lb_n_banco }}</h5>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="font-weight-bold">@{{ lb_c_banco }}</h5>
                                                    </div>
                                                </div>
                                                <br>
                                                <table style="border: hidden"
                                                    class="table table-bordered table-sm mb-2">
                                                    <thead style="border: hidden">
                                                        <tr style="border: hidden" class="text-center bg-dark">
                                                            <th width="100">Fecha</th>
                                                            <th width="300">Detalle</th>
                                                            <th width="50"><i>Ch/</i></th>
                                                            <th width="90">Debe</th>
                                                            <th width="90">Haber</th>
                                                            <th width="100">Saldo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="border: hidden">
                                                        <tr style="border: hidden" v-for="(banco, index) in lb_banco">
                                                            <td align="left">@{{formatoFecha(banco.fecha)}}</td>
                                                            <td align="left">@{{banco.detalle}}</td>
                                                            <td align="left">@{{banco.cheque}}</td>
                                                            <td align="right">@{{decimales(banco.debe)}}</td>
                                                            <td align="right">@{{decimales(banco.haber)}}</td>
                                                            <td align="right">@{{decimales(banco.saldo)}}</td>
                                                        </tr>
                                                        <tr style="border: hidden" class="bg-secondary">
                                                            <td class="text-center font-weight-bold">SUMAN</td>
                                                            <td class="text-left font-weight-bold"></td>
                                                            <td class="text-left font-weight-bold"></td>
                                                            <td class="text-right font-weight-bold">@{{ debe_lbanco }}
                                                            </td>
                                                            <td class="text-right font-weight-bold">@{{ haber_lbanco }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    @endif
                                    <div class="col-12 mt-2 p-2" style=" height:300px; overflow-y: scroll;">
                                        <h2 class="text-center">CRÉDITOS</h2>
                                        <div class="row justify-content-around mb-2">
                                            <table class="table table-bordered table-sm mb-2 p-2">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th align="center" class="text-center" width="150">Fecha</th>
                                                        <th align="center" class="text-center">Detalle</th>
                                                        <th align="center" class="text-center">Valor</th>

                                                    </tr>
                                                </thead>
                                                <tbody is="draggable" group="people" :list="c_creditos" tag="tbody">
                                                    <tr v-for="(c, index) in c_creditos">
                                                        <td align="left">@{{formatoFecha(c.fecha)}}</td>
                                                        <td align="left">@{{ c.detalle}}</td>
                                                        <td class="text-right">@{{ decimales(c.saldo)}}</td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="editCredito(index)"
                                                                class="btn btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="EliminarCredito(index)"
                                                                class="btn btn-danger">
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
                            <!-- end creditos -->
                            <!-- cheques -->
                            <div class="tab-pane fade " id="nav-bih-conciliacion-cheque" role="tabpanel"
                                aria-labelledby="nav-bih-conciliacion-cheque-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <h2 class="text-center">AGREGAR CHEQUES</h2>

                                        <table class="table table-bordered table-sm">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th align="center" class="text-center" width="50">Fecha</th>
                                                    <th align="center" class="text-center">Detalle</th>
                                                    <th align="center" class="text-center">Valor</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="date" v-model="cheques.fecha"
                                                            placeholder="Agrega la fecha" name="">
                                                    </td>
                                                    <td><input type="text" v-model="cheques.detalle" name="detalle"
                                                            class="form-control" required></td>
                                                    <td width="125"><input type="number" v-model="cheques.saldo"
                                                            name="saldo" class="form-control" required></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div v-if="!cheques.edit" class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="agregarCheques()">Agregar</a>
                                        </div>
                                        <div v-else class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="actualizarCheque()">Actualizar</a>
                                            <a href="#" class="btn btn-danger ml-1"
                                                @click.prevent="cancelarEditCheque()"><i
                                                    class="fa fa-window-close"></i></a>
                                        </div>
                                    </div>
                                    @if($datos->metodo == 'individual')
                                    <div class="col-6"
                                        style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 4px red;">
                                        {!! $transacciones->transacciones !!}
                                    </div>
                                    @elseif($datos->metodo == 'concatenado')
                                    <div class="col-6 mt-2 ">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-link active" id="nav-conciliacion3-tab" data-toggle="tab"
                                                    href="#nav-conciliacion3" role="tab"
                                                    aria-controls="nav-conciliacion3"
                                                    aria-selected="true">ENUNCIADOS</a>
                                                <a class="nav-link" id="nav-libro-banco3-tab" data-toggle="tab"
                                                    href="#nav-libro-banco3" role="tab" aria-controls="nav-libro-banco3"
                                                    aria-selected="false">LIBRO BANCO</a>

                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-conciliacion3"
                                                role="tabpanel" aria-labelledby="nav-conciliacion3-tab"
                                                style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                                                @isset ($conciliacionbancaria->transacciones)
                                                {!! $conciliacionbancaria->transacciones !!}
                                                @endisset
                                            </div>
                                            <div class="tab-pane fade" id="nav-libro-banco3" role="tabpanel"
                                                aria-labelledby="nav-libro-banco3-tab"
                                                style=" height:300px; overflow-y: scroll; border: double 8px #E71822;  overflow-x: hidden;">
                                                <h2 class="text-center  font-weight-bold text-danger">Anexos de Control
                                                    Interno</h2>
                                                <h3 class="text-center font-weight-bold text-danger">Libro Banco</h3>
                                                <div class="row p-3  mb-2 justify-content-center ">
                                                    <div class="col-5">
                                                        <h5 class="font-weight-bold">@{{ lb_nombre }}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="font-weight-bold">@{{ lb_n_banco }}</h5>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="font-weight-bold">@{{ lb_c_banco }}</h5>
                                                    </div>
                                                </div>
                                                <br>
                                                <table style="border: hidden"
                                                    class="table table-bordered table-sm mb-2">
                                                    <thead style="border: hidden">
                                                        <tr style="border: hidden" class="text-center bg-dark">
                                                            <th width="100">Fecha</th>
                                                            <th width="300">Detalle</th>
                                                            <th width="50"><i>Ch/</i></th>
                                                            <th width="90">Debe</th>
                                                            <th width="90">Haber</th>
                                                            <th width="100">Saldo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="border: hidden">
                                                        <tr style="border: hidden" v-for="(banco, index) in lb_banco">
                                                            <td align="left">@{{formatoFecha(banco.fecha)}}</td>
                                                            <td align="left">@{{banco.detalle}}</td>
                                                            <td align="left">@{{banco.cheque}}</td>
                                                            <td align="right">@{{decimales(banco.debe)}}</td>
                                                            <td align="right">@{{decimales(banco.haber)}}</td>
                                                            <td align="right">@{{decimales(banco.saldo)}}</td>
                                                        </tr>
                                                        <tr style="border: hidden" class="bg-secondary">
                                                            <td class="text-center font-weight-bold">SUMAN</td>
                                                            <td class="text-left font-weight-bold"></td>
                                                            <td class="text-left font-weight-bold"></td>
                                                            <td class="text-right font-weight-bold">@{{ debe_lbanco }}
                                                            </td>
                                                            <td class="text-right font-weight-bold">@{{ haber_lbanco }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    @endif

                                    <div class="col-12 mt-2 p-2" style=" height:300px; overflow-y: scroll;">
                                        <h2 class="text-center">CHEQUES</h2>
                                        <div class="row justify-content-around mb-2">
                                            <table class="table table-bordered table-sm mb-2 p-2">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th align="center" class="text-center" width="150">Fecha</th>
                                                        <th align="center" class="text-center">Detalle</th>
                                                        <th align="center" class="text-center">Valor</th>

                                                    </tr>
                                                </thead>
                                                <tbody is="draggable" group="people" :list="c_cheques" tag="tbody">
                                                    <tr v-for="(c, index) in c_cheques">
                                                        <td align="left">@{{formatoFecha(c.fecha)}}</td>
                                                        <td align="left">@{{ c.detalle}}</td>
                                                        <td class="text-right">@{{ decimales(c.saldo)}}</td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="editCheque(index)"
                                                                class="btn btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="EliminarCheque(index)"
                                                                class="btn btn-danger">
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
                            <!-- end cheques -->
                        </div> <!-- cierre de modal tab-content -->
                    </div> <!-- col-12 -->
                </div> <!-- cierre de modal content center -->
            </div> <!-- cierre de modal body -->
        </div> <!-- cierre de modal content -->
    </div> <!-- cierre de modal document -->
</div> <!-- cierre de modal -->