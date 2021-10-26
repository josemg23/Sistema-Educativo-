<!-- CHEQUE -->
<div class="modal fade" id="m_cheque" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="m_chequeLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-xl ">
    <div class="modal-content bg-light">
      <div class="modal-header">
        <h5 class="modal-title" id="m_chequeLabel">CHEQUE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="resetCheque()">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="text-center font-weight-bold">LLENAR CHEQUE</h3>
              <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">FECHA DE LA TRANSACCION</label>
          <div class="col-sm-4">
            <input type="date" class="form-control mb-2" placeholder="Modulo al que pertenece el cheque" v-model="modulo">
            
          </div>
        </div>
        <div class=" border p-2" style="box-shadow: 5px 5px 15px 0px  #27B8F4">
          <div class="row ">
            <div class="col-6 mb-2">
              {{-- <input type="text" v-model="cheque.tipo_cheque" class="form-control mt-2" > --}}
              <input type="text" v-model="cheque.banco" class="form-control mt-2" >
            </div>
            <div class="col-2 align-self-center">
              <p>16457 <br>
                152
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-2">
              <label class="text-capitalize"  for="">PAGUESE A LA ORDEN DE:</label>
              
            </div>
            <div class="col-8">
              <input type="text" v-model="cheque.girador" class="form-control" >
            </div>
            <div class="col-2">
              <label for="">
                CHEQUE <input type="number" v-model="cheque.n_cheque" size="1" class="form-control form-control-sm text-right" name="">
              </label><br>
              <div class="row">
                <div class="col-2"><label for="">
                  US
                </label></div>
                <div class="col-8"><input type="number" name="cantidad" v-model="cheque.cantidad" class="form-control text-right" size="2" ></div>
              </div>
              
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-2">
              <label for="">LA SUMA DE</label>
            </div>
            <div class="col-8">
              <input type="text" v-model="cheque.cantidad_letra" class="form-control" >
            </div>
            <div class="col-2">
              DOLARES
            </div>
          </div>
          <div class="row">
            <div class="col-6 align-self-start pb-5">
              <div class="row">
                <div class="col-6"><input name="lugar" v-model="cheque.ciudad" class="form-control" type="text" ></div>
                <div class="col-6"><input name="fecha" v-model="cheque.fecha" class="form-control" type="date" ></div>
              </div>
              <div class="row">
                <div class="col-6"> <label for="">CIUDAD</label> </div>
                <div class="col-6 text-center"> <label for="">FECHA</label> </div>
              </div>
            </div>
            <div class="col-6 col align-self-end text-center">
              <input name="firma" v-model="cheque.firma" class="form-control" type="text" >
              <label class="" for="">FIRMA</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button v-if="!cheque.update" type="button" :disabled="!show" class="btn btn-primary" @click.prevent="guardarCheque()"><span class="spinner-border spinner-border-sm" role="status" v-if="!show" aria-hidden="true"></span>Guardar Cheque</button>
        <button v-if="cheque.update" type="button" class="btn btn-info" @click.prevent="updateCheque()">Actualizar Cheque</button>
      </div>
    </div>
  </div>
</div>
<!-- LETRA DE CAMBIO -->
<div class="modal fade" id="m_letra_cambio" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="m_letra_cambioLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-xl ">
    <div class="modal-content bg-light">
      <div class="modal-header">
        <h5 class="modal-title" id="m_letra_cambioLabel">LETRA DE CAMBIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="resetLetra()">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="text-center font-weight-bold">LLENAR LETRA DE CAMBIO</h3>
             <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">FECHA DE LA TRANSACCION</label>
          <div class="col-sm-4">
            <input type="date" class="form-control mb-2" placeholder="Modulo al que pertenece el cheque" v-model="modulo">
            
          </div>
        </div>
        <div class=" p-3" style="box-shadow: 5px 5px 15px 0px  #3A27F4">
          <div class="row mb-2">
            <div class="col-5 mt-3">
              <h2>LETRA DE CAMBIO</h2>
            </div>
            <div class="col-7 align-self-center">
              <div class="row mb-2">
                <div class="col-3 text-right"><label for="" class="col-form-label">Vence el:</label></div>
                <div class="col-8">
                  <input type="date" v-model="letra_cambio.vencimiento" class="form-control text-center" >
                </div>
              </div>
              <div class="row">
                <div class="col-3 text-right">
                  <label for="" class="col-form-label">No:</label>
                </div>
                <div class="col-3">
                  <input type="number" v-model="letra_cambio.numero" class="form-control" >
                </div>
                <div class="col-5 border border-info p-2">
                  <div class="row">
                    <div class="col-2">
                      <label class="col-form-label" for="">POR:</label>
                    </div>
                    <div class="col-8">
                      <input type="number" v-model="letra_cambio.por" class="form-control text-right" >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 text-center ">
              <div class="row mb-1">
                <div class="col-6">
                  <input type="text" v-model="letra_cambio.ciudad" class="form-control" >
                </div>
                <div class="col-6">
                  <input type="date" v-model="letra_cambio.fecha" class="form-control" >
                </div>
              </div>
              <h6>Ciudad y fecha</h6>
            </div>
            <div class="col-12 ">
              <input type="text" v-model="letra_cambio.orden_de" class="form-control" >
              <h6>A la orden de</h6>
            </div>
            <div class="col-12 ">
              <input type="text" v-model="letra_cambio.de" class="form-control" >
              <h6>De</h6>
            </div>
            <div class="col-12 ">
              <input type="text" v-model="letra_cambio.cantidad" class="form-control" >
              <h6>La Cantidad de</h6>
            </div>
            <div class="col-12 form-inline">
              <p class="col-form-label">Con  el  interés  del <input type="number" style="width: 100px;" v-model="letra_cambio.interes" class="form-control text-right" > por  ciento  anual,   desde <input v-model="letra_cambio.desde" type="text" class="form-control" > Sin protesto.   Exímese  de presentación  para  aceptación  y  pago  así  como  de  avisos  por  falta  de  estos  hechos.</p>
            </div>
            <div class="col-12 ">
              <div class="row mb-1">
                <div class="col-6">
                  <input type="text" v-model="letra_cambio.direccion" class="form-control" >
                </div>
                <div class="col-6">
                  <input type="text" v-model="letra_cambio.ciudad2" class="form-control" >
                </div>
              </div>
              <div class="row mb-1">
                <div class="col-6"><h6>Direccion</h6></div>
                <div class="col-6 text-right"><h6>Ciudad</h6></div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-5 text-center">
              <input type="text" v-model="letra_cambio.atentamente" class="form-control" >
              <h1>Atentamente</h1>
            </div>
          </div>
        </div>
        
      </div>
      <div class="modal-footer text-center">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button v-if="!letra_cambio.update" type="button" :disabled="!show" class="btn btn-primary" @click.prevent="guardarLetra()">Guardar Letra De Cambio</button>
        <button v-if="letra_cambio.update" type="button" class="btn btn-info" @click.prevent="updateLetra()">Actualizar Letra De Cambio</button>
      </div>
    </div>
  </div>
</div>
<!-- PAPELETA DE DEPOSITO -->
<div class="modal fade" id="m_papeleta" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="m_letra_cambioLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-xl ">
    <div class="modal-content bg-light">
      <div class="modal-header">
        <h5 class="modal-title" id="m_letra_cambioLabel">PAPELETA DE DEPOSITO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="resetPapeleta()">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="text-center font-weight-bold">LLENAR PAPELETA DE DEPOSITO</h3>
            <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">FECHA DE LA TRANSACCION</label>
          <div class="col-sm-4">
            <input type="date" class="form-control mb-2" placeholder="Modulo al que pertenece el cheque" v-model="modulo">
            
          </div>
        </div>
        <div class=" p-3" style="box-shadow: 5px 5px 15px 0px  #2714E5">
          <h2 class="text-center text-danger font-weight-bold">PAPELETA DE DEPOSITO</h2>
          <div class="row">
            <div class="col-lg-6">
              <div class="row">
               {{--  <div class="col-lg-2">
                  <img src="{{ asset('img/nota-credito.png') }}" width="100" alt="">
                </div> --}}
                <div class="col-lg-7 text-center">
                  <h1 class="text-danger font-weight-bold">BANCO</h1>
                  <input type="text" v-model="papeleta_deposito.banco" class="form-control form-control-sm">
                </div>
                <div class="col-lg-5 border">
                  <div class="row">
                    <div class="col-6">
                      <h6>BANCO</h6>
                      <input type="radio" disabled="" name="tipo">Loja <br>
                      <input type="radio" disabled="" name="tipo">fomento
                    </div>
                    <div class="col-6">
                      <h6>MONEDA</h6>
                      <input type="radio" disabled="" name="moneda">USD <br>
                      <input type="radio" disabled="" name="moneda">EUR
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="row mb-2">
                <div class="col-12">
                  <h6>Numero de cuenta o tarjeta</h6>
                  <input type="number" v-model="papeleta_deposito.cuenta" class="form-control form-control-sm">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-9">
                  <input type="text" v-model="papeleta_deposito.nombre" class="form-control" id="inputEmail3">
                </div>
              </div>
              <div class="form-group row mb-2">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Lugar y Fecha</label>
                <div class="col-sm-9">
                  <input type="text" v-model="papeleta_deposito.lugar_fecha" class="form-control" id="inputPassword3">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              {{--     <div class="row justify-content-lg-end">
                <div class="col-1">
                  <h2 class="font-weight-bold">No</h2>
                </div>
                <div class="col-3">
                  <input type="number" class="form-control form-control-sm text-right">
                </div>
              </div> --}}
              <div class="row justify-content-lg-end mb-2">
                <div class="col-lg-10 border align-self-end p-2">
                  <div class="form-check form-check-inline text-right">
                    <input class="form-check-input" disabled="" type="radio" name="tarjeta" id="inlineCheckbox1" value="dinners">
                    <label class="form-check-label" for="inlineCheckbox1">Dinners Club</label>
                  </div>
                  <div class="form-check form-check-inline text-right">
                    <input class="form-check-input" disabled="" type="radio" name="tarjeta" id="inlineCheckbox2" value="visa">
                    <label class="form-check-label" for="inlineCheckbox2">Visa</label>
                  </div>
                  <div class="form-check form-check-inline text-right">
                    <input class="form-check-input" disabled="" type="radio" name="tarjeta" id="inlineCheckbox3" value="mastercard">
                    <label class="form-check-label" for="inlineCheckbox3">Mastercard</label>
                  </div>
                  <div class="form-check form-check-inline text-right">
                    <input class="form-check-input" disabled="" type="radio" name="tarjeta" id="inlineCheckbox4" value="otros">
                    <label class="form-check-label" for="inlineCheckbox4">Otros Servicios</label>
                  </div>
                </div>
              </div>
              <div class="row justify-content-lg-end">
                <div class="col-lg-10">
                  <div class="row justify-content-lg-between">
                    <div class="col-lg-3">
                      <h6>N. Cheques</h6>
                    </div>
                    <div class="col-lg-1 align-self-end mr-3">
                      <h6>Ctvs</h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-lg-end ">
                <div class="col-lg-5 border mr-1">
                  <div class="form-group row mt-2">
                    <div class="col-sm-6">
                      <input type="number" disabled=""  class="form-control  text-right" >
                    </div>
                    <label class="col-sm-6 col-form-label">CHEQUES</label>
                  </div>
                </div>
                <div class="col-lg-5 border">
                  <div class="form-group row mt-2">
                    <div class="col-sm-9">
                      <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">USD</div>
                        </div>
                        <input type="number" v-model="papeleta_deposito.cantidad" class="form-control  text-right">
                      </div>
                      {{-- <input type="number"  class="form-control" > --}}
                    </div>
                    <div class="col-sm-3">
                      <input type="number" disabled=""  class="form-control  text-right">
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="col-lg-6 align-self-end">
              
              <div class="row mt-5 text-center">
                <div class="col-lg-6">
                  <input type="text" v-model="papeleta_deposito.depositante" class="form-control">
                  <h6>Firma del Depositante</h6>
                </div>
                <div class="col-lg-6 ">
                  <input type="text" class="form-control" disabled="">
                  <h6>Sello y Rubica del cajero</h6>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row mt-2">
                <div class="col-lg-12">
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th colspan="4" class="text-center">DETALLE DE CHEQUES</th>
                      </tr>
                      <tr>
                        <th scope="col" class="text-center">Banco</th>
                        <th scope="col" class="text-center">Cuenta Numero</th>
                        <th scope="col" class="text-center">Cheque Numero</th>
                        <th scope="col" class="text-center">Valor</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th><input disabled="" type="text" class="form-control-sm form-control text-right"></th>
                        <td><input disabled="" type="number" class="form-control-sm form-control text-right"></td>
                        <td><input disabled="" type="number" class="form-control-sm form-control text-right"></td>
                        <td><input disabled="" type="number" class="form-control-sm form-control text-right"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div {{-- v-if="papeleta_deposito.show" --}} class="modal-footer text-center">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button v-if="!papeleta_deposito.update" :disabled="!show" type="button" class="btn btn-primary" @click.prevent="guardarPapeleta()">Guardar Papeleta de Deposito</button>
        <button v-if="papeleta_deposito.update" type="button" class="btn btn-info" @click.prevent="updatePapeleta()">Actualizar Papeleta de Deposito</button>
      </div>
    </div>
  </div>
</div>
{{-- NOTA DE CREDITO --}}
<div class="modal fade" id="m_credito" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="m_creditoLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="m_creditoLabel">NOTA DE CREDITO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="resetNota()">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="text-center font-weight-bold">LLENAR NOTA DE CREDITO</h3>
              <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">FECHA DE LA TRANSACCION</label>
          <div class="col-sm-4">
            <input type="date" class="form-control mb-2" placeholder="Modulo al que pertenece la nota de credito" v-model="modulo">
            
          </div>
        </div>
        <div class="" style="box-shadow: 5px 5px 15px 0px  #F42787">
          <div class="row p-3 justify-content-between">
            <div class="col-lg-5 col-sm-12 mb-sm-3 mb-3">
              <h2 class="font-weight-bold text-danger">EMPRESA SA</h2>
              {{-- <img class="img-fluid" src="{{ asset('img/nota-credito.png') }}" alt=""> --}}
              <div class="row">
                <div class="col-12 rounded border-success border text-left">
                  <h5>EMPRESA SA</h5>
                  <h6>Dirección Matriz :  Av. 17 de Septiembre</h6>
                  <h6>Dirección  Sucursal :  Juan  Montalvo  y  24  de  Mayo</h6>
                  <h6>Contribuyente Especial N°        25489</h6>
                  <h6>OBLIGADO  A  LLEVAR  CONTABILIDAD   SI</h6>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 rounded border-success border text-left p-2">
              <h6>R.U.C.  0925487699001</h6>
              <h5>NOTA DE CREDITO</h5>
              <h6>No. 001-001-000000002</h6>
              <h6>NÚMERO DE AUTORIZACIÓN: <br> 2101201710240109254876990011045896723</h6>
              <h6>FECHA Y HORA DE AUTORIZACIÓN <br>
              21/01/2017    10:24:01  a.m.</h6>
              <h6>AMBIENTE :  PRODUCCIÓN</h6>
              <h6>EMISIÓN :  NORMAL</h6>
              <h6>CLAVE DE ACCESO :</h6>
            </div>
          </div>
          <div class="row p-3 m-0 mb-2 border border-info">
            <div class="col-lg-7 col-sm-12">
              <div class="row mb-1">
                <div class="col-lg-6 col-sm-12"> <label>RAZÓN SOCIAL/NOMBRES Y APELLIDOS</label></div>
                <div class="col-lg-6 col-sm-12"><input  name="nombre" type="text " v-model="nota_credito.razon_social" class="form-control"></div>
              </div>
              <div class="row  mb-1">
                <div class="col-lg-6 col-sm-12 "><label for="">FECHA EMISIÓN :</label></div>
                <div class="col-lg-6 col-sm-12"><input  name="fecha_emision" type="date" v-model="nota_credito.fecha_emision" class="form-control"></div>
              </div>
            </div>
            <div class="col-lg-5 col-sm-12">
              <div class="row mb-3">
                <div class="col-lg-5 col-sm-12"><label class="col-form-label">R.U.C/C.I. :</label></div>
                <div class="col-lg-7 col-sm-12"><input  name="ruc" type="text " v-model="nota_credito.ruc" class="form-control"></div>
              </div>
              {{-- <div class="row">
                <div class="col-5"><label class="col-form-label" for="">GUÍA DE REMISIÓN :</label></div>
                <div class="col-7"><input  name="emision" type="text " v-model="nota_credito." class="form-control"></div>
              </div> --}}
            </div>
            <div class="col-12 mt-2 col-sm-12">
              <div class="row mb-1">
                <div class="col-lg-6 col-sm-12"><label for="">COMPROBANTE QUE MODIFICA</label></div>
                <div class="col-lg-6 col-sm-12"><input  name="nombre" type="text " v-model="nota_credito.comprobante" class="form-control"></div>
              </div>
              <div class="row  mb-1">
                <div class="col-lg-6 col-sm-12 "><label for="">FECHA EMISION(Comprobante a modificar) :</label></div>
                <div class="col-lg-6 col-sm-12"><input  type="date" v-model="nota_credito.emision" class="form-control"></div>
              </div>
              <div class="row  mb-1">
                <div class="col-lg-6 col-sm-12 "><label for="">RAZON DE MODIFICACION:</label></div>
                <div class="col-lg-6 col-sm-12"><input  type="text " v-model="nota_credito.razon_modificacion" class="form-control"></div>
              </div>
            </div>
          </div>
          <div class="row p-3  mb-2 table-responsive">
            <table class="table table-bordered table-sm">
              <thead>
                <tr align="center">
                  <th scope="col">CÓDIGO</th>
                  <th scope="col">CÓD. AUXILIAR</th>
                  <th scope="col">CANT.</th>
                  <th scope="col">DESCRIPCION.</th>
                  <th>DESCUENTO</th>
                  <th scope="col">P. UNITARIO</th>
                  <th>VALOR VENTA</th>
                  <th width="50">BORRAR</th>
                </tr>
              </thead>
              <tbody class="prin">
                <tr v-for="(dato, index) in nota_credito.datos">
                  <td width="100"> <input type="number" v-model="dato.codigo" name="codigo[]" class="form-control text-right" ></td>
                  <td width="100"><input type="text" v-model="dato.cod_aux" name="cod_aux[]" class="form-control text-right" ></td>
                  <td width="100"><input type="number" v-model="dato.cantidad" name="cantidad[]" class="form-control text-right" ></td>
                  <td ><textarea  v-model="dato.descripcion" name="descripcion[]" class="form-control" ></textarea> </td>
                  <td width="50"><input type="number" v-model="dato.descuento" name="precio[]" class="form-control text-right" ></td>
                  <td width="50"><input type="number" v-model="dato.p_unitario" name="descuento[]" class="form-control text-right" ></td>
                  <td width="125" ><input type="number" v-model="dato.venta" name="valor[]" class="form-control text-right" ></td>
                  <td class="text-center"><a @click.prevent="eliminarDatoNota(index)" v-if="index != 0" href="#" class="btn btn-danger remove"><i class="fas fa-trash"></i></a></td>
                </tr>
                
              </tbody>
            </table>
            <a href="#" class=" btn btn-outline-danger" @click.prevent="aggDatoNota()">Agregar Columna</a>
          </div>
          <div class="row p-3  mb-2">
            <div class="col-lg-6 col-sm-12 mb-sm-3 border-danger border align-self-end">
              <h2 class="text-center">Informacion Adicional</h2>
              <div class="row mb-2">
                <div class="col-4"><label class="col-form-label" for="">Direccion</label></div>
                <div class="col-8">Av 17 de Septiembre y Rumichaca esquina</div>
              </div>
              <div class="row mb-2">
                <div class="col-4"><label class="col-form-label" for="">Telefono</label></div>
                <div class="col-8">2158674 - 21389472</div>
              </div>
              <div class="row mb-2">
                <div class="col-4"><label class="col-form-label" for="">Email</label></div>
                <div class="col-8">ediciones_palacios@hotmail.com</div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12">
              <table class="table table-bordered">
                
                <tbody>
                  <tr>
                    <th scope="row">SUBTOTAL 12%</th>
                    <td><input  type="number" v-model="nota_credito.totales.subtotal_12" name="subtotal_12" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">SUBTOTAL 0%</th>
                    <td><input  type="number" v-model="nota_credito.totales.subtotal_0" name="subtotal_0" class="form-control text-right"></td>
                    
                  </tr>
                  <tr>
                    <th scope="row">SUBTOTAL No objeto de IVA</th>
                    <td><input  type="number" v-model="nota_credito.totales.subtotal_no_iva" name="subtotal_iva" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">SUBTOTAL Exento de IVA</th>
                    <td><input  type="number" v-model="nota_credito.totales.subtotal_exe_iva" name="subtotal_siniva" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">SUBTOTAL SIN IMPUESTOS</th>
                    <td><input  type="number" v-model="nota_credito.totales.subtotal_sin_va" name="subtotal_sin_imp" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">TOTAL DESCUENTO</th>
                    <td><input  type="number" v-model="nota_credito.totales.total_descuento" name="descuento_total" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">ICE</th>
                    <td><input  type="number" v-model="nota_credito.totales.ice" name="ice" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">IVA 12%</th>
                    <td><input  type="number" v-model="nota_credito.totales.iva_12" name="iva12" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">IRBPNR</th>
                    <td><input  type="number" v-model="nota_credito.totales.irbpnr" name="irbpnr" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">VALOR TOTAL</th>
                    <td><input  type="number" v-model="nota_credito.totales.total" name="valor_total" class="form-control text-right"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button v-if="!nota_credito.update" :disabled="!show" type="button" class="btn btn-primary" @click.prevent="guardarNota()">Guardar Nota Credito</button>
        <button v-if="nota_credito.update" type="button" class="btn btn-info" @click.prevent="updateNota()">Actualizar Nota Credito</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="m_factura" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="m_facturaLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="m_facturaLabel">FACTURA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="resetFactura()">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="text-center font-weight-bold">LLENAR FACTURA</h3>
           <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">FECHA DE LA TRANSACCION</label>
          <div class="col-sm-4">
            <input type="date" class="form-control mb-2" placeholder="Modulo al que pertenece la factura" v-model="modulo">
            
          </div>
        </div>
        <div class="" style="box-shadow: 5px 5px 15px 0px  #F42787">
          <div class="row p-3 justify-content-between">
            <div class="col-lg-5 col-sm-12 mb-sm-3">
              <h2 class="font-weight-bold text-danger">EMPRESA SA</h2>
              {{-- <img class="img-fluid" src="{{ asset('img/talleres/imagen-27.jpg') }}" alt=""> --}}
              <div class="row">
                <div class="col-12 rounded border-success border text-left">
                  <h5>Empresa SA</h5>
                  <h6>Dirección Matriz :  Av. 17 de Septiembre</h6>
                  <h6>Dirección  Sucursal :  Juan  Montalvo  y  24  de  Mayo</h6>
                  <h6>Contribuyente Especial N°        25489</h6>
                  <h6>OBLIGADO  A  LLEVAR  CONTABILIDAD   SI</h6>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 rounded border-success border text-left p-2">
              <h6>R.U.C.  0925487699001</h6>
              <h5>FACTURA</h5>
              <h6>No. 001-001-000000002</h6>
              <h6>NÚMERO DE AUTORIZACIÓN: <br> 2101201710240109254876990011045896723</h6>
              <h6>FECHA Y HORA DE AUTORIZACIÓN <br>
              21/01/2017    10:24:01  a.m.</h6>
              <h6>AMBIENTE :  PRODUCCIÓN</h6>
              <h6>EMISIÓN :  NORMAL</h6>
              <h6>CLAVE DE ACCESO :</h6>
            </div>
          </div>
          <div class="row p-3 m-0 mb-2 border border-info">
            <div class="col-lg-7 col-sm-12">
              <div class="row mb-3">
                <div class="col-lg-6 col-sm-12"><label class="col-form-label" for="">RAZÓN SOCIAL/NOMBRES Y APELLIDOS :</label></div>
                <div class="col-lg-6 col-sm-12"><input  name="nombre" type="text " v-model="factura.razon_social"  class="form-control"></div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-sm-12"><label class="col-form-label" for="">FECHA EMISIÓN :</label></div>
                <div class="col-lg-6 col-sm-12"><input  name="fecha_emision" type="date" v-model="factura.fecha_emision" class="form-control"></div>
              </div>
            </div>
            <div class="col-lg-5 col-sm-12">
              <div class="row mb-3">
                <div class="col-lg-5 col-sm-12"><label class="col-form-label">R.U.C/C.I. :</label></div>
                <div class="col-lg-7 col-sm-12"><input  name="ruc" type="text " v-model="factura.ruc" class="form-control"></div>
              </div>
              <div class="row">
                <div class="col-lg-5 col-sm-12"><label class="col-form-label" for="">GUÍA DE REMISIÓN :</label></div>
                <div class="col-lg-7 col-sm-12"><input  name="emision" type="text " v-model="factura.guia_remision" class="form-control"></div>
              </div>
            </div>
          </div>
          <div class="row p-3  mb-2 table-responsive">
            <table class="table table-bordered table-sm">
              <thead>
                <tr align="center">
                  <th scope="col">CÓDIGO</th>
                  <th scope="col">CÓD. AUXILIAR</th>
                  <th scope="col">CANT.</th>
                  <th scope="col">DESCRIPCION.</th>
                  <th scope="col">P. UNITARIO</th>
                  <th>DESCUENTO</th>
                  <th>VALOR VENTA</th>
                  <th width="50">BORRAR</th>
                </tr>
              </thead>
              <tbody class="prin">
                <tr v-for="(dato, index) in factura.datos">
                  <td width="100"> <input type="number" v-model="dato.codigo" name="codigo[]" class="form-control text-right" ></td>
                  <td width="100"><input type="text" v-model="dato.cod_aux" name="cod_aux[]" class="form-control text-right" ></td>
                  <td width="100"><input type="number" v-model="dato.cantidad" name="cantidad[]" class="form-control text-right" ></td>
                  <td ><textarea  v-model="dato.descripcion" name="descripcion[]" class="form-control" ></textarea> </td>
                  <td width="50"><input type="number" v-model="dato.p_unitario" name="precio[]" class="form-control text-right" ></td>
                  <td width="50"><input type="number" v-model="dato.descuento" name="descuento[]" class="form-control text-right" ></td>
                  <td width="125" ><input type="number" v-model="dato.venta" name="valor[]" class="form-control text-right" ></td>
                  <td class="text-center"><a @click.prevent="eliminarDatoFactura(index)" v-if="index != 0" href="#" class="btn btn-danger remove"><i class="fas fa-trash"></i></a></td>
                </tr>
              </tbody>
            </table>
            <a href="#" class="addRow btn btn-outline-danger" @click.prevent="aggDatoFactura()">Agregar Columna</a>
          </div>
          <div class="row p-3  mb-2">
            <div class="col-lg-6 col-sm-12 mb-sm-3 border-danger border align-self-end">
              <h2 class="text-center">Informacion Adicional</h2>
              <div class="row mb-2">
                <div class="col-4"><label class="col-form-label" for="">Direccion</label></div>
                <div class="col-8">Av 17 de Septiembre y Rumichaca esquina</div>
              </div>
              <div class="row mb-2">
                <div class="col-4"><label class="col-form-label" for="">Telefono</label></div>
                <div class="col-8">2158674 - 21389472</div>
              </div>
              <div class="row mb-2">
                <div class="col-4"><label class="col-form-label" for="">Email</label></div>
                <div class="col-8">ediciones_palacios@hotmail.com</div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 mb-sm-3 ">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th scope="row">SUBTOTAL 12%</th>
                    <td><input  type="number" v-model="factura.totales.subtotal_12" name="subtotal_12" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">SUBTOTAL 0%</th>
                    <td><input  type="number" v-model="factura.totales.subtotal_0" name="subtotal_0" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">SUBTOTAL No objeto de IVA</th>
                    <td><input  type="number" v-model="factura.totales.subtotal_no_iva" name="subtotal_iva" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">SUBTOTAL Exento de IVA</th>
                    <td><input  type="number" v-model="factura.totales.subtotal_exe_iva" name="subtotal_siniva" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">SUBTOTAL SIN IMPUESTOS</th>
                    <td><input  type="number" v-model="factura.totales.subtotal_sin_va" name="subtotal_sin_imp" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">TOTAL DESCUENTO</th>
                    <td><input  type="number" v-model="factura.totales.total_descuento" name="descuento_total" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">ICE</th>
                    <td><input  type="number" v-model="factura.totales.ice" name="ice" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">IVA 12%</th>
                    <td><input  type="number" v-model="factura.totales.iva_12" name="iva12" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">IRBPNR</th>
                    <td><input  type="number" v-model="factura.totales.irbpnr" name="irbpnr" class="form-control text-right"></td>
                  </tr>
                  <tr>
                    <th scope="row">VALOR TOTAL</th>
                    <td><input  type="number" v-model="factura.totales.total" name="valor_total" class="form-control text-right"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button v-if="!factura.update" type="button" :disabled="!show" class="btn btn-primary" @click.prevent="guardarFactura()">Guardar Factura</button>
        <button v-if="factura.update" type="button" class="btn btn-info" @click.prevent="updateFactura()">Actualizar Factura</button>
      </div>
    </div>
  </div>
</div>
<!-- PAGARE -->
<div class="modal fade" id="m_pagare" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="m_pagareLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-xl ">
    <div class="modal-content bg-light">
      <div class="modal-header">
        <h5 class="modal-title" id="m_pagareLabel">PAGARÉ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="resetPagare()">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="text-center font-weight-bold">LLENAR PAGARÉ</h3>
             <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">FECHA DE LA TRANSACCION</label>
          <div class="col-sm-4">
            <input type="date" class="form-control mb-2" placeholder="Modulo al que pertenece el cheque" v-model="modulo">
            
          </div>
        </div>
        <div class="p-3" style="box-shadow: 5px 5px 15px 0px  #27F4AE">
          <div class="row justify-content-center">
            <div class="col-10 p-2  ">
              <div class="row justify-content-center">
                <div class="col-4">
                  <img class="img-fluid" src="{{ asset('img/talleres/imagen-19.jpg') }}" alt="">
                </div>
              </div>
              <div class="row justify-content-around">
                <div class="col-5">
                  <span class="border border-right-0 border-left-0 border-success">No. 1</span>
                </div>
                <div class="col-4 form-inline">
                  <label for="">Por $<input v-model="pagare.por" type="number" class="form-control text-right"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <p class=" text-justify">
                    Debo y pagare de la fecha en <input  v-model="pagare.fecha" type="text" class=" input-css form-control-sm m-1" size="10"> fijos en esta ciudad o en el lugar en que se me reconvenga a la orden de <input  v-model="pagare.nombre" type="text" class=" input-css  form-control-sm " size="40"> la cantidad de <input  v-model="pagare.cantidad" type="text" class=" input-css form-control-sm" size="65"> por igual valor que tengo recibido, en calidad de préstamo y en dinero efectivo para destinarlo a negocios de comercio; esta cantidad me oblifo a devolveria al vencimiento del plazo expresado, enmonedas de este curso legal.
                  </p>
                  <p class=" text-justify">
                    Tambien me obligo a pagar el interes del <input    type="text" v-model="pagare.interes" class=" input-css  form-control-sm m-1" size="1"> por ciento anual desde el vencimiento hasta la completa cancelacion y en el caso de mora, a pagar todos los gastos judiciales y extrajudiciales que ocasione el cobro, bastando para terminar el montode tales gastos la sola afirmacion del agreedor.</p>
                    <p class=" text-justify">
                      Al fiel cumplimiento de lo acordado me obligo con todos v bienes presentes y futuros, y ademas, renuncio domicilio y toda ley o excepcion que pudiera favorecerme en jucio o fuera de el.
                    </p>
                    <p class=" text-justify">
                      Renuncio tambien al derecho de interponer el recurso de apelacion y el de hecho de las providencias que se expidieron en el juicio a que diere lugar, estipulado expresamente que el tenedor no podra ser obligado a recibir el pago por partes ni aun por mis herederos o sucesores, sin protesto
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <label for="">Ciudad  -   Fecha</label><input    class="form-control form-control-sm" v-model="pagare.ciudad" type="text">
                  </div>
                  <div class="col-6">
                    <label for="">Fecha Vencimiento</label><input   class="form-control form-control-sm" v-model="pagare.fecha_vencimiento" type="text">
                    
                  </div>
                  
                </div>
                <div class="row justify-content-end mt-3">
                  <div class="col-10">
                    <p class=" text-justify">Me constituyo fiador llano pagador del señor <input    class=" input-css  form-control-sm mb-1 ml-1 mr-1" size="55" v-model="pagare.señor" type="text"> por las obligaciones que hemos contraído en el pagaré anterior haciendo de deuda ajena deuda propia renunciando  los beneficios de orden y de excusión de bienes del deudor principalmente el de división y cualquier ley, excepción o derecho que pueda favorecerme así como la apelación y el recurso de hecho.  Quedo sometido a los jueces de  Provincia o de la que elija el acreedor. Sin protesto.</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 ">
                    <div class="form-group">
                      <label >FECHA UT SUPRA <br>DEUDOR(ES)</label>
                      <input type="text" v-model="pagare.deudor1" class="form-control form-control-sm" >
                    </div>
                  </div>
                  <div class="col-6 mt-4">
                    <div class="form-group">
                      <label >GARANTE(ES)</label>
                      <input type="text" v-model="pagare.garante" class="form-control form-control-sm">
                    </div>
                  </div>
                  <div class="col-6 ">
                    <div class="form-group">
                      1233049439
                    </div>
                  </div>
                  <div class="col-6 ">
                    <div class="form-group">
                      0893569486
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer text-center">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button v-if="!pagare.update" type="button" :disabled="!show" class="btn btn-primary" @click.prevent="guardarPagare()">Guardar Pagaré</button>

          <button v-if="pagare.update" type="button" class="btn btn-info" @click.prevent="updatePagare()">Actualizar Pagaré</button>
        </div>
      </div>
    </div>
  </div>