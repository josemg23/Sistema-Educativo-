{{-- INGRESOS --}}
<div class="modal fade" id="ingreso" tabindex="-1"  role="dialog" aria-labelledby="ingresoLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="ingresoLabel">AGREGAR INGRESO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active text-dark font-weight-bold" id="tableingreso-tab" data-toggle="tab" href="#tableingreso" role="tab" aria-controls="tableingreso" aria-selected="true">INGRESO</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link text-dark font-weight-bold" id="devolucionventa-tab" data-toggle="tab" href="#devolucionventa" role="tab" aria-controls="devolucionventa" aria-selected="false">DEVOLUCION</a>
                </li>
                  <li class="nav-item" role="presentation">
                  <a class="nav-link text-light font-weight-bold bg-dark" id="calculadora-k-tab" data-toggle="tab" href="#calculadora-k" role="tab" aria-controls="calculadora-k" aria-selected="false" @click.prevent="VueSweetAlert2('example-component',{title: 'Called from basic js',
                    noteProp: [
                        'Note number 1',
                        'Note number 2'
                    ]})">CALCULADORA</a>
                </li>
              </ul>

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active " id="tableingreso" role="tabpanel" aria-labelledby="tableingreso-tab">
                

          {{--         <div v-if="movimientos.length > 0">
                  <h2 class="text-center">Ultimas Existencias</h2>
                <table  class="table table-bordered"> 
                    <thead class="bg-warning"> 
                      <tr class="text-center">
                        <th style="vertical-align:middle" rowspan="2">FECHA</th>
                        <th style="vertical-align:middle" rowspan="2">MOVIMIENTOS</th>
                        <th colspan="3">INGRESOS</th>
                        <th colspan="3">EGRESOS</th>
                        <th colspan="3">EXISTENCIA</th>
                      </tr>
                      <tr class="text-center">
                        <td>CANT.</td>
                        <td>PREC. UNIT</td>
                        <td>TOTAL</td>
                        <td>CANT.</td>
                        <td>PREC. UNIT</td>
                        <td>TOTAL</td>
                        <td>CANT</td>
                        <td>PREC. UNIT</td>
                        <td>TOTAL</td>
                      </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(transa, id) in movimientos">
                          <td>@{{ transa.fecha }}</td>
                          <td>@{{ transa.movimiento }}</td>
                          <td>@{{ transa.ingreso_cantidad }}</td>
                          <td>@{{ transa.ingreso_precio }} </td>
                          <td>@{{ transa.ingreso_total }}</td>
                          <td>@{{ transa.egreso_cantidad }}</td>
                          <td>@{{ transa.egreso_precio }}</td>
                          <td>@{{ transa.egreso_total }}</td>
                          <td>@{{ transa.existencia_cantidad }}</td>
                          <td>@{{ transa.existencia_precio }}</td>
                          <td >@{{ transa.existencia_total }}</td>
                          
                        </tr>
                      </tbody>
                  </table>

                </div> --}}
               
                 {{-- <h2>Bajar Existencias</h2>
                <div class="row justify-content-center">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
                          <thead class="thead-dark">
                        <tr>
                          <th width="75"  align="center" class="text-center">Cantidad</th>    
                          <th width="125" align="center" class="text-center">Precio Unit</th>    
                        </tr>
                       </thead>
                        <tbody >  
                          <tr>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number" v-model="exis.cantidad"   name="cantidad" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="exis.precio"  name="precio" class="form-control" required>
                              </td>          
                            </tr>
                      </tbody>
                    </table>
                       <div  class="row justify-content-center">
                          <a href="#" class="btn btn-light" @click.prevent="bajarExis()">Agregar Existencia</a>
                      </div>
                  </div>
                </div> --}}
             
                <div class="row justify-content-center">
                    <div class="col-7">
                       <h2 class="text-center font-weight-bold">AGREGAR INGRESO</h2>
                      <table class="table table-bordered table-sm">
                          <thead class="thead-dark">
                            <tr>
                              <th width="125"  align="center" class="text-center">Fecha</th>
                              <th  align="center" class="text-center">Movimiento</th>    
                              
                              {{-- <th width="75" align="center" class="text-center">Existencia Cantidad</th>    
                              <th width="125" align="center" class="text-center">Existencia Precio Unit</th>   --}}   
                            </tr>
                       </thead>
                        <tbody >  
                          <tr>
                            <td>
                              <input autocomplete="ÑÖcompletes" type="date" v-model="transaccion.fecha"  name="fecha" class="form-control" required>
                            </td>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="text"  v-model="transaccion.movimiento"  name="movimiento" class="form-control" required>
                              </td> 
                          
                             {{--   <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.existencia.cantidad"  name="precio" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.existencia.precio"  name="precio" class="form-control" required>
                              </td>              --}}     
                            </tr>
                      </tbody>
                    </table>
                    <table class="table table-bordered table-sm">
                      <thead class="thead-dark">
                        <tr>
                          <th width="75"  align="center" class="text-center">Cantidad</th>    
                          <th width="125" align="center" class="text-center">Precio Unit</th> 
                          <th width="150" align="center" class="text-center">Enviar</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number" v-model="transaccion.ingreso.cantidad"   name="cantidad" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.ingreso.precio"  name="precio" class="form-control" required>
                              </td>
                              <td>
                                  <a href="#" class="btn btn-info btn-block" @click.prevent="agregarIngreso()">Agregar Ingreso</a>
                              </td>
                        </tr>
                      </tbody>
                    </table>
                      <div class="row">
                      <a class="btn btn-sm btn-success float-left mt-3 ml-2" v-if="!modales.existencia_ingreso" href="" @click.prevent="bajarExis('mostrar')">Agregar Existencia</a>
                     {{-- <a href="#" class=" btn btn-primary btn-sm float-left mt-3 ml-2" >CALCULADORA</a> --}}

                  </div>

                       <div  class="row justify-content-center">

                      </div>
                  </div>
                  <div class="col-5" style=" height:300px; overflow-y: scroll; border: double 4px red;">
                    <div v-html="datos_transacciones"></div>
                  </div>
                </div>

                  <div v-if="modales.modal_ingreso.length > 0">

                   <h2 class="text-center font-weight-bold">ACTUALIZAR EXISTENCIAS</h2>
                       <div class="row justify-content-end mt-2 mb-2">
                    <a class="btn btn-primary mt-2" v-if="!modales.existencia_ingreso" href="" @click.prevent="agregarTransaccion('ingreso')">Agregar Transaccion</a>
                  </div>

                   <div style=" height:300px; overflow-y: scroll;">
                            <table  class="table table-bordered " >
                      <thead class="bg-warning"> 
                        <tr class="text-center">
                          <th width="30"  style="vertical-align:middle" rowspan="2">FECHA</th>
                          <th width="300"  style="vertical-align:middle" rowspan="2">MOVIMIENTOS</th>
                          <th width="150"  colspan="3">INGRESOS</th>
                          {{-- <th colspan="3">EGRESOS</th> --}}
                          <th width="150"  colspan="3">EXISTENCIA</th>
                          <th style="vertical-align:middle" rowspan="2">ELIMINAR</th>

                        </tr>
                        <tr class="text-center">
                          <td>CANT.</td>
                          <td>PREC. UNIT</td>
                          <td>TOTAL</td>
                        {{--   <td>CANT.</td>
                          <td>PREC. UNIT</td>
                          <td>TOTAL</td> --}}
                          <td>CANT</td>
                          <td>PREC. UNIT</td>
                          <td>TOTAL</td>
                        </tr>
                        </thead>
                        <tbody is="draggable" group="modales.modal_ingreso" :list="modales.modal_ingreso" tag="tbody">
                          <tr  v-for="(transa, id) in modales.modal_ingreso">
                            <td style="vertical-align:middle" v-if="transa.tipo == 'existencia'"></td>
                            <td style="vertical-align:middle" v-if="transa.tipo != 'existencia'"><input autocomplete="ÑÖcompletes" type="date"   class="form-control-sm form-control-plaintext" v-model=" transa.fecha">
                            </td>
                            <td style="vertical-align:middle" v-if="transa.tipo == 'existencia'"></td>

                          <td style="vertical-align:middle" v-if="transa.tipo != 'existencia'">
                              <textarea cols="30" rows="3" class="form-control form-control-plaintext" v-model="transa.movimiento"></textarea>
                              {{-- <input autocomplete="ÑÖcompletes" type="text"  class="form-control-sm form-control-plaintext" v-model="transa.movimiento"> --}}
                          </td>

                            <td style="vertical-align:middle" v-if="transa.tipo == 'existencia'">@{{ transa.ingreso_cantidad }}</td>
                            <td style="vertical-align:middle" v-if="transa.tipo == 'existencia'">@{{ transa.ingreso_precio }}</td>

                            <td style="vertical-align:middle" v-if="transa.tipo == 'ingreso'"><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_cantidad" @keyup.enter="actuaIng(id)"></td>
                            <td style="vertical-align:middle" v-if="transa.tipo == 'ingreso'"><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_precio" @keyup.enter="actuaIng(id)"> </td>

                            <td style="vertical-align:middle" v-if="transa.tipo == 'ingreso_venta'"><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_cantidad" @keyup.enter="totalIng(id)"></td>
                            <td style="vertical-align:middle" v-if="transa.tipo == 'ingreso_venta'"><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_precio" @keyup.enter="totalIng(id)"> </td>

                            <td style="vertical-align:middle">@{{ transa.ingreso_total }}</td>
                            {{-- <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.ingreso_total" class="form-control-sm form-control-plaintext" v-model=" transa.ingreso_total"></td> --}}
             {{--                <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.egreso_cantidad" class="form-control-sm form-control-plaintext" v-model="transa.egreso_cantidad"></td>
                            <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.egreso_precio" class="form-control-sm form-control-plaintext" v-model="transa.egreso_precio"></td> --}}
                            {{-- <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.egreso_total" class="form-control-sm form-control-plaintext" v-model=" transa.egreso_total"></td> --}}
                            {{-- <td>@{{ transa.egreso_total }}</td> --}}
                            <td style="vertical-align:middle"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_cantidad"></td>
                            <td style="vertical-align:middle"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_precio"></td>
                            {{-- <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.existencia_total" class="form-control-sm form-control-plaintext" v-model=" transa.existencia_total"></td> --}}
                            <td style="vertical-align:middle" v-if="!actuingreso.estado">@{{ transa.existencia_total }}</td>
                            <td style="vertical-align:middle" v-if="actuingreso.estado"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_total"></td>
                            <td style="vertical-align:middle"><a href="#" class="btn btn-sm btn-danger" @click.prevent="borrarIngreso(id)"> <i class="fas fa-trash"></i></a></td>
                          </tr>
                        </tbody>
                  </table>
                   </div>
           
                    <div class="row justify-content-center mt-2">
                    <a class="btn btn-primary mt-2" v-if="!modales.existencia_ingreso" href="" @click.prevent="agregarTransaccion('ingreso')">Agregar Transaccion</a>
                  </div>
                  </div>
                   <div v-if="modales.existencia_ingreso" class="row justify-content-center mt-3">
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
                          <thead class="thead-dark">
                        <tr>
                          <th align="center" class="text-center">Cantidad</th>    
                          <th align="center" class="text-center">Precio Unit</th>    
                          <th width="50" align="center" class="text-center">Cerrar Ventana</th>    
                        </tr>
                       </thead>
                        <tbody >  
                          <tr>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number" placeholder="Pulsa Enter Para Agregar" v-model="exis.cantidad"  @keyup.enter="bajarExis('agregar')" name="cantidad" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number" placeholder="Pulsa Enter Para Agregar"  v-model="exis.precio" @keyup.enter="bajarExis('agregar')" name="precio" class="form-control" required>
                              </td>  
                              <td class="text-center">
                                <a href="" class="btn btn-sm btn-info" @click.prevent="bajarExis('cerrar')"><i class="fas fa-window-close"></i></a>
                              </td>        
                            </tr>
                      </tbody>
                    </table>
                  </div>
                </div> 
                   
                </div>

              <div class="tab-pane fade" id="devolucionventa" role="tabpanel" aria-labelledby="devolucionventa-tab">
               
          {{--       <div v-if="movimientos.length > 0">
                  <h2 class="text-center">Ultimas Existencias</h2>
                <table  class="table table-bordered">
                    <thead class="bg-info"> 
                      <tr class="text-center">
                        <th style="vertical-align:middle" rowspan="2">FECHA</th>
                        <th style="vertical-align:middle" rowspan="2">MOVIMIENTOS</th>
                        <th colspan="3">INGRESOS</th>
                        <th colspan="3">EGRESOS</th>
                        <th colspan="3">EXISTENCIA</th>
                      </tr>
                      <tr class="text-center">
                        <td>CANT.</td>
                        <td>PREC. UNIT</td>
                        <td>TOTAL</td>
                        <td>CANT.</td>
                        <td>PREC. UNIT</td>
                        <td>TOTAL</td>
                        <td>CANT</td>
                        <td>PREC. UNIT</td>
                        <td>TOTAL</td>
                      </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(transa, id) in movimientos">
                          <td>@{{ transa.fecha }}</td>
                          <td>@{{ transa.movimiento }}</td>
                          <td>@{{ transa.ingreso_cantidad }}</td>
                          <td>@{{ transa.ingreso_precio }} </td>
                          <td>@{{ transa.ingreso_total }}</td>
                          <td>@{{ transa.egreso_cantidad }}</td>
                          <td>@{{ transa.egreso_precio }}</td>
                          <td>@{{ transa.egreso_total }}</td>
                          <td>@{{ transa.existencia_cantidad }}</td>
                          <td>@{{ transa.existencia_precio }}</td>
                          <td >@{{ transa.existencia_total }}</td>
                          
                        </tr>
                      </tbody>
                  </table>

                </div> --}}
                <div class="row justify-content-center">
                    <div class="col-7">
                  <h2 class="text-center font-weight-bold">DEVOLUCION</h2>

                      <table class="table table-bordered table-sm ">
                          <thead class="thead-dark">
                        <tr>
                          <th width="50"  align="center" class="text-center">Fecha</th>
                          <th  align="center" class="text-center">Movimiento</th>    
                       
                     {{--      <th width="75" align="center" class="text-center">Existencia Cantidad</th>    
                          <th width="125" align="center" class="text-center">Existencia Precio Unit</th>  --}}    
                        </tr>
                       </thead>
                        <tbody >  
                            <tr>
                            <td>
                              <input autocomplete="ÑÖcompletes" type="date" v-model="transaccion.fecha"  name="fecha" class="form-control" required>
                            </td>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="text"  v-model="transaccion.movimiento"  name="movimiento" class="form-control" required>
                              </td> 
                            
                              {{-- <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.existencia.cantidad"  name="exis_cantidad" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.existencia.precio"  name="exis_precio" class="form-control" required>
                              </td>      --}}       
                            </tr>
                      </tbody>
                    </table>
                    <table class="table table-bordered table-sm">
                      <thead class="thead-dark">
                        <tr>
                          <th width="75"  align="center" class="text-center">Cantidad</th>    
                          <th width="125" align="center" class="text-center">Precio Unit</th> 
                          <th width="150" align="center" class="text-center">Enviar</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>
                                <input autocomplete="ÑÖcompletes" type="number" v-model="transaccion.ingreso.cantidad"   name="cantidad" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.ingreso.precio"  name="precio" class="form-control" required>
                              </td>
                              <td>
                                <a href="#" class="btn btn-info btn-block" @click.prevent="agregarDevolucion()">Agregar Devolucion</a>
                              </td>
                        </tr>
                      </tbody>
                    </table>
                     <div class="row">
                  <a class="btn btn-sm btn-success float-left mt-3 ml-2" v-if="!modales.existencia_ingreso" href="" @click.prevent="existenciaVenta('mostrar')"><i class="fas fa-plus"></i>Agregar Existencia</a>
                </div>
                       <div  class="row justify-content-center">
                      </div>
                  </div>
                  <div class="col-5" style=" height:300px; overflow-y: scroll; border: double 4px red;">
                    <div v-html="datos_transacciones"></div>
                    
                  </div>
                </div>

                  <div v-if="modales.modal_devolucion_venta.length > 0">
                   <h2 class="text-center font-weight-bold">ACTUALIZAR EXISTENCIAS</h2>
                     <div class="row justify-content-end mt-2">
                    <a class="btn btn-primary mt-2 mb-2" v-if="!modales.existencia_ingreso" href="" @click.prevent="agregarTransaccion('venta')">Agregar Transaccion</a>
                  </div>
                   <div style=" height:300px; overflow-y: scroll;">

                  <table  class="table table-bordered table-responsive">
                      <thead class="bg-warning"> 
                        <tr class="text-center">
                          <th width="30" style="vertical-align:middle" rowspan="2">FECHA</th>
                          <th width="300" style="vertical-align:middle" rowspan="2">MOVIMIENTOS</th>
                         
                          <th colspan="3">INGRESOS</th>
                          
                          <th colspan="3">EXISTENCIA</th>
                          <th style="vertical-align:middle" rowspan="2">ELIMINAR</th>

                        </tr>
                        <tr class="text-center">
                          <td>CANT.</td>
                          <td>PREC. UNIT</td>
                          <td>TOTAL</td>
                          <td>CANT</td>
                          <td>PREC. UNIT</td>
                          <td>TOTAL</td>
                        </tr>
                        </thead>
                        <tbody is="draggable" group="modales.modal_devolucion_venta" :list="modales.modal_devolucion_venta" tag="tbody">
                          <tr v-for="(transa, id) in modales.modal_devolucion_venta">
                            <td v-if="transa.tipo == 'existencia'"></td>
                            <td v-if="transa.tipo != 'existencia'"><input autocomplete="ÑÖcompletes" type="date"   class="form-control-sm form-control-plaintext" v-model=" transa.fecha">
                            </td>
                            <td v-if="transa.tipo == 'existencia'"></td>

                          <td v-if="transa.tipo != 'existencia'">
                                 <textarea cols="30" rows="3" class="form-control form-control-plaintext" v-model="transa.movimiento"></textarea>
                              {{-- <input autocomplete="ÑÖcompletes" type="text"  class="form-control-sm form-control-plaintext" v-model="transa.movimiento"> --}}
                          </td>

                            <td v-if="transa.tipo == 'existencia'">@{{ transa.ingreso_cantidad }}</td>
                            <td v-if="transa.tipo == 'existencia'">@{{ transa.ingreso_precio }}</td>

                            <td v-if="transa.tipo == 'ingreso'"><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_cantidad" @keyup.enter="totalIng(id)"></td>
                            <td v-if="transa.tipo == 'ingreso'"><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_precio" @keyup.enter="totalIng(id)"> </td>

                            <td v-if="transa.tipo == 'ingreso_venta'"><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_cantidad" @keyup.enter="actuaVenta(id)"></td>
                            <td v-if="transa.tipo == 'ingreso_venta'"><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_precio" @keyup.enter="actuaVenta(id)"> </td>

                            <td>@{{ transa.ingreso_total }}</td>
                            <td><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_cantidad"></td>
                            <td><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_precio"></td>
                            {{-- <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.existencia_total" class="form-control-sm form-control-plaintext" v-model=" transa.existencia_total"></td> --}}
                            <td v-if="!actuingreso.estado">@{{ transa.existencia_total }}</td>
                            <td v-if="actuingreso.estado"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_total"></td>
                            <td><a href="#" class="btn btn-sm btn-danger" @click.prevent="borrarIngreso(id, 'venta')"> <i class="fas fa-trash"></i></a></td>
                          </tr>
                        </tbody>
                  </table>
                </div>
                    <div class="row justify-content-center mt-2">
                    <a class="btn btn-primary mt-2" v-if="!modales.existencia_ingreso" href="" @click.prevent="agregarTransaccion('venta')">Agregar Transaccion</a>
                  </div>
                  </div>
                        
          {{--       <div v-if="ejercicio.length >= 1" class="row justify-content-center">
                  <h2>Bajar Existencias</h2>
                    <div class="col-12">
                      <table class="table table-bordered table-sm">
                          <thead class="thead-dark">
                        <tr>
                          <th width="75"  align="center" class="text-center">Cantidad</th>    
                          <th width="125" align="center" class="text-center">Precio Unit</th>    
                        </tr>
                       </thead>
                        <tbody >  
                          <tr>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number" v-model="exis.cantidad"   name="cantidad" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="exis.precio"  name="precio" class="form-control" required>
                              </td>          
                            </tr>
                      </tbody>
                    </table>
                       <div  class="row justify-content-center">
                          <a href="#" class="btn btn-light" @click.prevent="existenciaVenta()">Agregar Existencia</a>
                      </div>
                  </div>
                </div> --}}


                </div>
              </div>

   
            </div>
           <div class="modal-footer">
          </div>
        </div>
    </div>
</div>


{{-- EGRESOS --}}
<div class="modal fade" id="egreso" tabindex="-1"  role="dialog" aria-labelledby="haberLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
        <div class="modal-content bg-info">
            <div class="modal-header">
                <h5 class="modal-title" id="haberLabel">AGREGAR EGRESO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active text-dark font-weight-bold" id="tablaegreso-tab" data-toggle="tab" href="#tablaegreso" role="tab" aria-controls="tablaegreso" aria-selected="true">EGRESO</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link text-dark font-weight-bold" id="devolucioncompra-tab" data-toggle="tab" href="#devolucioncompra" role="tab" aria-controls="devolucioncompra" aria-selected="false">DEVOLUCION</a>
                </li>
                    <li class="nav-item" role="presentation">
                  <a class="nav-link text-light font-weight-bold bg-dark" id="calculadora-ke-tab" data-toggle="tab" href="#calculadora-ke" role="tab" aria-controls="calculadora-ke" aria-selected="false" @click.prevent="VueSweetAlert2('example-component',{title: 'Called from basic js',
                    noteProp: [
                        'Note number 1',
                        'Note number 2'
                    ]})">CALCULADORA</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tablaegreso" role="tabpanel" aria-labelledby="tablaegreso-tab">
               

        {{--        <div v-if="movimientos.length > 0">
                  <h2 class="text-center">Ultimas Existencias</h2>
                <table  class="table table-bordered">
                    <thead class="bg-warning"> 
                      <tr class="text-center">
                        <th style="vertical-align:middle" rowspan="2">FECHA</th>
                        <th style="vertical-align:middle" rowspan="2">MOVIMIENTOS</th>
                        <th colspan="3">INGRESOS</th>
                        <th colspan="3">EGRESOS</th>
                        <th colspan="3">EXISTENCIA</th>
                      </tr>
                      <tr class="text-center">
                        <td>CANT.</td>
                        <td>PREC. UNIT</td>
                        <td>TOTAL</td>
                        <td>CANT.</td>
                        <td>PREC. UNIT</td>
                        <td>TOTAL</td>
                        <td>CANT</td>
                        <td>PREC. UNIT</td>
                        <td>TOTAL</td>
                      </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(transa, id) in movimientos">
                          <td>@{{ transa.fecha }}</td>
                          <td>@{{ transa.movimiento }}</td>
                          <td>@{{ transa.ingreso_cantidad }}</td>
                          <td>@{{ transa.ingreso_precio }} </td>
                          <td>@{{ transa.ingreso_total }}</td>
                          <td>@{{ transa.egreso_cantidad }}</td>
                          <td>@{{ transa.egreso_precio }}</td>
                          <td>@{{ transa.egreso_total }}</td>
                          <td>@{{ transa.existencia_cantidad }}</td>
                          <td>@{{ transa.existencia_precio }}</td>
                          <td >@{{ transa.existencia_total }}</td>
                          
                        </tr>
                      </tbody>
                  </table>

                </div> --}}
                <div class="row justify-content-center">

                    <div class="col-7">
              <h2 class="text-center font-weight-bold">AGREGAR EGRESO</h2>

                      <table class="table table-bordered table-sm">
                          <thead class="thead-dark">
                        <tr>
                          <th width="125"  align="center" class="text-center">Fecha</th>
                          <th  align="center" class="text-center">Movimiento</th>    
                              
                          {{-- <th width="75" align="center" class="text-center">Existencia Cantidad</th>     --}}
                          {{-- <th width="125" align="center" class="text-center">Existencia Precio Unit</th> --}}

                        </tr>
                       </thead>
                        <tbody >  
                          <tr>
                            <td>
                              <input autocomplete="ÑÖcompletes" type="date" v-model="transaccion.fecha"  name="fecha" class="form-control" required>
                            </td>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="text"  v-model="transaccion.movimiento"  name="movimiento" class="form-control" required>
                              </td> 
                        
                             {{--  <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.existencia.cantidad"  name="precio" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.existencia.precio"  name="precio" class="form-control" required>
                              </td>      --}}       
                            </tr>
                      </tbody>
                    </table>
                           <table class="table table-bordered table-sm">
                      <thead class="thead-dark">
                        <tr>
                          <th width="75"  align="center" class="text-center">Cantidad</th>    
                          <th width="125" align="center" class="text-center">Precio Unit</th> 
                          <th width="150" align="center" class="text-center">Enviar</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                               <td>
                                <input autocomplete="ÑÖcompletes" type="number" v-model="transaccion.egreso.cantidad"   name="cantidad" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.egreso.precio"  name="precio" class="form-control" required>
                              </td>
                              <td>
                          <a href="#" class="btn btn-light btn-block" @click.prevent="agregarEgreso()">Agregar Egreso</a>
                                
                              </td>
                        </tr>
                      </tbody>
                    </table>
                <div class="row">
              <a class="btn btn-sm btn-success float-left mt-3 ml-2" v-if="!modales.existencia_ingreso" href="" @click.prevent="existenciaEgreso()"><i class="fas fa-plus"></i> Existencia</a>
         {{--  <a v-if="transaccion.egreso.active" class="btn btn-sm btn-success float-left mt-3 ml-2" v-if="!modales.existencia_ingreso" href="" @click.prevent="nuevoEgreso('agregar')"><i class="fas fa-plus"></i> Nuevo Egreso</a> --}}
                </div>
              </div>
              <div class="col-5" style=" height:300px; overflow-y: scroll; border: double 4px red;">
                    <div v-html="datos_transacciones"></div>
                
              </div>
     {{--    <div v-if="transaccion.egreso.add" class="row justify-content-center mt-2">
          <div class="col-2"><input autocomplete="ÑÖcompletes" type="number" placeholder="cantidad" v-model="edit.egreso.cantidad" class="form-control"></div>
          <div class="col-2"><input autocomplete="ÑÖcompletes" type="number" placeholder="precio" v-model="edit.egreso.precio" class="form-control"></div>
          <div class="col-2"><a href="" @click.prevent="nuevoEgreso('crear')" class="btn btn-success">EGRESO</a> <a href="" @click.prevent="nuevoEgreso('cerrar')" class="btn btn-danger"><i class="fas fa-window-close"></i></a> </div>
        </div> --}}
                    
          <div class="col-12">
                    <div v-if="modales.modal_egreso.length > 0">
                                  <h2 class="text-center font-weight-bold">ACTUALIZAR EXISTENCIAS</h2>
                                     <div class="row justify-content-end mb-2">
                    <a class="btn btn-sm btn-primary mr-2" href="" @click.prevent="agregarEgresos()">Agregar Transaccion</a>



                    </div>
                   <div style=" height:300px; overflow-y: scroll;">

                    <table  class="table table-bordered table-responsive">
                        <thead class="bg-warning"> 
                          <tr class="text-center">
                            <th width="30" style="vertical-align:middle" rowspan="2">FECHA</th>
                          <th width="300" style="vertical-align:middle" rowspan="2">MOVIMIENTOS</th>
                            
                            
                            <th colspan="3">EGRESOS</th>
                            <th colspan="3">EXISTENCIA</th>
                            <th style="vertical-align:middle" rowspan="2">ELIMINAR</th>
                          </tr>
                          <tr class="text-center">
                           
                            <td>CANT.</td>
                            <td>PREC. UNIT</td>
                            <td>TOTAL</td>
                            <td>CANT</td>
                            <td>PREC. UNIT</td>
                            <td>TOTAL</td>
                          </tr>
                          </thead>
                          <tbody is="draggable" group="modales.modal_egreso" :list="modales.modal_egreso" tag="tbody">
                            <tr v-for="(transa, id) in modales.modal_egreso">
                                   <td v-if="transa.tipo == 'existencia'"></td>
                            <td v-if="transa.tipo != 'existencia'"><input autocomplete="ÑÖcompletes" v-if="id == 0" type="date"   class="form-control-sm form-control-plaintext" v-model=" transa.fecha">
                            </td>
                            <td v-if="transa.tipo == 'existencia'"></td>

                          <td v-if="transa.tipo != 'existencia'">
                                <textarea cols="30" rows="3" class="form-control form-control-plaintext" v-model="transa.movimiento"></textarea>
                              {{-- <input autocomplete="ÑÖcompletes" type="text"  class="form-control-sm form-control-plaintext" v-model="transa.movimiento"> --}}
                          </td>
                          
                              <td><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.egreso_cantidad" @keyup.enter="actualEgre(id)"></td>
                              <td><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.egreso_precio" @keyup.enter="actualEgre(id)"></td>
                              {{-- <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.egreso_total" class="form-control-sm form-control-plaintext" v-model=" transa.egreso_total"></td> --}}
                              <td>@{{ transa.egreso_total }}</td>
                              <td><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_cantidad"></td>
                              <td><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_precio"></td>
                              {{-- <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.existencia_total" class="form-control-sm form-control-plaintext" v-model=" transa.existencia_total"></td> --}}
                              <td v-if="!actuegreso.estado">@{{ transa.existencia_total }}</td>
                              <td v-if="actuegreso.estado"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_total"></td>
                              <td><a href="#" class="btn btn-sm btn-danger" @click.prevent="borrarEgreso(id)"> <i class="fas fa-trash"></i></a></td>
                            </tr>
                          </tbody>
                    </table>
</div>
                    <div class="row justify-content-center">
                    <a class="btn btn-sm btn-primary mr-2" href="" @click.prevent="agregarEgresos()">Agregar Transaccion</a>



                    </div>

                    </div>

        {{--             <div v-if="egresos.length >= 1">
                       <h2>Agregar Existencias</h2>
                    <table  class="table table-bordered table-sm">
                          <thead class="thead-dark">
                        <tr>
                          <th width="75"  align="center" class="text-center">Cantidad</th>    
                          <th width="125" align="center" class="text-center">Precio Unit</th>    
                        </tr>
                       </thead>
                        <tbody >  
                          <tr>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number" v-model="exis.cantidad"   name="cantidad" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="exis.precio"  name="precio" class="form-control" required>
                              </td>          
                            </tr>
                      </tbody>
                    </table>

                    <div  class="row justify-content-center">
                          <a href="#" class="btn btn-light" @click.prevent="existenciaEgreso()">Agregar Existencia</a>
                      </div>
                    </div> --}}
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="devolucioncompra" role="tabpanel" aria-labelledby="devolucioncompra-tab">
                
{{--                 <div v-if="movimientos.length > 0">
                  <h2 class="text-center">Ultimas Existencias</h2>
                <table  class="table table-bordered">
                    <thead class="bg-warning"> 
                      <tr class="text-center">
                        <th style="vertical-align:middle" rowspan="2">FECHA</th>
                        <th style="vertical-align:middle" rowspan="2">MOVIMIENTOS</th>
                        <th colspan="3">INGRESOS</th>
                        <th colspan="3">EGRESOS</th>
                        <th colspan="3">EXISTENCIA</th>
                      </tr>
                      <tr class="text-center">
                        <td>CANT.</td>
                        <td>PREC. UNIT</td>
                        <td>TOTAL</td>
                        <td>CANT.</td>
                        <td>PREC. UNIT</td>
                        <td>TOTAL</td>
                        <td>CANT</td>
                        <td>PREC. UNIT</td>
                        <td>TOTAL</td>
                      </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(transa, id) in movimientos">
                          <td>@{{ transa.fecha }}</td>
                          <td>@{{ transa.movimiento }}</td>
                          <td>@{{ transa.ingreso_cantidad }}</td>
                          <td>@{{ transa.ingreso_precio }} </td>
                          <td>@{{ transa.ingreso_total }}</td>
                          <td>@{{ transa.egreso_cantidad }}</td>
                          <td>@{{ transa.egreso_precio }}</td>
                          <td>@{{ transa.egreso_total }}</td>
                          <td>@{{ transa.existencia_cantidad }}</td>
                          <td>@{{ transa.existencia_precio }}</td>
                          <td >@{{ transa.existencia_total }}</td>
                          
                        </tr>
                      </tbody>
                  </table>

                </div> --}}
                <div class="row justify-content-center mt-3">
                  <div class="col-7">
                  <h2 class="font-weight-bold text-center">DEVOLUCION</h2>
                      <table class="table table-bordered table-sm">
                          <thead class="thead-dark">
                        <tr>
                          <th width="50"  align="center" class="text-center">Fecha</th>
                          <th  align="center" class="text-center">Movimiento</th>    
                         
                       {{--    <th width="75" align="center" class="text-center">Existencia Cantidad</th>    
                          <th width="125" align="center" class="text-center">Existencia Precio Unit</th>  --}}   
                        </tr>
                       </thead>
                        <tbody >  
                          <tr>
                            <td>
                              <input autocomplete="ÑÖcompletes" type="date" v-model="transaccion.fecha"  name="fecha" class="form-control" required>
                            </td>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="text"  v-model="transaccion.movimiento"  name="movimiento" class="form-control" required>
                              </td> 
                            
                              {{-- <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.existencia.cantidad"  name="precio" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.existencia.precio"  name="precio" class="form-control" required>
                              </td>     --}}        
                            </tr>
                      </tbody>
                    </table>
                    </table>
                    <table class="table table-bordered table-sm">
                      <thead class="thead-dark">
                        <tr>
                          <th width="75"  align="center" class="text-center">Cantidad</th>    
                          <th width="125" align="center" class="text-center">Precio Unit</th> 
                          <th width="150" align="center" class="text-center">Enviar</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>
                                <input autocomplete="ÑÖcompletes" type="number" v-model="transaccion.egreso.cantidad"   name="cantidad" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.egreso.precio"  name="precio" class="form-control" required>
                              </td>
                              <td>
                              <a href="#" class="btn btn-light btn-block" @click.prevent="agregarEgreso('compra')">Agregar Devolucion</a>
                                
                              </td>
                        </tr>
                      </tbody>
                    </table>

                <div class="row">
                  <a class="btn btn-sm btn-success float-left mt-3 ml-2" v-if="!modales.existencia_ingreso" href="" @click.prevent="existenciaEgreso('compra')">Agregar Existencia</a>
                </div>
              </div>
              <div class="col-5" style=" height:300px; overflow-y: scroll; border: double 4px red;">
                    <div v-html="datos_transacciones"></div>
                
              </div>
                      

              <div v-if="modales.modal_devolucion_compra.length > 0">
                <h2 class="text-center font-weight-bold">ACTUALIZAR EXISTENCIAS</h2>
                  <div class="row justify-content-end mb-2">
              <a class="btn btn-sm btn-primary mr-2" href="" @click.prevent="agregarDevolucionCompra()">Agregar Transaccion</a>
              </div>
                   <div style=" height:300px; overflow-y: scroll;">

              <table  class="table table-bordered table-responsive">
                  <thead class="bg-warning"> 
                    <tr class="text-center">
                      <th width="30" style="vertical-align:middle" rowspan="2">FECHA</th>
                      <th width="300" style="vertical-align:middle" rowspan="2">MOVIMIENTOS</th>
                      <th colspan="3">EGRESOS</th>
                      <th colspan="3">EXISTENCIA</th>
                      <th style="vertical-align:middle" rowspan="2">ELIMINAR</th>
                    </tr>
                    <tr class="text-center">
                  
                      <td>CANT.</td>
                      <td>PREC. UNIT</td>
                      <td>TOTAL</td>
                      <td>CANT</td>
                      <td>PREC. UNIT</td>
                      <td>TOTAL</td>
                    </tr>
                    </thead>
                    <tbody is="draggable" group="modales.modal_devolucion_compra" :list="modales.modal_devolucion_compra" tag="tbody">
                      <tr v-for="(transa, id) in modales.modal_devolucion_compra">
                             <td v-if="transa.tipo == 'existencia'"></td>
                            <td v-if="transa.tipo != 'existencia'"><input autocomplete="ÑÖcompletes" type="date"   class="form-control-sm form-control-plaintext" v-model=" transa.fecha">
                            </td>
                            <td v-if="transa.tipo == 'existencia'"></td>

                          <td v-if="transa.tipo != 'existencia'">
                               <textarea cols="30" rows="3" class="form-control form-control-plaintext" v-model="transa.movimiento"></textarea>
                              {{-- <input autocomplete="ÑÖcompletes" type="text"  class="form-control-sm form-control-plaintext" v-model="transa.movimiento"> --}}
                          </td>
                
                        <td><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.egreso_cantidad" @keyup.enter="actualEgre(id, 'devolucion_compra')"></td>
                        <td><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.egreso_precio" @keyup.enter="actualEgre(id, 'devolucion_compra')"></td>
                        {{-- <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.egreso_total" class="form-control-sm form-control-plaintext" v-model=" transa.egreso_total"></td> --}}
                        <td>@{{ transa.egreso_total }}</td>
                        <td><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_cantidad"></td>
                        <td><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_precio"></td>
                        {{-- <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.existencia_total" class="form-control-sm form-control-plaintext" v-model=" transa.existencia_total"></td> --}}
                        <td v-if="!actuegreso.estado">@{{ transa.existencia_total }}</td>
                        <td v-if="actuegreso.estado"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_total"></td>
                        <td><a href="#" class="btn btn-sm btn-danger" @click.prevent="borrarEgreso(id,'egreso_compra')"> <i class="fas fa-trash"></i></a></td>
                      </tr>
                    </tbody>
              </table>
            </div>
              <div class="row justify-content-center">
              <a class="btn btn-sm btn-primary mr-2" href="" @click.prevent="agregarDevolucionCompra()">Agregar Transaccion</a>
              </div>
              </div>

  {{--                   <div class="col-12">
                      <div >
                       <h2>Agregar Existencias</h2>
                        <table  class="table table-bordered table-sm">
                          <thead class="thead-dark">
                        <tr>
                          <th width="75"  align="center" class="text-center">Cantidad</th>    
                          <th width="125" align="center" class="text-center">Precio Unit</th>    
                        </tr>
                       </thead>
                        <tbody >  
                          <tr>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number" v-model="exis.cantidad"   name="cantidad" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="exis.precio"  name="precio" class="form-control" required>
                              </td>          
                            </tr>
                      </tbody>
                    </table>
                    <div  class="row justify-content-center">
                          <a href="#" class="btn btn-light" @click.prevent="existenciaEgreso()">Agregar Existencia</a>
                      </div>
                    </div>
   
          
                  </div> --}}
                </div>
              </div>
            </div>
            </div>

           <div class="modal-footer">
          </div>
        </div>
    </div>
</div>


{{--SALDO INICIAL --}}
<div class="modal fade" id="saldo_inicial" tabindex="-1"  role="dialog" aria-labelledby="saldo_inicialLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h5 class="modal-title" id="saldo_inicialLabel">SALDO INICIAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="cerrarInicial()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                  <div class="col-7">
                  <h2 class="text-center font-weight-bold">AGREGAR SALDO INICIAL</h2>

                      <table class="table table-bordered table-sm ">
                          <thead class="thead-dark">
                        <tr>
                          <th width="50"  align="center" class="text-center">Fecha</th>
                          <th  align="center" class="text-center">Movimiento</th>    
                        </tr>
                       </thead>
                        <tbody >  
                            <tr>
                            <td>
                              <input autocomplete="ÑÖcompletes" type="date" v-model="inicial.fecha"  name="fecha" class="form-control" required>
                            </td>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="text"  v-model="inicial.movimiento"  name="movimiento" class="form-control" required>
                              </td>     
                            </tr>
                      </tbody>
                    </table>
                    <table class="table table-bordered table-sm">
                      <thead class="thead-dark">
                        <tr>
                          <th width="75"  align="center" class="text-center">Cantidad</th>    
                          <th width="125" align="center" class="text-center">Precio Unit</th> 
                          <th width="150" align="center" class="text-center">Enviar</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>
                                <input autocomplete="ÑÖcompletes" type="number" v-model="inicial.cantidad"   name="cantidad" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="inicial.precio"  name="precio" class="form-control" required>
                              </td>
                              <td>           
                    <a v-if="!update" href="#" class="addDiario btn btn-info btn-block " @click.prevent="agregarTran()">Agregar Registro</a>
                    <a v-if="update" href="#" class="addDiario btn btn-info btn-block " @click.prevent="actualizarInicial()">Actualizar Registro</a>
                              </td>
                        </tr>
                      </tbody>
                    </table>
                     <div class="row">
                
                </div>
                       <div  class="row justify-content-center">
                      </div>
                  </div>
                  <div class="col-5" style=" height:250px; overflow-y: scroll; border: solid 3px red;">
                    <div v-html="datos_transacciones"></div>
                    
                  </div>
                </div>
{{--                 <div  class="form-row mb-2 justify-content-center">
                    <div class="col-3">
                      <input autocomplete="ÑÖcompletes" type="date" class="form-control" v-model="inicial.fecha" placeholder="Debe">
                    </div>
                    <div class="col-5">
                      <input autocomplete="ÑÖcompletes" type="text" class="form-control" v-model="inicial.movimiento" placeholder="Movimiento">
                    </div>
                     <div class="col">
                      <input autocomplete="ÑÖcompletes" type="number" class="form-control" v-model="inicial.cantidad"  placeholder="Cant.">
                    </div>
                     <div class="col">
                      <input autocomplete="ÑÖcompletes" type="number" class="form-control" v-model="inicial.precio"  placeholder="Prec.">
                    </div>

                    <a v-if="!update" href="#" class="addDiario btn btn-outline-danger " @click.prevent="agregarTran()">Agregar Registro</a>
                    <a v-if="update" href="#" class="addDiario btn btn-outline-danger " @click.prevent="actualizarInicial()">Actualizar Registro</a>
              </div> --}}
            </div>
           <div class="modal-footer">
          </div>
        </div>
    </div>
</div>


