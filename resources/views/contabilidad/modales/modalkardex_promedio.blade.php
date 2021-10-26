{{-- SALDO INICIAL --}}
<div class="modal fade" id="inicial" tabindex="-1"  role="dialog" aria-labelledby="saldo_inicialLabel" aria-hidden="true">
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
                    <a v-if="!update" href="#" class="addDiario btn btn-info btn-block " @click.prevent="agregarInicial()">Agregar Registro</a>
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
                  <div class="col-5 p-3" style=" height:250px; overflow-y: scroll; border: solid 3px red;">
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
               
                    <a v-if="!update" href="#" class="addDiario btn btn-outline-danger " @click.prevent="agregarInicial()">Agregar Registro</a>
                    <a v-if="update" href="#" class="addDiario btn btn-outline-danger " @click.prevent="actualizarInicial()">Actualizar Registro</a>
              </div> --}}
            </div>
           <div class="modal-footer">
          </div>
        </div>
    </div>
</div>


{{-- INGRESOS --}}
<div class="modal fade" id="ingreso-kardex" tabindex="-1"  role="dialog" aria-labelledby="ingresoLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title" id="ingresoLabel">AGREGAR TRANSACCION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active text-dark font-weight-bold" id="kardex-promedio-ingreso-tab" data-toggle="tab" href="#kardex-promedio-ingreso" role="tab" aria-controls="kardex-promedio-ingreso" aria-selected="true">INGRESO</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link text-dark font-weight-bold" id="kardex-promedio-egreso-tab" data-toggle="tab" href="#kardex-promedio-egreso" role="tab" aria-controls="kardex-promedio-egreso" aria-selected="false">EGRESO</a>
                </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link btn btn-dark mb-2" href="" @click.prevent="calculadora()">CALCULADORA</a>
                  
                </li>
              </ul>

              <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active " id="kardex-promedio-ingreso" role="tabpanel" aria-labelledby="kardex-promedio-ingreso-tab">
            <div v-if="ultima_existencia.length > 0">
              <h2 class="text-center font-weight-bold">ULTIMA EXISTENCIA</h2>
              <table class="table table-bordered">
                <thead class="bg-info">
                  <tr>
                    <th>Existencia Cantidad</th>
                    <th>Existencia Precio</th>
                    <th>Existencia Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="existencia in ultima_existencia">
                    <td>@{{ existencia.existencia_cantidad }}</td>
                    <td>@{{ existencia.existencia_precio }}</td>
                    <td>@{{ existencia.existencia_total }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            
              <h2 class="text-center font-weight-bold">AGREGAR INGRESO</h2>
{{-- 
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Fecha</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.ingreso.fecha" type="date"  class="form-control" id="fecha-ingreso-promedio">
                  </div>
                  <div class="form-group col-md-8">
                    <label for="inputPassword4">Movimiento</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.ingreso.movimiento" type="text" class="form-control" id="movimiento-ingreso-promedio">
                  </div>
                </div>
                <div class="form-row ">
                  <div class="form-group col-3">
                    <label for="inputCity">Ingreso Cantidad</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.ingreso.cantidad" type="text" class="form-control" >
                  </div>
                  <div class="form-group col-3">
                    <label for="inputState">Ingreso Precio</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.ingreso.precio" type="text" class="form-control" >
                  </div>
                  <div class="form-group col-3">
                    <label for="inputZip">Calcular</label>
                    <a href="" class="btn btn-danger btn-block" @click.prevent="calcularTotalIngreso()">Calcular Total</a>
                  </div>
                  <div class="form-group col-3">
                    <label for="inputZip">Ingreso Total</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.ingreso.total" type="text" readonly class="form-control">
                  </div>
               
                </div>
                <div class="form-row justify-content-center">
                  <div class="form-group col-md-3">
                    <label for="inputCity">Existencia Cantidad</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.existencia.cantidad" type="text" class="form-control" >
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputState">Existencia Precio</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.existencia.precio" type="text" class="form-control" >
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputZip">Existencia Total</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.existencia.total" type="text" class="form-control">
                  </div>
                </div>
                <div class="row justify-content-center">
                  <a v-if="!transaccion.ingreso.edit" class="btn btn-primary" @click.prevent="agregarIngreso()">Agregar Ingreso</a>
                  <a v-if="transaccion.ingreso.edit" class="btn btn-primary" @click.prevent="agregarIngreso()">Actualizar Ingreso</a>
                </div> --}}
                <div class="row justify-content-center">
                    <div class="col-7">
                      <table class="table table-bordered table-sm">
                          <thead class="thead-dark">
                        <tr>
                          <th width="125"  align="center" class="text-center">Fecha</th>
                          <th  align="center" class="text-center">Movimiento</th>    
                         {{--  <th width="75" align="center" class="text-center">Existencia Cantidad</th>    
                          <th width="125" align="center" class="text-center">Existencia Precio Unit</th>      --}}
                        </tr>
                       </thead>
                        <tbody >  
                          <tr>
                            <td>
                              <input autocomplete="ÑÖcompletes" type="date" v-model="transaccion.ingreso.fecha"  name="fecha" class="form-control" required>
                            </td>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="text"  v-model="transaccion.ingreso.movimiento"  name="movimiento" class="form-control" required>
                              </td> 
                       
                              {{--  <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.existencia.cantidad"  name="precio" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.existencia.precio"  name="precio" class="form-control" required>
                              </td>         --}}          
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
                                <a href="#" class="btn btn-light btn-block" @click.prevent="calcularTotalIngreso()">Agregar Ingreso</a>
                            </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                   <div class="col-5 p-3" style=" height:250px; overflow-y: scroll; border: solid 3px red;">
                    <div v-html="datos_transacciones"></div>
                  </div>
                </div>

              <div v-if="modales.modal_ingreso.length > 0">
                   <h2 class="text-center font-weight-bold">ACTUALIZAR EXISTENCIAS</h2>

                  <table  class="table table-bordered table-responsive">
                      <thead class="bg-warning"> 
                        <tr class="text-center">
                          <th style="vertical-align:middle" rowspan="2">FECHA</th>
                          <th width="300" style="vertical-align:middle" rowspan="2">MOVIMIENTOS</th>
                          <th colspan="3">INGRESOS</th>
                          <th colspan="3">EGRESOS</th>
                          <th colspan="3">EXISTENCIA</th>
                          {{-- <th style="vertical-align:middle" rowspan="2">ELIMINAR</th> --}}

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
                          <tr v-for="(transa, id) in modales.modal_ingreso">
                         <td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="date"   class="form-control-sm form-control-plaintext" v-model=" transa.fecha"></td>
                          <td style="vertical-align:middle" >
                               <textarea cols="30" rows="3" class="form-control form-control-plaintext" v-model="transa.movimiento"></textarea>
                              {{-- <input autocomplete="ÑÖcompletes" type="text"  class="form-control-sm form-control-plaintext" v-model="transa.movimiento"> --}}
                          </td>
                        {{--     <td v-if="transa.tipo == 'existencia'">@{{ transa.ingreso_cantidad }}</td>
                            <td v-if="transa.tipo == 'existencia'">@{{ transa.ingreso_precio }}</td> --}}
                            <td style="vertical-align:middle"  ><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_cantidad" @keyup.enter="actuaIng(id)"></td>
                            <td style="vertical-align:middle"  ><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_precio" @keyup.enter="actuaIng(id)"> </td>
                            <td style="vertical-align:middle" >@{{ transa.ingreso_total }}</td>
                            {{-- <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.ingreso_total" class="form-control-sm form-control-plaintext" v-model=" transa.ingreso_total"></td> --}}
                            <td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="number" v-if="transa.egreso_cantidad" class="form-control-sm form-control-plaintext" v-model="transa.egreso_cantidad"></td>
                            <td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="number" v-if="transa.egreso_precio" class="form-control-sm form-control-plaintext" v-model="transa.egreso_precio"></td>
                            {{-- <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.egreso_total" class="form-control-sm form-control-plaintext" v-model=" transa.egreso_total"></td> --}}
                            <td style="vertical-align:middle" >@{{ transa.egreso_total }}</td>
                            <td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_cantidad"></td>
                            <td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_precio"></td>
                            {{-- <td><input autocomplete="ÑÖcompletes" type="number" v-if="transa.existencia_total" class="form-control-sm form-control-plaintext" v-model=" transa.existencia_total"></td> --}}
                            <td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_total"></td>
                            {{-- <td><a href="#" class="btn btn-sm btn-danger" @click.prevent="borrarIngreso(id)"> <i class="fas fa-trash"></i></a></td> --}}
                          </tr>
                        </tbody>
                  </table>
                    <div class="row justify-content-center mt-2">
                      <a class="btn btn-primary mt-2" {{-- v-if="!modales.existencia_ingreso" --}} href="" @click.prevent="agregarIngreso()">Agregar Transaccion</a>
                  </div>
                  </div>

                </div>

              <div class="tab-pane fade" id="kardex-promedio-egreso" role="tabpanel" aria-labelledby="kardex-promedio-egreso-tab">
            <div v-if="ultima_existencia.length > 0">
              <h2 class="text-center font-weight-bold">ULTIMA EXISTENCIA</h2>
              <table class="table table-bordered">
                <thead class="bg-info">
                  <tr>
                    <th>Existencia Cantidad</th>
                    <th>Existencia Precio</th>
                    <th>Existencia Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="existencia in ultima_existencia">
                    <td>@{{ existencia.existencia_cantidad }}</td>
                    <td>@{{ existencia.existencia_precio }}</td>
                    <td>@{{ existencia.existencia_total }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
                  <h2 class="text-center font-weight-bold">EGRESO</h2>
  {{--                  <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Fecha</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.egreso.fecha" type="date" class="form-control" >
                  </div>
                  <div class="form-group col-md-8">
                    <label for="inputPassword4">Movimiento</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.egreso.movimiento" type="text" class="form-control" >
                  </div>
                </div>
                <div class="form-row ">
                  <div class="form-group col-3">
                    <label for="inputCity">Egreso Cantidad</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.egreso.cantidad" type="number" class="form-control" >
                  </div>
                  <div class="form-group col-3">
                    <label for="inputState">Egreso Precio</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.egreso.precio" type="number" class="form-control" >
                  </div>
                  <div class="form-group col-3">
                    <label for="inputZip">Calcular</label>
                    <a href="" class="btn btn-info btn-block" @click.prevent="calcularTotalEgreso()">Calcular Total</a>
                  </div>
                  <div class="form-group col-3">
                    <label for="inputZip">Egreso Total</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.egreso.total" type="number" readonly class="form-control">
                  </div>
               
                </div>
                <div class="form-row justify-content-center">
                  <div class="form-group col-md-3">
                    <label for="inputCity">Existencia Cantidad</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.existencia.cantidad" type="number" class="form-control" >
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputState">Existencia Precio</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.existencia.precio" type="number" class="form-control" >
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputZip">Existencia Total</label>
                    <input autocomplete="ÑÖcompletes" v-model="transaccion.existencia.total" type="number" class="form-control" >
                  </div>
                </div>
                <div class="row justify-content-center">
                  <a v-if="!transaccion.egreso.edit" class="btn btn-success" @click.prevent="agregarEgreso()">Agregar Egreso</a>
                  <a v-if="!transaccion.egreso.edit" class="btn btn-success" @click.prevent="agregarEgreso()">Actualizar Egreso</a>
                </div> --}}
                <div class="row justify-content-center">
                    <div class="col-7">
                      <table class="table table-bordered table-sm ">
                          <thead class="thead-dark">
                        <tr>
                          <th width="125"  align="center" class="text-center">Fecha</th>
                          <th  align="center" class="text-center">Movimiento</th>    
                   {{--   <th width="75" align="center" class="text-center">Existencia Cantidad</th>    
                          <th width="125" align="center" class="text-center">Existencia Precio Unit</th>  --}}    
                        </tr>
                       </thead>
                        <tbody >  
                            <tr>
                            <td>
                              <input autocomplete="ÑÖcompletes" type="date" v-model="transaccion.egreso.fecha"  name="fecha" class="form-control" required>
                            </td>
                              <td>
                                <input autocomplete="ÑÖcompletes" type="text"  v-model="transaccion.egreso.movimiento"  name="movimiento" class="form-control" required>
                              </td> 
                        
                             {{--  <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.existencia.cantidad"  name="exis_cantidad" class="form-control" required>
                              </td>  
                              <td>
                                <input autocomplete="ÑÖcompletes" type="number"  v-model="transaccion.existencia.precio"  name="exis_precio" class="form-control" required>
                              </td>          --}}   
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
                                <a href="#" class="btn btn-light btn-block" @click.prevent="calcularTotalEgreso()">Agregar Egreso</a>
                              </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                   <div class="col-5 p-3" style=" height:250px; overflow-y: scroll; border: solid 3px red;">
                    <div v-html="datos_transacciones"></div>
                  </div>
                </div>

                  <div v-if="modales.modal_egreso.length > 0">
                        <h2 class="text-center font-weight-bold">ACTUALIZAR EXISTENCIAS</h2>

                    <table  class="table table-bordered table-responsive">
                        <thead class="bg-warning"> 
                          <tr class="text-center">
                            <th style="vertical-align:middle" rowspan="2">FECHA</th>
                            <th width="300" style="vertical-align:middle" rowspan="2">MOVIMIENTOS</th>
                            <th colspan="3">INGRESOS</th>
                            <th colspan="3">EGRESOS</th>
                            <th colspan="3">EXISTENCIA</th>
                            {{-- <th style="vertical-align:middle" rowspan="2">ELIMINAR</th> --}}
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
                          <tbody is="draggable" group="modales.modal_egreso" :list="modales.modal_egreso" tag="tbody">
                            <tr v-for="(transa, id) in modales.modal_egreso">
                          <td style="vertical-align:middle"><input autocomplete="ÑÖcompletes" type="date"   class="form-control-sm form-control-plaintext" v-model=" transa.fecha"></td>
                          <td style="vertical-align:middle">
                               <textarea cols="30" rows="3" class="form-control form-control-plaintext" v-model="transa.movimiento"></textarea>
                              {{-- <input autocomplete="ÑÖcompletes" type="text"  class="form-control-sm form-control-plaintext" v-model="transa.movimiento"> --}}
                          </td>
                              <td style="vertical-align:middle"><input autocomplete="ÑÖcompletes" type="number"  v-if="transa.ingreso_cantidad" class="form-control-sm form-control-plaintext" v-model="transa.ingreso_cantidad" ></td>
                              <td style="vertical-align:middle"><input autocomplete="ÑÖcompletes" type="number" v-if="transa.ingreso_precio"  class="form-control-sm form-control-plaintext" v-model="transa.ingreso_precio" > </td>
                              <td style="vertical-align:middle">@{{ transa.ingreso_total }}</td>
                              <td style="vertical-align:middle"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.egreso_cantidad" @keyup.enter="actualEgre(id)"></td>
                              <td style="vertical-align:middle"><input autocomplete="ÑÖcompletes" type="number"  class="form-control-sm form-control-plaintext" v-model="transa.egreso_precio" @keyup.enter="actualEgre(id)"></td>
                              <td style="vertical-align:middle">@{{ transa.egreso_total }}</td>
                              <td style="vertical-align:middle"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_cantidad"></td>
                              <td style="vertical-align:middle"><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_precio"></td>
                              {{-- <td v-if="!actuegreso.estado">@{{ transa.existencia_total }}</td> --}}
                              <td style="vertical-align:middle" ><input autocomplete="ÑÖcompletes" type="number" class="form-control-sm form-control-plaintext" v-model="transa.existencia_total"></td>
                              {{-- <td><a href="#" class="btn btn-sm btn-danger" @click.prevent="borrarEgreso(id)"> <i class="fas fa-trash"></i></a></td> --}}
                            </tr>
                          </tbody>
                    </table>

                    <div class="row justify-content-center">
                    <a class="btn btn-sm btn-primary mr-2" href="" @click.prevent="agregarEgreso()">Agregar Transaccion</a>



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

