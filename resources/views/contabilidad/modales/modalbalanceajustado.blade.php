{{-- TRANSACCION --}}
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="ba-transaccion" tabindex="-1"  role="dialog" aria-labelledby="ba-transaccionLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl " role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
              <div v-if="update">
                <h5 class="modal-title" id="ba-transaccionLabel">ACTUALIZAR</h5>
              </div>
              <div v-else="!update">
                <h5 class="modal-title" id="ba-transaccionLabel">TRANSCRIBIR CUENTAS</h5>
              </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <a class="btn btn-dark" href="" @click.prevent="calculadora()">CALCULADORA</a>

                <div class="row justify-content-center">

                @if($datos->metodo == 'individual')
                     <div class="col-12" style=" height:300px; overflow-y: scroll; overflow-x: hidden; border: double 8px #E71822;">
                        {!! $transacciones->transacciones !!}
                     </div>
                @elseif($datos->metodo == 'concatenado')
                  <div class="col-12 mt-2" style=" height:400px; overflow-y: scroll; border: double 8px #E71822;">
                     <h1 class="text-center font-weight-bold mt-2">Datos para elaborar hoja de trabajo</h1>
                    <h2 class="font-weight-bold text-danger text-center">@{{ nombre_hoja }}</h2>
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
                                        <td class="text-left" width="200">@{{ balan.cuenta}}</td>
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
                   <div class="col-4 border border-bottom-0 border-left-0 border-top-0 border-danger">
                        <h2 class="text-center">AGREGAR CUENTAS</h2>
                           <div class="form-group row">
                            <label  class="col-sm-4 col-form-label">Selecciona la Cuenta</label>
                            <div class="col-sm-7">
                            {{--   <multiselect v-model="mayor.seleccion" :options="options"  placeholder="Elige Una Cuenta" label="text" track-by="value" @input="onSelect()"></multiselect> --}}
                          <model-select :options="options" v-model="balance.cuenta_id" placeholder="ELEGIR CUENTA"></model-select>
                            </div>
                            {{-- <div class="col-sm-2">
                            <a href="" class="btn btn-danger" @click.prevent="onSelect">Seleccionar</a>
                          </div> --}}
                          </div>
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
                              <input autocomplete="ÑÖcompletes" type="number" v-model="balance.debe" name="fecha" class="form-control">
                            </td>
                             <td>
                              <input autocomplete="ÑÖcompletes" type="number" v-model="balance.haber" name="fecha" class="form-control">
                            </td>     
                        </tr>
                      </tbody>
                    </table>
                    <div v-if="!balance.edit" class="row justify-content-center">
                          <a href="#" class="btn btn-success" @click.prevent="agregarRegistro()">Agregar</a>

                      </div>
                       <div v-else class="row justify-content-center">
                            <a href="#" class="btn btn-success" @click.prevent="actualizarBalance()">Actualizar</a>
                            <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEdicion()"><i class="fa fa-window-close"></i></a>
                      </div>              
                  </div>
               
                  <div class="col-8 mt-2 p-2"  style=" height:400px; overflow-y: scroll;">
                    <h2 class="text-center">REGISTROS</h2>
              <div class="row justify-content-around mb-2">
          <table class="table table-bordered table-sm mb-2 p-2">
              <thead>
                <tr class="text-center bg-dark">
                  <th>CUENTAS</th>
                  <th width="200">DEBE</th>
                  <th width="200">HABER</th>
                  <th class="text-center" v-if="balances_ajustados.length >=1" colspan="2">ACCIONES</th>

                </tr>
              </thead>
              <tbody is="draggable" group="people" :list="balances_ajustados" tag="tbody">

                  <tr v-for="(balan, index) in balances_ajustados">
                    <td class="text-left">@{{ balan.cuenta}}</td>
                    <td class="text-right">@{{ decimales(balan.debe)}}</td>
                    <td class="text-right" width="125">@{{ decimales(balan.haber) }}</td>
                    <td class="text-right"  width="50">
                      <a @click.prevent="editBalance(index)" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                      </a>
                    </td>
                      <td align="center" width="50">
                      <a @click.prevent="warningEliminar(index)" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>
                  </tr>
                <tr class="bg-secondary">
                  <td class="text-left font-weight-bold">SUMAN</td>
                  <td class="text-right">@{{ suman.debe }}</td>
                  <td class="text-right">@{{ suman.haber }}</td>
                </tr>
              </tbody>
              </table>
              {{-- <a v-if="update" href="#" class="addDiario btn btn-success" @click.prevent="updaterRegister()">Actualizar Transaccion</a>  --}}
              {{-- <a v-if="!update" href="#" class="addDiario btn btn-success" @click.prevent="guardarRegistro()">Agregar Transaccion</a>  --}}
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
{{-- <div class="modal fade" id="eliminar-mg" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="eliminar-mgLabel" aria-hidden="true">
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
 --}}