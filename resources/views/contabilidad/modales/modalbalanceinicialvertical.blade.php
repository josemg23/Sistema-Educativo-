{{-- TRANSACCION --}}
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="biv-transaccion" tabindex="-1" role="dialog"
    aria-labelledby="bg-transaccionLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl " role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <div v-if="update">
                    <h5 class="modal-title" id="er-ingresoLabel">ACTUALIZAR CUENTAS</h5>
                </div>
                <div v-else="!update">
                    <h5 class="modal-title" id="ba-transaccionLabel">AGREGAR CUENTAS</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="col-12">
                        <nav>
                            <div style="font-size: 15px" class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-biv-activo-corriente-tab" data-toggle="tab"
                                    href="#nav-biv-activo-corrente" role="tab" aria-controls="nav-biv-activo-corrente"
                                    aria-selected="true">Activo Corriente</a>

                                <a class="nav-link" id="nav-biv-activo-no-corriente-tab" data-toggle="tab"
                                    href="#nav-biv-activo-no-corriente" role="tab"
                                    aria-controls="nav-biv-activo-no-corriente" aria-selected="false">Activo No
                                    Corriente</a>

                                <a class="nav-link" id="nav-biv-pasivo-corriente-tab" data-toggle="tab"
                                    href="#nav-biv-pasivo-corriente" role="tab" aria-controls="nav-biv-pasivo-corriente"
                                    aria-selected="false">Pasivo Corriente</a>

                                <a class="nav-link" id="nav-biv-pasivo-no-corriente-tab" data-toggle="tab"
                                    href="#nav-biv-pasivo-no-corriente" role="tab"
                                    aria-controls="nav-biv-pasivo-no-corriente" aria-selected="false">Pasivo No
                                    Corriente</a>

                                <a class="nav-link" id="nav-biv-patrimonio-tab" data-toggle="tab"
                                    href="#nav-biv-patrimonio" role="tab" aria-controls="nav-biv-patrimonio"
                                    aria-selected="false">Patrimonio</a>
                                <a class="nav-link bg-dark" id="nav-calculadorav-tab" data-toggle="tab"
                                    href="#nav-calculadorav" role="tab" aria-controls="nav-calculadorav"
                                    aria-selected="false" @click.prevent="calculadora()">CALCULADORA</a>

                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-biv-activo-corrente" role="tabpanel"
                                aria-labelledby="nav-biv-activo-corrente-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <h2 class="text-center">AGREGAR ACTIVO CORRIENTE</h2>
                                        <table class="table">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Cuenta</th>
                                                    <th>Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <model-select :options="options"
                                                            v-model="activo.a_corriente.cuenta_id"
                                                            placeholder="ELEGIR CUENTA"></model-select>

                                                    </td>
                                                    <td width="200">
                                                        <input autocomplete="ÑÖcompletes" type="number"
                                                            v-model="activo.a_corriente.saldo" class="form-control">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div v-if="!activo.a_corriente.edit" class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="agregarActivoCorriente()">Agregar</a>
                                        </div>
                                        <div v-else class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="actualizarActivoC()">Actualizar</a>
                                            <a href="#" class="btn btn-danger ml-1"
                                                @click.prevent="cancelarEdicionActivoC()"><i
                                                    class="fa fa-window-close"></i></a>
                                        </div>
                                    </div>
                                    @if($datos->metodo == 'individual')

                                    <div class="col-6"
                                        style=" height:200px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                                        {!! $transacciones->transacciones !!}
                                    </div>
                                    @elseif($datos->metodo == 'concatenado')
                                    <div class="col-6 mt-2 "
                                        style=" height:200px; overflow-y: scroll; border: double 8px #E71822;">
                                        @isset ($balancesInicial->transacciones )
                                        {!! $balancesInicial->transacciones !!}
                                        @endisset

                                    </div>
                                    @endif


                                    <div class="col-12 mt-2 p-2" style=" height:200px; overflow-y: scroll;">
                                        <h2 class="text-center">Activos Corrientes</h2>
                                        <div class="row justify-content-around mb-2">
                                            <table class="table table-bordered table-sm mb-2 p-2">
                                                <thead>
                                                    <tr class="text-center bg-dark">
                                                        <th>CUENTA</th>
                                                        <th width="200">SALDO</th>
                                                        <th class="text-center" colspan="2">ACCIONES</th>

                                                    </tr>
                                                </thead>
                                                <tbody is="draggable" group="people" :list="a_corrientes" tag="tbody">

                                                    <tr v-for="(balan, index) in a_corrientes">
                                                        <td class="text-left">@{{ balan.nom_cuenta}}</td>
                                                        <td class="text-right">@{{ decimales(balan.saldo)}}</td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="editAcorriente(index)"
                                                                class="btn btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="deleteAcCooriente(index)"
                                                                class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-secondary">
                                                        <td class="text-left font-weight-bold">Total Activo Corriente
                                                        </td>
                                                        <td class="text-right">
                                                            @{{ decimales(b_initotal.t_a_corriente) }}</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-biv-activo-no-corriente" role="tabpanel"
                                aria-labelledby="nav-biv-activo-no-corriente-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <h2 class="text-center">AGREGAR ACTIVO NO CORRIENTE</h2>
                                        <table class="table">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Cuenta</th>
                                                    <th>Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <model-select :options="options"
                                                            v-model="activo.a_nocorriente.cuenta_id"
                                                            placeholder="ELEGIR CUENTA"></model-select>

                                                    </td>
                                                    <td width="200">
                                                        <input autocomplete="ÑÖcompletes" type="number"
                                                            v-model="activo.a_nocorriente.saldo" class="form-control">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div v-if="!activo.a_nocorriente.edit" class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="agregarActivoNoCorriente()">Agregar</a>
                                        </div>
                                        <div v-else class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="actualizarActivoNC()">Actualizar</a>
                                            <a href="#" class="btn btn-danger ml-1"
                                                @click.prevent="cancelarEdicionActivoNC()"><i
                                                    class="fa fa-window-close"></i></a>
                                        </div>
                                    </div>
                                    @if($datos->metodo == 'individual')

                                    <div class="col-6" style=" height:200px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                                        {!! $transacciones->transacciones !!}
                                    </div>
                                    @elseif($datos->metodo == 'concatenado')
                                    <div class="col-6 mt-2 "
                                        style=" height:200px; overflow-y: scroll; border: double 8px #E71822;">
                                        @isset ($balancesInicial->transacciones )
                                        {!! $balancesInicial->transacciones !!}
                                        @endisset

                                    </div>
                                    @endif

                                    <div class="col-12 mt-2 p-2" style=" height:200px; overflow-y: scroll;">
                                        <h2 class="text-center">Activos no Corrientes</h2>
                                        <div class="row justify-content-around mb-2">
                                            <table class="table table-bordered table-sm mb-2 p-2">
                                                <thead>
                                                    <tr class="text-center bg-dark">
                                                        <th>CUENTA</th>
                                                        <th width="200">SALDO</th>
                                                        <th class="text-center" colspan="2">ACCIONES</th>

                                                    </tr>
                                                </thead>
                                                <tbody is="draggable" group="people" :list="a_nocorrientes" tag="tbody">

                                                    <tr v-for="(balan, index) in a_nocorrientes">
                                                        <td class="text-left">@{{ balan.nom_cuenta}}</td>
                                                        <td class="text-right">@{{ decimales(balan.saldo)}}</td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="editNoAcorriente(index)"
                                                                class="btn btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="deleteAcNoCooriente(index)"
                                                                class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-secondary">
                                                        <td class="text-left font-weight-bold">Total Activo No Corriente
                                                        </td>
                                                        <td class="text-right">
                                                            @{{ decimales(b_initotal.t_a_nocorriente) }}</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-biv-pasivo-corriente" role="tabpanel"
                                aria-labelledby="nav-biv-pasivo-corriente-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <h2 class="text-center">AGREGAR PASIVO CORRIENTE</h2>
                                        <table class="table">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Cuenta</th>
                                                    <th>Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <model-select :options="options"
                                                            v-model="pasivo.p_corriente.cuenta_id"
                                                            placeholder="ELEGIR CUENTA"></model-select>

                                                    </td>
                                                    <td width="200">
                                                        <input autocomplete="ÑÖcompletes" type="number"
                                                            v-model="pasivo.p_corriente.saldo" class="form-control">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div v-if="!pasivo.p_corriente.edit" class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="agregarPasivoCorriente()">Agregar</a>
                                        </div>
                                        <div v-else class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="actualizarPasivoC()">Actualizar</a>
                                            <a href="#" class="btn btn-danger ml-1"
                                                @click.prevent="cancelarEdicionPcorriente()"><i
                                                    class="fa fa-window-close"></i></a>
                                        </div>
                                    </div>
                                    @if($datos->metodo == 'individual')

                                    <div class="col-6" style=" height:200px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                                        {!! $transacciones->transacciones !!}
                                    </div>
                                    @elseif($datos->metodo == 'concatenado')
                                    <div class="col-6 mt-2 "
                                        style=" height:200px; overflow-y: scroll; border: double 8px #E71822;">
                                        @isset ($balancesInicial->transacciones )
                                        {!! $balancesInicial->transacciones !!}
                                        @endisset

                                    </div>
                                    @endif

                                    <div class="col-12 mt-2 p-2" style=" height:200px; overflow-y: scroll;">
                                        <h2 class="text-center">Pasivos Corrientes</h2>
                                        <div class="row justify-content-around mb-2">
                                            <table class="table table-bordered table-sm mb-2 p-2">
                                                <thead>
                                                    <tr class="text-center bg-dark">
                                                        <th>CUENTA</th>
                                                        <th width="200">SALDO</th>
                                                        <th class="text-center" colspan="2">ACCIONES</th>

                                                    </tr>
                                                </thead>
                                                <tbody is="draggable" group="people" :list="p_corrientes" tag="tbody">

                                                    <tr v-for="(balan, index) in p_corrientes">
                                                        <td class="text-left">@{{ balan.nom_cuenta}}</td>
                                                        <td class="text-right">@{{ decimales(balan.saldo)}}</td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="editPcorriente(index)"
                                                                class="btn btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="deletePaCooriente(index)"
                                                                class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-secondary">
                                                        <td class="text-left font-weight-bold">Total Pasivo Corriente
                                                        </td>
                                                        <td class="text-right">@{{ decimales(b_initotal.t_p_corriente) }}</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="nav-biv-pasivo-no-corriente" role="tabpanel"
                                aria-labelledby="nav-biv-pasivo-no-corriente-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <h2 class="text-center">AGREGAR PASIVO NO CORRIENTE</h2>
                                        <table class="table">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Cuenta</th>
                                                    <th>Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <model-select :options="options"
                                                            v-model="pasivo.p_nocorriente.cuenta_id"
                                                            placeholder="ELEGIR CUENTA"></model-select>

                                                    </td>
                                                    <td width="200">
                                                        <input autocomplete="ÑÖcompletes" type="number"
                                                            v-model="pasivo.p_nocorriente.saldo" class="form-control">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div v-if="!pasivo.p_nocorriente.edit" class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="agregarPasivoNoCorriente()">Agregar</a>
                                        </div>
                                        <div v-else class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="actualizarPasivoNC()">Actualizar</a>
                                            <a href="#" class="btn btn-danger ml-1"
                                                @click.prevent="cancelarEdicionPNocorriente()"><i
                                                    class="fa fa-window-close"></i></a>
                                        </div>
                                    </div>
                                    @if($datos->metodo == 'individual')

                                    <div class="col-6" style=" height:200px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                                        {!! $transacciones->transacciones !!}
                                    </div>
                                    @elseif($datos->metodo == 'concatenado')
                                    <div class="col-6 mt-2 "
                                        style=" height:200px; overflow-y: scroll; border: double 8px #E71822;">
                                        @isset ($balancesInicial->transacciones )
                                        {!! $balancesInicial->transacciones !!}
                                        @endisset

                                    </div>
                                    @endif

                                    <div class="col-12 mt-2 p-2" style=" height:200px; overflow-y: scroll;">
                                        <h2 class="text-center">Pasivos no Corriente</h2>
                                        <div class="row justify-content-around mb-2">
                                            <table class="table table-bordered table-sm mb-2 p-2">
                                                <thead>
                                                    <tr class="text-center bg-dark">
                                                        <th>CUENTA</th>
                                                        <th width="200">SALDO</th>
                                                        <th class="text-center" colspan="2">ACCIONES</th>

                                                    </tr>
                                                </thead>
                                                <tbody is="draggable" group="people" :list="p_nocorrientes" tag="tbody">

                                                    <tr v-for="(balan, index) in p_nocorrientes">
                                                        <td class="text-left">@{{ balan.nom_cuenta}}</td>
                                                        <td class="text-right">@{{ decimales(balan.saldo)}}</td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="editPNocorriente(index)"
                                                                class="btn btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="deletePaNoCooriente(index)"
                                                                class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-secondary">
                                                        <td class="text-left font-weight-bold">Total Pasivo No corriente
                                                        </td>
                                                        <td class="text-right">@{{ decimales(b_initotal.t_p_no_corriente) }}</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="nav-biv-patrimonio" role="tabpanel"
                                aria-labelledby="nav-biv-patrimonio-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <h2 class="text-center">AGREGAR PATRIMONIO</h2>
                                        <table class="table">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Cuenta</th>
                                                    <th>Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <model-select :options="options" v-model="patrimonio.cuenta_id"
                                                            placeholder="ELEGIR CUENTA"></model-select>

                                                    </td>
                                                    <td width="200">
                                                        <input autocomplete="ÑÖcompletes" type="number"
                                                            v-model="patrimonio.saldo" class="form-control">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div v-if="!patrimonio.edit" class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="agregarPatrimonio()">Agregar</a>
                                        </div>
                                        <div v-else class="row justify-content-center">
                                            <a href="#" class="btn btn-success"
                                                @click.prevent="actualizarPatrimonio()">Actualizar</a>
                                            <a href="#" class="btn btn-danger ml-1"
                                                @click.prevent="cancelarEdicionPatrimonio()"><i
                                                    class="fa fa-window-close"></i></a>
                                        </div>
                                    </div>
                                    @if($datos->metodo == 'individual')

                                    <div class="col-6" style=" height:200px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                                        {!! $transacciones->transacciones !!}
                                    </div>
                                    @elseif($datos->metodo == 'concatenado')
                                    <div class="col-6 mt-2 "
                                        style=" height:200px; overflow-y: scroll; border: double 8px #E71822;">
                                        @isset ($balancesInicial->transacciones )
                                        {!! $balancesInicial->transacciones !!}
                                        @endisset

                                    </div>
                                    @endif

                                    <div class="col-12 mt-2 p-2" style=" height:200px; overflow-y: scroll;">
                                        <h2 class="text-center">Patrimonios</h2>
                                        <div class="row justify-content-around mb-2">
                                            <table class="table table-bordered table-sm mb-2 p-2">
                                                <thead>
                                                    <tr class="text-center bg-dark">
                                                        <th>CUENTA</th>
                                                        <th width="200">SALDO</th>
                                                        <th class="text-center" colspan="2">ACCIONES</th>

                                                    </tr>
                                                </thead>
                                                <tbody is="draggable" group="people" :list="patrimonios" tag="tbody">

                                                    <tr v-for="(balan, index) in patrimonios">
                                                        <td class="text-left">@{{ balan.nom_cuenta}}</td>
                                                        <td class="text-right">@{{ decimales(balan.saldo)}}</td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="editPatrimonio(index)"
                                                                class="btn btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td align="center" width="50">
                                                            <a @click.prevent="deletePatrimonio(index)"
                                                                class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-secondary">
                                                        <td class="text-left font-weight-bold">Total Patrimonio</td>
                                                        <td class="text-right">@{{ decimales(b_initotal.t_patrimonio) }}</td>
                                                        <td></td>
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
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>