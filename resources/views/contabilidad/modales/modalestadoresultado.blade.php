{{-- TRANSACCION --}}
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="er-ingreso" tabindex="-1"  role="dialog" aria-labelledby="er-ingresoLabel" aria-hidden="true">
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
          @if($datos->metodo == 'individual')
          <div class="col-12" style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
            {!! $transacciones->transacciones !!}
          </div>
          @elseif($datos->metodo == 'concatenado')
          <div class="col-12 mt-2" style=" height:400px; overflow-y: scroll; border: double 8px #E71822;">
            <h1 class="text-center font-weight-bold mt-2">Datos para elaborar estado de resultados</h1>
            <h2 class="text-center font-weight-bold mt-2">HOJA DE TRABAJO</h2>
            <h3 class="font-weight-bold text-danger text-center">@{{ nombre_hoja }}</h3>
            <table class="table table-bordered table-sm">
              <thead class="bg-dark">
                <tr>
                  <th class="text-center " style="vertical-align: middle;"  rowspan="2">CUENTAS</th>
                  <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE DE COMPROBACION</th>
                  <th class="text-center" style="vertical-align: middle;" colspan="2">AJUSTES</th>
                  <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE AJUSTADO</th>
                  <th class="text-center" style="vertical-align: middle;" colspan="2">ESTADO DE RESULTADO</th>
                  <th class="text-center" style="vertical-align: middle;" colspan="2">BALANCE GENERAL</th>
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
                <tr v-for="(balan, index) in hojatrabajo" >
                  <td align="center" width="200">@{{ balan.cuenta}}</td>
                  <td class="text-right" align="center" width="125">@{{ decimales(balan.bc_debe)}}</td>
                  <td class="text-right" align="center" width="125">@{{ decimales(balan.bc_haber) }}</td>
                  <td class="text-right" align="center" width="125">@{{ decimales(balan.ajuste_debe) }}</td>
                  <td  class="text-right"align="center" width="125">@{{ decimales(balan.ajuste_haber) }}</td>
                  <td class="text-right" align="center" width="125">@{{ decimales(balan.ba_debe) }}</td>
                  <td  class="text-right"align="center" width="125">@{{ decimales(balan.ba_haber) }}</td>
                  <td class="text-right" align="center" width="125">@{{ decimales(balan.er_debe) }}</td>
                  <td  class="text-right"align="center" width="125">@{{ decimales(balan.er_haber) }}</td>
                  <td class="text-right" align="center" width="125">@{{ decimales(balan.bg_debe) }}</td>
                  <td  class="text-right"align="center" width="125">@{{ decimales(balan.bg_haber) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          @endif
          <div class="col-12">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a  class="nav-link" id="nav-er-utilidad-tab" data-toggle="tab" href="#nav-er-utilidad" role="tab" aria-controls="nav-er-utilidad" aria-selected="false">Utilidad Bruta</a>
                <a class="nav-link active" id="nav-er-ingreso-tab" data-toggle="tab" href="#nav-er-ingreso" role="tab" aria-controls="nav-er-ingreso" aria-selected="true">Ingresos</a>
                <a class="nav-link" id="nav-er-gastos-tab" data-toggle="tab" href="#nav-er-gastos" role="tab" aria-controls="nav-er-gastos" aria-selected="false">Gastos</a>
                <a class="nav-link bg-dark" @click.prevent="calculadora()">CALCULADORA</a>
                
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-er-ingreso" role="tabpanel" aria-labelledby="nav-er-ingreso-tab">
                <div class="row">
                  <div class="col-6 border border-bottom-0 border-left-0 border-top-0 border-danger">
                    <h2 class="text-center">AGREGAR INGRESO</h2>
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
                            <model-select :options="options" v-model="ingreso.cuenta_id" placeholder="ELEGIR CUENTA"></model-select>
                            
                          </td>
                          <td  width="200">
                            <input autocomplete="ÑÖcompletes" type="number" v-model="ingreso.saldo" class="form-control">
                            
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    {{--         <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Selecciona la Cuenta</label>
                      <div class="col-sm-6">
                        <model-select :options="options" v-model="ingreso.cuenta_id" placeholder="ELEGIR CUENTA"></model-select>
                      </div>
                      <div class="col-2">
                        <input autocomplete="ÑÖcompletes" type="number" class="form-control">
                      </div>
                    </div> --}}
                    <div v-if="!ingreso.edit" class="row justify-content-center">
                      <a href="#" class="btn btn-success" @click.prevent="agregarIngreso()">Agregar</a>
                    </div>
                    <div v-else class="row justify-content-center">
                      <a href="#" class="btn btn-success" @click.prevent="actualizarIngreso()">Actualizar</a>
                      <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEdicionIngreso()"><i class="fa fa-window-close"></i></a>
                    </div>
                  </div>
                  
                  <div class="col-6 mt-2 p-2"  style=" height:400px; overflow-y: scroll;">
                    <h2 class="text-center">Ingresos</h2>
                    <div class="row justify-content-around mb-2">
                      <table class="table table-bordered table-sm mb-2 p-2">
                        <thead>
                          <tr class="text-center bg-dark">
                            <th>CUENTA</th>
                            <th width="200">SALDO</th>
                            <th class="text-center" colspan="2">ACCIONES</th>
                          </tr>
                        </thead>
                        <tbody is="draggable" group="people" :list="ingresos" tag="tbody">
                          <tr v-for="(balan, index) in ingresos">
                            <td class="text-left">@{{ balan.cuenta}}</td>
                            <td class="text-right">@{{ decimales(balan.saldo)}}</td>
                            <td align="center"  width="50">
                              <a @click.prevent="editIngreso(index)" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                            <td align="center" width="50">
                              <a @click.prevent="warningEliminarIngreso(index)" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                              </a>
                            </td>
                          </tr>
                          <tr class="bg-secondary">
                            <td class="text-left font-weight-bold">Total Ingresos</td>
                            <td class="text-right">@{{ totales.ingreso }}</td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="nav-er-gastos" role="tabpanel" aria-labelledby="nav-er-gastos-tab">
                <div class="row">
                  <div class="col-6 border border-bottom-0 border-left-0 border-top-0 border-danger">
                    <h2 class="text-center">AGREGAR GASTOS</h2>
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
                            <model-select :options="options" v-model="gasto.cuenta_id" placeholder="ELEGIR CUENTA"></model-select>
                            
                          </td>
                          <td  width="200">
                            <input autocomplete="ÑÖcompletes" type="number" v-model="gasto.saldo" class="form-control">
                            
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div v-if="!gasto.edit" class="row justify-content-center">
                      <a href="#" class="btn btn-success" @click.prevent="agregarGasto()">Agregar</a>
                    </div>
                    <div v-else class="row justify-content-center">
                      <a href="#" class="btn btn-success" @click.prevent="actualizarGasto()">Actualizar</a>
                      <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEdicionGasto()"><i class="fa fa-window-close"></i></a>
                    </div>
                  </div>
                  
                  <div class="col-6 mt-2 p-2"  style=" height:400px; overflow-y: scroll;">
                    <h2 class="text-center">Gastos</h2>
                    <div class="row justify-content-around mb-2">
                      <table class="table table-bordered table-sm mb-2 p-2">
                        <thead>
                          <tr class="text-center bg-dark">
                            <th>CUENTA</th>
                            <th width="200">SALDO</th>
                            <th class="text-center" colspan="2">ACCIONES</th>
                          </tr>
                        </thead>
                        <tbody is="draggable" group="people" :list="ingresos" tag="tbody">
                          <tr v-for="(balan, index) in gastos">
                            <td align="text-left">@{{ balan.cuenta}}</td>
                            <td class="text-right">@{{ decimales(balan.saldo)}}</td>
                            <td align="center"  width="50">
                              <a @click.prevent="editGasto(index)" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                            <td align="center" width="50">
                              <a @click.prevent="warningEliminarGastos(index)" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                              </a>
                            </td>
                          </tr>
                          <tr class="bg-secondary">
                            <td class="text-left font-weight-bold">Total Gastos</td>
                            <td class="text-right">@{{ totales.gastos }}</td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="nav-er-utilidad" role="tabpanel" aria-labelledby="nav-er-utilidad-tab">
                <div class="row justify-content-center">
                  <div class="col-6">
                    <table class="table table-bordered mt-3">
                      <thead class="thead-dark">
                        <tr>
                          <th>Venta</th>
                          <th>Costo de Venta</th>
                          <th>Accion</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input autocomplete="ÑÖcompletes" type="number"  v-model="utilidad_bruta.venta" class="form-control"></td>
                          <td><input autocomplete="ÑÖcompletes" type="number"  v-model="utilidad_bruta.costo_venta" class="form-control"></td>
                          <td><a href="#" class="btn btn-dark" @click.prevent="agregarBruta()">Guardar</a></td>
                        </tr>
                      </tbody>
                    </table>
                    
                    
                    
                    
                  </div>
                </div>
                {{--            <div class="row">
                  <div class="col-6 border border-bottom-0 border-left-0 border-top-0 border-danger">
                    <h2 class="text-center">CUENTAS DE UTILIDAD</h2>
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
                            <model-select :options="options" v-model="utilida.cuenta_id" placeholder="ELEGIR CUENTA"></model-select>
                            
                          </td>
                          <td  width="200">
                            <input autocomplete="ÑÖcompletes" type="number" v-model="utilida.saldo" class="form-control">
                            
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div v-if="!utilida.edit" class="row justify-content-center">
                      <a href="#" class="btn btn-success" @click.prevent="agregarUtilidad()">Agregar</a>
                    </div>
                    <div v-else class="row justify-content-center">
                      <a href="#" class="btn btn-success" @click.prevent="actualizarUtilidad()">Actualizar</a>
                      <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEdicionUtilidad()"><i class="fa fa-window-close"></i></a>
                    </div>
                  </div>
                  
                  <div class="col-6 mt-2 p-2"  style=" height:400px; overflow-y: scroll;">
                    <div> <strong>Utilidad Neta del Ejercicio: </strong> @{{ totales.utilidad_ejercicio }}</div>
                    <h2 class="text-center">Utilidades</h2>
                    <div class="row justify-content-around mb-2">
                      <table class="table table-bordered table-sm mb-2 p-2">
                        <thead>
                          <tr class="text-center bg-dark">
                            <th>CUENTA</th>
                            <th width="200">SALDO</th>
                            <th class="text-center" colspan="2">ACCIONES</th>
                          </tr>
                        </thead>
                        <tbody is="draggable" group="people" :list="utilidades" tag="tbody">
                          <tr v-for="(balan, index) in utilidades">
                            <td align="center">@{{ balan.cuenta}}</td>
                            <td align="center">@{{ decimales(balan.saldo)}}</td>
                            <td align="center"  width="50">
                              <a @click.prevent="editUtilidad(index)" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                            <td align="center" width="50">
                              <a @click.prevent="warningEliminarUtilidad(index)" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                              </a>
                            </td>
                          </tr>
                          <tr class="bg-secondary">
                            <td class="text-left font-weight-bold">Utilidad Liquida del ejercicio</td>
                            <td class="text-center">@{{ totales.gasto }}</td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>  --}}
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
<!-- Modal -->
<div class="modal fade" id="venta-estado-resultado" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="venta-estado-resultadoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="venta-estado-resultadoLabel">Ventas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" @click="eliminarRegistro()">Eliminar</button>
      </div>
    </div>
  </div>
</div>