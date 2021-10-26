{{-- TRANSACCION --}}
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="ht-transaccion" tabindex="-1" role="dialog"
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
                <div class="row justify-content-center">
                    <h1 class="text-center font-weight-bold mt-2">Datos para elaborar hoja de trabajo</h1>

                    @if($datos->metodo == 'individual')
                    <div class="col-12"
                        style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                        {!! $transacciones->transacciones !!}
                    </div>
                    @elseif($datos->metodo == 'concatenado')
                    <div class="col-12" style="border: double 8px #E71822;">
                        <ul class="nav nav-tabs" id="datosHoja" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="ht-balance-comprobacion-tab" data-toggle="tab"
                                    href="#ht-balance-comprobacion" role="tab" aria-controls="ht-balance-comprobacion"
                                    aria-selected="true">Balance de comprobacion</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="ht-mayor-general-tab" data-toggle="tab" href="#ht-mayor-general"
                                    role="tab" aria-controls="ht-mayor-general" aria-selected="false">Mayor General</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link bg-dark" id="calculadoraht-tab" data-toggle="tab"
                                    href="#calculadoraht" role="tab" aria-controls="calculadoraht" aria-selected="false"
                                    @click.prevent="calculadora()">CALCULADORA</a>
                            </li>


                        </ul>
                        <div class="tab-content" id="datosHojaContent">
                            <div class="tab-pane fade show active" id="ht-balance-comprobacion" role="tabpanel"
                                aria-labelledby="ht-balance-comprobacion-tab"
                                style=" height:300px; overflow-y: scroll;">
                                <h1 class="text-center text-danger font-weight-bold mt-2">BALANCE DE COMPROBACION</h1>
                                <table class="table table-bordered table-sm mb-2">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th rowspan="2" align="center" class="text-center">CUENTAS</th>
                                            <th colspan="2" align="center" class="text-center">SUMAS</th>
                                            <th colspan="2" align="center" class="text-center">SALDOS</th>
                                            {{-- <td  class="text-center" valign="center" v-if="balances.length >=1" colspan="2" rowspan="2">ACCIONES</td> --}}

                                        </tr>
                                        <tr class="bg-dark">
                                            <td align="center">Debe</td>
                                            <td align="center">Haber</td>
                                            <td align="center">Debe</td>
                                            <td align="center">Haber</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(balan, index) in balances">
                                            <td class="text-left">@{{ balan.cuenta}}</td>
                                            <td class="text-right" width="125">
                                                @{{ decimales(balan.suma_debe)}}</td>
                                            <td class="text-right" width="125">
                                                @{{ decimales(balan.suma_haber) }}</td>
                                            <td class="text-right" width="125">
                                                @{{ decimales(balan.saldo_debe) }}</td>
                                            <td class="text-right" width="125">
                                                @{{ decimales(balan.saldo_haber) }}</td>
                                            {{--          <td align="center" width="50"><a @click.prevent="deleteBalance(index)"  class="btn btn-danger"><i
                                          class="fas fa-trash-alt"></i></a></td>
                              <td align="center"  width="50"><a @click.prevent="editBalance(index)" class="btn btn-warning"><i
                                          class="fas fa-edit"></i></a></td> --}}

                                        </tr>
                                        {{--    <tr class="text-center bg-secondary">
                              <td align="center" valign="middle">SUMAN</td>
                              <td class="text-right">@{{ suman.sum_debe }}</td>
                                        <td class="text-right">@{{ suman.sum_haber }}</td>
                                        <td class="text-right">@{{ suman.sal_debe }}</td>
                                        <td class="text-right">@{{ suman.sal_haber }}</td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="ht-mayor-general" role="tabpanel"
                                aria-labelledby="ht-mayor-general-tab"
                                style=" height:300px; overflow-y: scroll; overflow-x: hidden;">
                                <h1 class="text-center text-danger font-weight-bold mt-2">MAYOR GENERAL</h1>
                                <div class="row justify-content-center">
                                    <div class="col-3 mb-2">
                                        <h3 class="text-center">@{{ nombre_mayor }}</h3>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div v-for="(cuenta, index) in mayorgeneral" class="col-11">
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
                                                        {{-- @{{ decimales(cuenta.total_saldo) }} --}}</td>
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
                    <div class="col-12 mt-2 border border-bottom-0 border-left-0 border-right-0 border-danger">
                        <h2 class="text-center">AGREGAR MOVIMIENTOS</h2>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Selecciona la Cuenta</label>
                            <div class="col-sm-7">
                                <model-select :options="options" v-model="registro.cuenta_id"
                                    placeholder="ELEGIR CUENTA"></model-select>
                            </div>

                        </div>

                        <table class="table table-bordered table-sm table-responsive">
                            <thead class="bg-info">
                                <tr>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE DE
                                        COMPROBACION</th>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">AJUSTES</th>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE AJUSTADO
                                    </th>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">ESTADO DE
                                        RESULTADO</th>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE GENERAL
                                    </th>
                                </tr>
                                <tr>
                                    <td class="text-center" width="125">DEBE</td>
                                    <td class="text-center" width="125">HABER</td>
                                    <td class="text-center" width="125">DEBE</td>
                                    <td class="text-center" width="125">HABER</td>
                                    <td class="text-center" width="125">DEBE</td>
                                    <td class="text-center" width="125">HABER</td>
                                    <td class="text-center" width="125">DEBE</td>
                                    <td class="text-center" width="125">HABER</td>
                                    <td class="text-center" width="125">DEBE</td>
                                    <td class="text-center" width="125">HABER</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-right" align="center" width="125"><input autocomplete="ÑÖcompletes"
                                            v-model="registro.balance_comp.debe" type="number"
                                            class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input autocomplete="ÑÖcompletes"
                                            v-model="registro.balance_comp.haber" type="number"
                                            class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input autocomplete="ÑÖcompletes"
                                            v-model="registro.ajustes.debe" type="number"
                                            class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input autocomplete="ÑÖcompletes"
                                            v-model="registro.ajustes.haber" type="number"
                                            class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input autocomplete="ÑÖcompletes"
                                            v-model="registro.balance_ajustado.debe" type="number"
                                            class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input autocomplete="ÑÖcompletes"
                                            v-model="registro.balance_ajustado.haber" type="number"
                                            class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input autocomplete="ÑÖcompletes"
                                            v-model="registro.estado_resultado.debe" type="number"
                                            class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input autocomplete="ÑÖcompletes"
                                            v-model="registro.estado_resultado.haber" type="number"
                                            class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input autocomplete="ÑÖcompletes"
                                            v-model="registro.balance_general.debe" type="number"
                                            class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input autocomplete="ÑÖcompletes"
                                            v-model="registro.balance_general.haber" type="number"
                                            class="form-control form-control-sm"></td>
                                </tr>
                            </tbody>
                        </table>

                        {{-- <h2 class="text-center font-weight-bold text-info">Balance Comprobacion</h2> --}}
                        {{--              <table class="table table-bordered table-sm mb-2">
                          <thead class="bg-success">
                            <tr>
                              <th  width="50" align="center" >Debe</th>
                              <th width="50" align="center" class="text-center">Haber</th>
                            </tr>
                       </thead>
                        <tbody >  
                          <tr>
                            <td>
                              <input autocomplete="ÑÖcompletes" type="number" v-model="registro.balance_comp.debe" name="fecha" class="form-control">
                            </td>
                             <td>
                              <input autocomplete="ÑÖcompletes" type="number" v-model="registro.balance_comp.haber" name="fecha" class="form-control">
                            </td>     
                          </tr>
                       </tbody>
                    </table>
                      <h2 class="text-center font-weight-bold text-info">Ajustes</h2>
                    <table class="table table-bordered table-sm mb-2">

                             <thead class="bg-success">
                            <tr>
                              <th  width="50" align="center" >Debe</th>
                              <th width="50" align="center" class="text-center">Haber</th>
                            </tr>
                       </thead>
                        <tbody >  
                          <tr>
                            <td>
                              <input autocomplete="ÑÖcompletes" type="number" v-model="registro.ajustes.debe" name="fecha" class="form-control">
                            </td>
                             <td>
                              <input autocomplete="ÑÖcompletes" type="number" v-model="registro.ajustes.haber" name="fecha" class="form-control">
                            </td>     
                        </tr>
                      </tbody>
                    </table>
                          <h2 class="text-center font-weight-bold text-info">Balance Ajustado</h2>
                    <table class="table table-bordered table-sm mb-2">

                             <thead class="bg-success">
                            <tr>
                              <th  width="50" align="center" >Debe</th>
                              <th width="50" align="center" class="text-center">Haber</th>
                            </tr>
                       </thead>
                        <tbody >  
                          <tr>
                            <td>
                              <input autocomplete="ÑÖcompletes" type="number" v-model="registro.balance_ajustado.debe" name="fecha" class="form-control">
                            </td>
                             <td>
                              <input autocomplete="ÑÖcompletes" type="number" v-model="registro.balance_ajustado.haber" name="fecha" class="form-control">
                            </td>     
                        </tr>
                      </tbody>
                    </table>

                    <h2 class="text-center font-weight-bold text-info">Estado de resultado</h2>
                    <table class="table table-bordered table-sm mb-2">

                             <thead class="bg-success">
                            <tr>
                              <th  width="50" align="center" >Debe</th>
                              <th width="50" align="center" class="text-center">Haber</th>
                            </tr>
                       </thead>
                        <tbody >  
                          <tr>
                            <td>
                              <input autocomplete="ÑÖcompletes" type="number" v-model="registro.estado_resultado.debe" name="fecha" class="form-control">
                            </td>
                             <td>
                              <input autocomplete="ÑÖcompletes" type="number" v-model="registro.estado_resultado.haber" name="fecha" class="form-control">
                            </td>     
                        </tr>
                      </tbody>
                    </table>

                    <h2 class="text-center font-weight-bold text-info">Balance General</h2>
                    <table class="table table-bordered table-sm mb-2">
                      <thead class="bg-success">
                            <tr>
                              <th  width="50" align="center" >Debe</th>
                              <th width="50" align="center" class="text-center">Haber</th>
                            </tr>
                       </thead>
                        <tbody >  
                          <tr>
                            <td>
                              <input autocomplete="ÑÖcompletes" type="number" v-model="registro.balance_general.debe" name="fecha" class="form-control">
                            </td>
                             <td>
                              <input autocomplete="ÑÖcompletes" type="number" v-model="registro.balance_general.haber" name="fecha" class="form-control">
                            </td>     
                        </tr>
                      </tbody>
                    </table> --}}

                        <div v-if="!registro.edit" class="row justify-content-center">
                            <a href="#" class="btn btn-success" @click.prevent="agregarRegistro()">Agregar</a>

                        </div>
                        <div v-else class="row justify-content-center">
                            <a href="#" class="btn btn-success" @click.prevent="actualizarBalance()">Actualizar</a>
                            <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEdicion()"><i
                                    class="fa fa-window-close"></i></a>
                        </div>

                    </div>

                    <div class="col-12 mt-2" v-if="registros.length > 0"
                        style=" height:400px; overflow-y: scroll; overflow-x: hidden;">
                        <h2 class="text-center">REGISTROS</h2>
                        <table class="table table-bordered table-sm table-responsive">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center " style="vertical-align: middle;" rowspan="2">CUENTAS</th>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE DE
                                        COMPROBACION</th>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">AJUSTES</th>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE AJUSTADO
                                    </th>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">ESTADO DE
                                        RESULTADO</th>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE GENERAL
                                    </th>
                                    <th class="text-center" style="vertical-align: middle;" rowspan="2" colspan="2">
                                        ACCIONES</th>
                                </tr>
                                <tr>
                                    <td class="text-center">DEBE</td>
                                    <td class="text-center">HABER</td>
                                    <td class="text-center">DEBE</td>
                                    <td class="text-center">HABER</td>
                                    <td class="text-center">DEBE</td>
                                    <td class="text-center">HABER</td>
                                    <td class="text-center">DEBE</td>
                                    <td class="text-center">HABER</td>
                                    <td class="text-center">DEBE</td>
                                    <td class="text-center">HABER</td>
                                </tr>
                            </thead>
                            <tbody is="draggable" group="cuentas" :list="registros" tag="tbody">
                                <tr v-for="(balan, index) in registros">
                                    <td class="text-left" width="300">@{{ balan.cuenta}}</td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(balan.bc_debe)}}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(balan.bc_haber) }}
                                    </td>
                                    <td class="text-right" align="center" width="100">
                                        @{{ decimales(balan.ajuste_debe) }}</td>
                                    <td class="text-right" align="center" width="100">
                                        @{{ decimales(balan.ajuste_haber) }}</td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(balan.ba_debe) }}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(balan.ba_haber) }}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(balan.er_debe) }}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(balan.er_haber) }}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(balan.bg_debe) }}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(balan.bg_haber) }}
                                    </td>
                                    <td align="center" width="50"><a @click.prevent="editBalance(index)"
                                            class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                                    <td align="center" width="50"><a @click.prevent="warningEliminar(index)"
                                            class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>

                            </tbody>
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">SUMAN</td>
                                    <td class="text-right">@{{ suman.balance_comp.total_debe }}</td>
                                    <td class="text-right">@{{ suman.balance_comp.total_haber }}</td>
                                    <td class="text-right">@{{ suman.ajustes.total_debe }}</td>
                                    <td class="text-right">@{{ suman.ajustes.total_haber }}</td>
                                    <td class="text-right">@{{ suman.balance_ajustado.total_debe }}</td>
                                    <td class="text-right">@{{ suman.balance_ajustado.total_haber }}</td>
                                    <td class="text-right">@{{ suman.estado_resultado.total_debe }}</td>
                                    <td class="text-right">@{{ suman.estado_resultado.total_haber }}</td>
                                    <td class="text-right">@{{ suman.balance_general.total_debe }}</td>
                                    <td class="text-right">@{{ suman.balance_general.total_haber }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="eliminar-ht" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="eliminar-htLabel" aria-hidden="true">
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