<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_provision" tabindex="-1" role="dialog"
    aria-labelledby="modal_provisionLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl " role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <div v-if="update">
                    <h5 class="modal-title" id="er-ingresoLabel">ACTUALIZAR PROVISIÓN</h5>
                </div>
                <div v-else="!update">
                    <h5 class="modal-title" id="ba-transaccionLabel">AGREGAR TRANSACCION</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 700px; overflow-y: scroll;  width: 100%;">
            <a class="btn btn-dark mb-2" href="" @click.prevent="calculadora()">CALCULADORA</a>
                
                <div class="row justify-content-center">
                    <div class="col-12 mt-2 border border-top-0 border-left-0 border-right-0 border-danger"
                        style=" height:400px; overflow-y: scroll;">
                        <h1 class="text-center font-weight-bold mt-2">Datos para elaborar Provisión de Beneficios
                            Sociales </h1>
                        <h2 class="text-center font-weight-bold mt-2">Nomina de Empleados</h2>
                        <h3 class="font-weight-bold text-danger text-center">@{{ nombre }}</h3>

                        <table class="table table-bordered table-sm">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center " style="vertical-align: middle;">NOMBRE DEL EMPLEADOS
                                    </th>
                                    <th class="text-center" style="vertical-align: middle;">CARGO</th>
                                    <th class="text-center" style="vertical-align: middle;">SUELDO</th>
                                    <th class="text-center" style="vertical-align: middle;">SOBRE TIEMPO</th>
                                    <th class="text-center" style="vertical-align: middle;">TOTAL INGRESOS</th>
                                    <th class="text-center" style="vertical-align: middle;">IESS 9.45%</th>
                                    <th class="text-center" style="vertical-align: middle;">PREST. IESS</th>
                                    <th class="text-center" style="vertical-align: middle;">PREST. CIA</th>
                                    <th class="text-center" style="vertical-align: middle;">ANTICIPO</th>
                                    <th class="text-center" style="vertical-align: middle;">IMP. RENTA</th>
                                    <th class="text-center" style="vertical-align: middle;">TOTAL EGRESOS</th>
                                    <th class="text-center" style="vertical-align: middle;">VALOR NETO A PAGAR</th>

                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(n, index) in t_nomina">
                                    <td align="left" width="300">@{{ n.nombre_e}}</td>
                                    <td align="left" width="125">@{{ n.cargo}}</td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(n.sueldo)}}</td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(n.s_tiempo)}}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(n.ingresos)}}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(n.iees)}}</td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(n.pres_iees)}}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(n.pres_cia)}}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(n.anticipo)}}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(n.imp_renta)}}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(n.egresos)}}
                                    </td>
                                    <td class="text-right" align="center" width="100">@{{ decimales(n.neto_pagar)}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 mt-2 border border-top-0 border-left-0 border-right-0 border-danger"
                       >
                        <h2 class="text-center">Agregar Provisión</h2>


                        <table class="table table-bordered table-sm">
                            <thead class="thead-dark">
                                <tr align="center">
                                    <th scope="col" style="vertical-align: middle;" width="300">Nómina</th>
                                    <th scope="col" style="vertical-align: middle;" width="50">Días</th>
                                    <th scope="col " style="vertical-align: middle;" width="125">Valor Recibido</th>
                                    <th scope="col " style="vertical-align: middle;" width="125">Décimo Tercero</th>
                                    <th scope="col " style="vertical-align: middle;" width="125">Décimo Cuarto</th>
                                    <th scope="col " style="vertical-align: middle;" width="125">Vacaciones</th>
                                    <th scope="col" style="vertical-align: middle;" width="125">Fondo de Reserva</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-right" align="center" width="250"><input v-model="pro.nombre_em"
                                            type="text" class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="100"><input v-model="pro.dias"
                                            type="number" class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="120"><input v-model="pro.v_recibido"
                                            type="number" class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input v-model="pro.d_tercero"
                                            type="number" class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input v-model="pro.d_cuarto"
                                            type="number" class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input v-model="pro.vacaciones"
                                            type="number" class="form-control form-control-sm"></td>
                                    <td class="text-right" align="center" width="125"><input v-model="pro.f_reserva"
                                            type="number" class="form-control form-control-sm"></td>
                                </tr>
                            </tbody>

                        </table>

                        <div v-if="!pro.edit" class="row justify-content-center">
                            <a href="#" class="btn btn-success" @click.prevent="agregarProvision()">Agregar
                                Provisión</a>

                        </div>
                        <div v-else class="row justify-content-center">
                            <a href="#" class="btn btn-success" @click.prevent="actualizarProvision()">Actualizar
                                Provisión</a>
                            <a href="#" class="btn btn-danger ml-1" @click.prevent="cancelarEditProvision()"><i
                                    class="fa fa-window-close"></i></a>
                        </div>

                        <br>

                        <div class="col-12 mt-2" v-if="t_pro.length > 0"  style=" height:400px; overflow-y: scroll;">
                            <h2 class="text-center">REGISTROS</h2>
                            <table class="table table-bordered table-sm">
                                <thead class="thead-dark">
                                    <tr align="center">
                                        <th scope="col" style="vertical-align: middle;" width="300">Nómina</th>
                                        <th scope="col" style="vertical-align: middle;" width="50">Días</th>
                                        <th scope="col " style="vertical-align: middle;" width="125">Valor Recibido</th>
                                        <th scope="col " style="vertical-align: middle;" width="125">Décimo Tercero</th>
                                        <th scope="col " style="vertical-align: middle;" width="125">Décimo Cuarto</th>
                                        <th scope="col " style="vertical-align: middle;" width="125">Vacaciones</th>
                                        <th scope="col" style="vertical-align: middle;" width="125">Fondo de Reserva
                                        </th>
                                        <th width="50" colspan="2" v-if="t_pro.length > 0">ACCION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(p , index) in t_pro">
                                        <td class="text-left" align="center" width="300">@{{ p.nombre_em}}</td>
                                        <td class="text-right" align="center" width="100">@{{ p.dias}}</td>
                                        <td class="text-right" align="center" width="125">@{{ decimales(p.v_recibido) }}
                                        </td>
                                        <td class="text-right" align="center" width="125">@{{ decimales(p.d_tercero) }}
                                        </td>
                                        <td class="text-right" align="center" width="125">@{{ decimales(p.d_cuarto) }}
                                        </td>
                                        <td class="text-right" align="center" width="125">@{{ decimales(p.vacaciones) }}
                                        </td>
                                        <td class="text-right" align="center" width="125">@{{ decimales(p.f_reserva) }}
                                        </td>
                                        <td align="center" width="50"><a @click.prevent="editProvision(index)"
                                                class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                                        <td align="center" width="50"><a
                                                @click.prevent="WarningEliminarProvision(index)"
                                                class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
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



{{--Provision eliminar--}}

<div class="modal fade" id="eliminar_p" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="eliminar_pLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminar_pLabel">Eliminar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Deseas eliminar el registro de @{{ eliminar.nombre }}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" @click="eliminarProvision()">Eliminar</button>
            </div>
        </div>
    </div>
</div>