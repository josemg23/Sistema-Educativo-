<div id="estado_resultado" class="border border-danger p-4">
    <h2 class="text-center display-4 font-weight-bold text-danger">Estado de Resultado</h2>
    <div class="row p-3  mb-2 justify-content-center ">
        <div class="col-5 mb-3">
            <input autocomplete="ÑÖcompletes" class="form-control text-center" type="text" v-model="nombre"
                placeholder="Nombre de la empresa" name=""><br>
            <input autocomplete="ÑÖcompletes" type="date" v-model="fecha" class="form-control text-center">
        </div>

    </div>

    <div class="row">
        <div class="col-5">
            <h4>Ventas</h4>
        </div>
        <div class="col-2 text-right"><span>@{{ decimales(venta) }}</span></div>
    </div>
    <div class="row">
        <div class="col-5">
            <h4>- Costos de Ventas</h4>
        </div>
        <div class="col-2 border-danger text-right" style="border-bottom: solid; 2px">@{{ decimales(costo_venta) }}
        </div>
    </div>
    <div class="row">
        <div class="col-10">
            <h3 class="font-weight-bold text-info">Utilidad Bruta en Ventas <a data-toggle="tooltip"
                    data-placement="top" title="Agregar Utilidad Bruta" @click="abrirUtilidades()"
                    class="btn btn-sm btn-info text-light"><i class="fa fa-plus"></i></a></h3>
        </div>
        <div class="col-2 text-right"><span class="badge badge-danger"
                style="font-size: 20px;">@{{ decimales(totales.utilidad_bruta_ventas) }}</span></div>
    </div>

    <div class="row mt-2">
        <div class="col-6">
            <h1 class="font-weight-bold pl-3">INGRESOS <a data-toggle="tooltip" data-placement="top"
                    title="Agregar Ingreso" @click="abrirIngreso()" class="btn btn-sm btn-info text-light"><i
                        class="fa fa-plus"></i></a></h1>

        </div>
        <div class="col-12">
            <table>
                <tbody is="draggable" group="people" :list="ingresos" tag="tbody">
                    <tr v-for="(balan, index) in ingresos">
                        <td class="text-left" width="300">@{{ balan.cuenta}}</td>
                        <td align="center">@{{ decimales(balan.saldo)}}</td>
                        <td align="center" width="50">
                            <a @click.prevent="editIngresoFuera(index)" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td align="center" width="50">
                            <a @click.prevent="warningEliminarIngreso(index)" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-10">
            <h3 class="font-weight-bold text-info">Total de ingresos</h3>
        </div>
        <div class="col-2 text-right"><span class="badge badge-danger"
                style="font-size: 20px;">@{{ totales.ingreso }}</span></div>
    </div>
    <div class="row justify-content-between">
        <div class="col-10">
            <h3 class="font-weight-bold text-info">Utilidad Neta en Operaciones</h3>
        </div>
        <div class="col-2 text-right"><span class="badge badge-danger"
                style="font-size: 20px;">@{{ totales.utilidad_neta_o }}</span></div>
    </div>

    <div class="row mt-2">
        <div class="col-6">
            <h1 class="font-weight-bold pl-3">GASTOS <a data-toggle="tooltip" data-placement="top"
                    title="Agregar Gastos" @click="abrirGastos()" class="btn btn-sm btn-info text-light"><i
                        class="fa fa-plus"></i></a></h1>
        </div>
        <div class="col-12">
            <table>
                <tbody is="draggable" group="people" :list="gastos" tag="tbody">
                    <tr v-for="(balan, index) in gastos">
                        <td class="text-left" width="300">@{{ balan.cuenta}}</td>
                        <td align="center">@{{ decimales(balan.saldo)}}</td>
                        <td align="center" width="50">
                            <a @click.prevent="editGastoFuera(index)" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td align="center" width="50">
                            <a @click.prevent="warningEliminarGastos(index)" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-between mb-2">
        <div class="col-10">
            <h3 class="font-weight-bold text-info">Total de gastos</h3>
        </div>
        <div class="col-2 text-right border-danger" style="border-bottom: solid 2px;"><span class="badge badge-danger"
                style="font-size: 20px; ">@{{ totales.gastos }}</span></div>
    </div>

    <div class="row justify-content-between">
        <div class="col-7">
            <select class="custom-select" v-model="utilidad" name="" id="" @change="selectUtilidad()">
                <option selected="" disabled="" value="">ELEGIR UNA OPCION</option>
                <option value="utilidad_neta">UTILIDAD NETA DEL EJERCICIO</option>
                <option value="utilidad_perdida"> PERDIDA DEL EJERCICIO</option>
            </select>
        </div>
        <div class="col-3"><input autocomplete="ÑÖcompletes" type="number" v-model="totales.utilidad_ejercicio"
                class="form-control text-right"></div>
    </div>


    <div class="mt-2 row justify-content-between" v-if="utilidad == 'utilidad_neta'">
        <div class="col-8">
            <a href="" class="btn btn-danger btn-sm mr-2" @click.prevent="mostrarUtilidades()">Distribuir Utilidades</a>
            <a class="btn btn-dark  btn-sm " href="" @click.prevent="calculadora()">CALCULADORA</a>

        </div>

        <div v-if="utilida.create" class="col-12 mt-2">
            <div class="row">
                <div class="col-6">
                    <model-select :options="options" v-model="utilida.cuenta_id" placeholder="ELEGIR CUENTA">
                    </model-select>
                </div>

                <div class="col-3">
                    <input autocomplete="ÑÖcompletes" type="text" v-model="utilida.saldo" class="form-control">
                </div>

                <div v-if="!utilida.edit" class="col-3">
                    <a href="#" class="btn btn-success" @click.prevent="agregarUtilidad()">Agregar</a>
                    <a href="#" class="btn btn-danger ml-1" @click.prevent="cerrarUtilidades()"><i
                            class="fa fa-window-close"></i></a>

                </div>
                <div v-else class="col-3">
                    <a href="#" class="btn btn-success" @click.prevent="actualizarUtilidad()">Actualizar</a>
                    <a href="#" class="btn btn-danger ml-1" @click.prevent="cerrarUtilidades()"><i
                            class="fa fa-window-close"></i></a>

                </div>

            </div>
        </div>

        <div class="col-12">
            <table>
                <tbody is="draggable" group="people" :list="utilidades" tag="tbody">
                    <tr v-for="(balan, index) in utilidades">
                        <td class="text-left" width="750">@{{ balan.cuenta}}</td>
                        <td align="center">@{{ decimales(balan.saldo)}}</td>
                        <td align="center" width="50">
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
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <div class="row mt-2 justify-content-between">
                <div class="col-10">
                    <h2 class="font-weight-bold">UTILIDAD LIQUIDA DEL EJERCICIO</h2>
                </div>

                <div class="col-2"><input autocomplete="ÑÖcompletes" type="number" v-model="totales.utilidad_liquida"
                        class="form-control text-right"></div>
            </div>
        </div>
    </div>
    @if ($rol === 'estudiante' or 'docente')
    <div class="row justify-content-center mt-2">
        <a href="#" class="addDiario btn btn-outline-success" @click.prevent="guardarEstadoResultado()">Guardar Estado De Resultado</a>
    </div>
    @endif

    @include ('contabilidad.modales.modalestadoresultado')

</div>