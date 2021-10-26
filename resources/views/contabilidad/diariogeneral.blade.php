<div class="border border-danger p-3" >
{{--     <div class="row justify-content-center mb-5 mt-2">
        <a class="btn btn-success btn-sm mr-1" href="#" data-toggle="modal" data-target="#m_cheque"><i class="far fa-money-bill"></i> CHEQUE</a>
        <a class="btn btn-danger btn-sm mr-1" href="#" data-toggle="modal" data-target="#m_credito"><i class="fas fa-file-invoice-dollar"></i> NOTA DE CREDITO</a>
        <a class="btn btn-warning btn-sm mr-1" href="#" data-toggle="modal" data-target="#m_letra_cambio"><i class="fas fa-file-invoice-dollar"></i> LETRA DE CAMBIO</a>
        <a class="btn btn-info btn-sm mr-1" href="#" data-toggle="modal" data-target="#m_factura"><i class="fas fa-file-invoice-dollar"></i> FACTURA</a>
        <a class="btn btn-secondary btn-sm mr-1" href="#" data-toggle="modal" data-target="#m_papeleta"><i class="fas fa-file-invoice-dollar"></i> PAPELETA DE DEPOSITO</a>
        <a class="btn btn-primary btn-sm mr-1" href="#" data-toggle="modal" data-target="#m_pagare"><i class="fas fa-file-invoice-dollar"></i> PAGARÉ</a>
    </div> --}}
    <div id="diario" >
        <h1 class="text-center text-danger font-weight-bold mt-2">DIARIO GENERAL</h1>
        <div class="row justify-content-center">
            <div class="col-3">
                <input autocomplete="ÑÖcompletes" type="text" v-model="nombre" class="form-control text-center" placeholder="Nombre de la Empresa">
                
            </div>
        </div>
        {{-- <h4 class="text-center text-primary font-weight-bold mt-2">@{{ nombre }}</h4> --}}
        <div class="row p-3  mb-2 ">
            @if ($rol === 'estudiante' or 'docente')
            @if ($datos->metodo == 'concatenado')
            <div class="col-3 mb-2">
                <a class="btn btn-sm btn-danger" href="" @click.prevent="obtenerBalanceInicial()">Obtener Balance Inicial</a>
            </div>
            {{-- expr --}}
            @endif
            <div class="col-5 mb-2">
                <a href="#" class="btn btn-sm btn-outline-primary" @click.prevent="abrirTransaccion()">Crear Transaccion</a>
                <a href="#" class="addDiario btn-sm btn btn-danger" @click.prevent="guardarDiario()">GUARDAR DIARIO GENERAL </a>
            </div>
            @endif
            <div class="col-12">
                <table class="table table-bordered table-sm">
                    <thead class="thead-dark">
                        <tr align="center">
                            <th scope="col" width="200">FECHA</th>
                            <th scope="col" width="450">NOMBRE DE CUENTAS</th>
                            <th scope="col " width="125">DEBE</th>
                            <th scope="col">HABER</th>
                            <th width="75" colspan="2" v-if="registros.length > 0">ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(diar, index) in balanceInicial.debe">
                            <td v-if="index == 0" align="center" width="100">@{{ fechabalance }} </td>
                            <td v-else align="center"></td>
                            <td align="rigth">@{{ diar.nom_cuenta}}</td>
                            <td align="center" width="125">@{{ diar.saldo }}</td>
                            <td align="center" width="125"></td>
                        </tr>
                        <tr v-for="(diar, index) in balanceInicial.haber">
                            <td align="center" width="50"></td>
                            <td style="padding-left:50px">@{{ diar.nom_cuenta}}</td>
                            <td align="center" width="125"></td>
                            <td align="center" width="125">@{{ diar.saldo }}</td>
                        </tr>
                    </tbody>
                    <tbody v-for="(registro, id) in registros" @change="totalDebe()">
                        <tr v-for="(diardebe, index) in registro.debe">
                            <td align="center" width="50">@{{ formatoFecha(diardebe.fecha)}}</td>
                            <td align="rigth">@{{ diardebe.nom_cuenta}}</td>
                            <td class="text-right" width="125">@{{ decimales(diardebe.saldo) }}</td>
                            <td class="text-right" width="125"></td>
                            <td v-if="diardebe.fecha !== '' && diardebe.fecha !== null && registro.tipo !== 'inicial'" align="center" width="50"><a
                                @click="debeEditRegister(id)" class="btn btn-warning btn-sm"><i
                            class="fas fas fa-edit"></i></a></td>
                            <td v-if="registro.tipo == 'inicial' && diardebe.fecha !== '' && diardebe.fecha !== null"></td>
                            <td  v-if="diardebe.fecha != '' && diardebe.fecha !== null" align="center" width="50"><a
                                @click="deleteRegistro(id)" class="btn btn-danger btn-sm"><i
                            class="fas fa-trash-alt"></i></a></td>
                            <td colspan="2" v-else></td>
                        </tr>
                        <tr v-for="(diar, index) in registro.haber">
                            <td align="center" width="50"></td>
                            <td style="padding-left:50px">@{{ diar.nom_cuenta}}</td>
                            <td class="text-right" width="125"></td>
                            <td class="text-right" width="125">@{{ decimales(diar.saldo) }}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="text-muted">
                            <td></td>
                            <td>@{{ registro.comentario }}</td>
                            <td></td>
                            <td></td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td class="bg-dark" align="center" colspan="2" width="450" valign="middle">SUMAN</td>
                            <td class="bg-dark text-right" width="125">
                                @{{ decimales(pasan.debe) }}
                            </td>
                            <td class="bg-dark text-right" width="125">
                                @{{ decimales(pasan.haber) }}
                            </td>
                            <td v-if="registros.length > 0" width="90" style="border: none;"></td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="ajustes.length > 0">
                    <h2 class="font-weight-bold text-center">Asientos de ajustes </h2>
                    <table class="table table-bordered table-sm">
                        {{--     <thead class="thead-dark">
                            <tr align="center">
                                <th scope="col" width="200">FECHA</th>
                                <th scope="col" width="450">NOMBRE DE CUENTAS</th>
                                <th scope="col " width="125">DEBE</th>
                                <th scope="col">HABER</th>
                                <th colspan="2" v-if="ajustes.length > 0">ACCION</th>
                            </tr>
                        </thead> --}}
                        <tbody v-for="(registro, id) in ajustes" @change="totalDebe()">
                            <tr v-for="(diardebe, index) in registro.debe">
                                <td align="center"width="200">@{{ formatoFecha(diardebe.fecha)}}</td>
                                <td align="rigth" width="450">@{{ diardebe.nom_cuenta}}</td>
                                <td align="center" width="125">@{{ decimales(diardebe.saldo) }}</td>
                                <td align="center" width="125"></td>
                                <td v-if="diardebe.fecha !== '' && diardebe.fecha !== null" align="center" width="50"><a
                                    @click="debeEditAjustado(id)" class="btn btn-warning btn-sm"><i
                                class="fas fas fa-edit"></i></a></td>
                                <td v-if="diardebe.fecha != '' && diardebe.fecha !== null" align="center" width="50"><a
                                    @click="deleteAjuste(id)" class="btn btn-danger btn-sm"><i
                                class="fas fa-trash-alt"></i></a></td>
                                <td colspan="2" v-else></td>
                            </tr>
                            <tr v-for="(diar, index) in registro.haber">
                                <td align="center" width="50"></td>
                                <td style="padding-left:50px">@{{ diar.nom_cuenta}}</td>
                                <td align="center" width="125"></td>
                                <td align="center" width="125">@{{ decimales(diar.saldo) }}</td>
                                <td colspan="2"></td>
                            </tr>
                            <tr class="text-muted">
                                <td></td>
                                <td>@{{ registro.comentario }}</td>
                                <td></td>
                                <td></td>
                                <td colspan="2"></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr >
                                <td class="bg-dark" align="center" colspan="2" width="450" valign="middle">TOTAL</td>
                                <td class="bg-dark text-right"  width="125">
                                    @{{ decimales(total.debe) }}
                                </td>
                                <td class="bg-dark text-right"  width="125">
                                    @{{ decimales(total.haber) }}
                                </td>
                                <td v-if="registros.length > 0" width="90" style="border: none;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- <table class="table table-bordered table-sm">
                    <tbody is="draggable" group="people" :list="diarios.debe" tag="tbody">
                        <tr v-for="(diar, index) in diarios.debe">
                            <td align="center" width="100">@{{ diar.fecha}}</td>
                            <td>@{{ diar.nom_cuenta}}</td>
                            <td align="center" width="125">@{{ diar.saldo }}</td>
                            <td align="center" width="125"></td>
                            <td align="center" width="25">
                                <a @click="debediairoEdit(index)" class="btn btn-warning btn-sm"><i class="fas fas fa-edit"></i></a>
                            </td>
                            <td align="center" width="25">
                                <a @click="deleteDebe(index)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tbody is="draggable" group="people" :list="diarios.haber" tag="tbody">
                        <tr v-for="(diar, index) in diarios.haber">
                            <td align="center" width="50"></td>
                            <td style="padding-left:50px">@{{ diar.nom_cuenta}}</td>
                            <td align="center" width="125"></td>
                            <td align="center" width="125">@{{ diar.saldo }}</td>
                            <td>
                                <a @click="habediarioEdit(index)" class="btn btn-warning btn-sm"><i
                                class="fas fas fa-edit"></i></a>
                            </td>
                            <td align="center" width="25"><a @click="deleteHaber(index)" class="btn btn-danger btn-sm"><i
                            class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <tr v-if="diarios.comentario !== ''" class="text-muted">
                            <td></td>
                            <td>@{{ diarios.comentario }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered table-sm">
                    <tbody is="draggable" group="people" :list="edit.debe" tag="tbody">
                        <tr v-for="(diar, index) in edit.debe">
                            <td align="center" width="100">@{{ diar.fecha}}</td>
                            <td>@{{ diar.nom_cuenta}}</td>
                            <td align="center" width="125">@{{ diar.saldo }}</td>
                            <td align="center" width="125"></td>
                            <td align="center" width="25">
                                <a @click="debeEdit(index)" class="btn btn-warning btn-sm"><i
                                class="fas fas fa-edit"></i></a>
                            </td>
                            <td v-if="diar.fecha === ''" align="center" width="25">
                                <a @click="debeDelete(index)" class="btn btn-danger btn-sm"><i
                                class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tbody is="draggable" group="people" :list="edit.haber" tag="tbody">
                        <tr v-for="(diar, index) in edit.haber">
                            <td align="center" width="50"></td>
                            <td style="padding-left:50px">@{{ diar.nom_cuenta}}</td>
                            <td align="center" width="125"></td>
                            <td align="center" width="125">@{{ diar.saldo }}</td>
                            <td>
                                <a @click="haberEdit(index)" class="btn btn-warning btn-sm"><i
                                class="fas fas fa-edit"></i></a>
                            </td>
                            <td align="center" width="25"><a @click="haberDelete(index)" class="btn btn-danger btn-sm"><i
                            class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <tr v-if="edit.comentario !== ''">
                            <td></td>
                            <td class="text-muted">@{{ edit.comentario }}</td>
                            <td></td>
                            <td></td>
                            <td><a @click="comentarioEdit" class="btn btn-warning btn-sm"><i
                            class="fas fas fa-edit"></i></a></td>
                        </tr>
                    </tbody>
                </table> --}}
                {{--      <table class="table table-bordered table-sm">
                    <tbody>
                        <tr >
                            <td class="bg-dark" align="center" colspan="2" width="450" valign="middle">PASAN</td>
                            <td class="bg-dark" align="center" width="125">
                                @{{ pasan.debe }}
                            </td>
                            <td class="bg-dark" align="center" width="125">
                                @{{ pasan.haber }}
                            </td>
                            <td v-if="registros.length > 0" width="90" style="border: none;"></td>
                        </tr>
                    </tbody>
                </table> --}}
                <form action="">
                    @csrf
                    {{--   <div v-if="edit.debe.length >= 1" class="row justify-content-around mb-2">
                        <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#debe">Agregar
                        Debe</a>
                        <a href="#" class=" btn btn-outline-secondary" data-toggle="modal" data-target="#haber">Agregar
                        Haber</a>
                        <a href="#" v-if="edit.comentario == ''" class=" btn btn-outline-primary" data-toggle="modal"
                        data-target="#comentario">Agregar Comentario</a>
                        <a href="#" class="addDiario btn btn-outline-warning" @click.prevent="updaterRegister()">Actualizar
                        Transaccion</a>
                    </div> --}}
                    @if ($rol === 'estudiante' or 'docente')
                    <div class="row justify-content-around mb-2">
                        <a href="#" class="btn btn-outline-primary" @click.prevent="abrirTransaccion()">Crear
                        Transaccion</a>
                        {{-- <a href="#" v-if="diarios.debe.length > 0" class="btn btn-outline-primary" data-toggle="modal" data-target="#porcentajes">Agregar Porcentaje</a>
                        <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#debe">Agregar
                        Debe</a>
                        <a href="#" class=" btn btn-outline-primary" data-toggle="modal" data-target="#haber">Agregar
                        Haber</a>
                        <a href="#" class=" btn btn-outline-primary" data-toggle="modal" data-target="#comentario">Agregar
                        Comentario</a>
                        <a href="#" class="addDiario btn btn-outline-success" @click.prevent="guardarRegistro()">Agregar
                        Transaccion</a> --}}
                    </div>
                    <div class="row justify-content-center">
                        <a href="#" class="addDiario btn btn-outline-danger" @click.prevent="guardarDiario()">GUARDAR DIARIO GENERAL</a>
                    </div>
                    @endif
                </form>
                <div class="row justify-content-center">
                </div>
            </div>
            @include ('contabilidad.modaldiariogeneral')
        </div>
    </div>
    <h2 class="text-center font-weight-bold">Aplicacion de Documentos</h2>
    <div class="row justify-content-center mb-5" id="documentos"  style="height: 200px; overflow-y: scroll; overflow-x: hidden;">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Tipo de Documento</th>
                    <th scope="col">Fecha de la Transaccion</th>
                    <th  width="200" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(cheque, index) in cheques">
                    <td>@{{ cheque.tipo_documento }}</td>
                    <td>@{{ formatoFecha(cheque.modulo) }}</td>
                    <td class="text-center"><a class="btn btn-warning" href="" @click.prevent="editarCheque(cheque.id, index)"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" href="" @click.prevent="warningEliminar(cheque.id, index, cheque.tipo_documento)"><i class="fa fa-trash"></i></a></td>
                </tr>
                <tr v-for="(nota_credito, index) in nota_creditos">
                    <td>@{{ nota_credito.tipo_documento }}</td>
                    <td>@{{ formatoFecha(nota_credito.modulo) }}</td>
                    <td class="text-center"><a class="btn btn-warning" href="" @click.prevent="editarNota(nota_credito.id, index)"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" href="" @click.prevent="warningEliminar(nota_credito.id, index, nota_credito.tipo_documento)"><i class="fa fa-trash"></i></a></td>
                </tr>
                <tr v-for="(factura, index) in facturas">
                    <td>@{{ factura.tipo_documento }}</td>
                    <td>@{{ formatoFecha(factura.modulo) }}</td>
                    <td class="text-center"><a class="btn btn-warning" href="" @click.prevent="editarFactura(factura.id, index)"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" href="" @click.prevent="warningEliminar(factura.id, index, factura.tipo_documento)"><i class="fa fa-trash"></i></a></td>
                </tr>
                <tr v-for="(letra_cambio, index) in letra_cambios">
                    <td>@{{ letra_cambio.tipo_documento }}</td>
                    <td>@{{ formatoFecha(letra_cambio.modulo) }}</td>
                    <td class="text-center"><a class="btn btn-warning" href="" @click.prevent="editarLetra(letra_cambio.id, index)"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" href="" @click.prevent="warningEliminar(letra_cambio.id, index, letra_cambio.tipo_documento)"><i class="fa fa-trash"></i></a></td>
                </tr>
                <tr v-for="(pagare, index) in pagares">
                    <td>@{{ pagare.tipo_documento }}</td>
                    <td>@{{ formatoFecha(pagare.modulo) }}</td>
                    <td class="text-center"><a class="btn btn-warning" href="" @click.prevent="editarPagare(pagare.id, index)"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" href="" @click.prevent="warningEliminar(pagare.id, index, pagare.tipo_documento)"><i class="fa fa-trash"></i></a></td>
                </tr>
                <tr v-for="(papeleta_deposito, index) in papeleta_depositos">
                    <td>@{{ papeleta_deposito.tipo_documento }}</td>
                    <td>@{{ formatoFecha(papeleta_deposito.modulo )}}</td>
                    <td class="text-center"><a class="btn btn-warning" href="" @click.prevent="editarPapeleta(papeleta_deposito.id, index)"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" href="" @click.prevent="warningEliminar(papeleta_deposito.id, index, papeleta_deposito.tipo_documento)"><i class="fa fa-trash"></i></a></td>
                </tr>
            </tbody>
        </table>
        @include('contabilidad.modales.modaldocumentos')
    </div>
    
</div>