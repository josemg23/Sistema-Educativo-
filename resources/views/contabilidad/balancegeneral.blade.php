<div id="balance_general" class="border border-danger p-4">
    <h2 class="text-center display-4 font-weight-bold text-danger">Balance General</h2>
    <div class="row p-3 justify-content-center ">
        <div class="col-5 mb-3">
            <input autocomplete="ÑÖcompletes" class="form-control text-center" type="text" v-model="balance_general.nombre"
                placeholder="Nombre de la empresa" name=""><br>
            <input autocomplete="ÑÖcompletes" type="date" v-model="balance_general.fecha" class="form-control text-center">
        </div>

    </div>
    @if ($rol === 'estudiante' or 'docente')
    <a class="btn p-2 mt-3 btn-outline-info" @click.prevent="guardarBalanceGeneral()">Guardar Balance General</a>
    @endif
    <div class="row p-3  mb-2 justify-content-center ">
    </div>
    <h2 class="text-center font-weight-bold text-danger">ACTIVOS</h2>
    <div class="row">
        <div class="col-9">
            <h3 class="text-primary">ACTIVOS CORRIENTE <a data-toggle="tooltip" data-placement="top"
                    title="Agregar Activo Corriente" @click="abrirActivoC()" class="btn btn-sm btn-info text-light"><i
                        class="fa fa-plus"></i></a></h3><br>

            <table class="table table-borderless table-sm">
                <tbody v-for="(element, index) in a_corrientes" :key="element.name">
                    <tr>
                        <td width="400">@{{ element.cuenta }}</td>
                        <td class="text-right">@{{ decimales(element.saldo) }}</td>
                        <td class="text-right">@{{ decimales(element.total_saldo) }}</td>
                        <td width="10"><a @click="editAcorriente(index)" class="btn btn-warning btn-sm mr-1"><i
                                    class="fas fa-edit"></i></a></td>
                        <td width="10"><a @click="deleteAcCooriente(index)" class="btn btn-danger btn-sm re_diario"><i
                                    class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <tr
                        v-if="element.cuenta2 !== '' && element.saldo2 !== '' && element.total_saldo2 !=='' && element.cuenta2 !== null">
                        <td width="400">(-)@{{ element.cuenta2 }}</td>
                        <td style="border-bottom: solid 2px" class="text-right border-danger">
                            @{{ decimales(element.saldo2) }}</td>
                        <td class="text-right">@{{ decimales(element.total_saldo2) }}</td>
                        <td width="20" colspan="2"></td>
                    </tr>
                </tbody>
            </table>
       {{--      <draggable class="list-group list-group-flush" :list="a_corrientes" group="people" @change="cambioActivo">
                <div v-for="(element, index) in a_corrientes" :key="element.name">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @{{ element.cuenta }}<span class="badge-pill">@{{ decimales(element.saldo) }} <a
                                @click="editAcorriente(index)" class="btn btn-warning btn-sm mr-1"><i
                                    class="fas fa-edit"></i></a><a @click="deleteAcCooriente(index)"
                                class="btn btn-danger btn-sm re_diario"><i class="fas fa-trash-alt"></i></a></span>
                    </li>
                </div>
            </draggable> --}}
        </div>
        <div class="col-12">
            <table>
                <tbody>
                    <tr>
                        <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL ACT. CORR.</td>
                        <td style="font-size: 20px;" class="badge-danger badge">
                            @{{ decimales(b_initotal.t_a_corriente )}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-9">
            <h3 class="text-primary">ACTIVOS NO CORRIENTE <a data-toggle="tooltip" data-placement="top"
                    title="Agregar Activo No Corriente" @click="abrirActivoNoC()"
                    class="btn btn-sm btn-info text-light"><i class="fa fa-plus"></i></a></h3><br>

            <table class="table table-borderless table-sm">
                <tbody v-for="(element, index) in a_nocorrientes" :key="element.name">
                    <tr>
                        <td width="400">@{{ element.cuenta }}</td>
                        <td class="text-right">@{{ decimales(element.saldo) }}</td>
                        <td class="text-right">@{{ decimales(element.total_saldo) }}</td>
                        <td width="10"><a @click="editNoAcorriente(index)" class="btn btn-warning btn-sm mr-1"><i
                                    class="fas fa-edit"></i></a></td>
                        <td width="10"><a @click="deleteAcNoCooriente(index)" class="btn btn-danger btn-sm re_diario"><i
                                    class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <tr
                        v-if="element.cuenta2 !== '' && element.saldo2 !== '' && element.total_saldo2 !=='' && element.cuenta2 !== null">
                        <td width="400">(-)@{{ element.cuenta2 }}</td>
                        <td style="border-bottom: solid 2px" class="text-right border-danger">
                            @{{ decimales(element.saldo2) }}</td>
                        <td class="text-right">@{{ decimales(element.total_saldo2) }}</td>
                        <td colspan="2"></td>
                    </tr>
                </tbody>
            </table>

            {{--         <div >
                <li class="list-group-item d-flex justify-content-between align-items-center">@{{ element.cuenta }}
            <span class="badge-pill">@{{ decimales(element.saldo) }} <a @click="editNoAcorriente(index)"
                    class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></a><a
                    @click="deleteAcNoCooriente(index)" class="btn btn-danger btn-sm re_diario"><i
                        class="fas fa-trash-alt"></i></a></span>
            </li>
        </div>
        </draggable> --}}
    </div>
    <div class="col-12">
        <table>
            <tbody>
                <tr>
                    <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL ACT. NO CORR.</td>
                    <td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(b_initotal.t_a_nocorriente) }}
                    </td>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody>
                <tr>
                    <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL ACTIVO.</td>
                    <td style="font-size: 20px;" class="badge-danger badge">
                        @{{ decimales(total_balance_inicial.t_activo) }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
<h2 class="text-center font-weight-bold text-danger">PASIVOS</h2>
<div class="row">
    <div class="col-7 ">
        <h3 class="text-primary">PASIVOS CORRIENTE <a data-toggle="tooltip" data-placement="top"
                title="Agregar Pasivo Corriente" @click="abrirPasivoC()" class="btn btn-sm btn-info text-light"><i
                    class="fa fa-plus"></i></a></h3>
        <draggable class="list-group list-group-flush" :list="p_corrientes" group="people" @change="cambioPasivo()">
            <div v-for="(element, index) in p_corrientes" :key="element.name">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    @{{ element.cuenta }}
                    <span class=" badge-pill">@{{ decimales(element.saldo) }} <a @click="editPcorriente(index)"
                            class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></a><a
                            @click="deletePaCooriente(index)" class="btn btn-danger btn-sm re_diario"><i
                                class="fas fa-trash-alt"></i></a></span>
                </li>
            </div>
        </draggable>
    </div>
    <div class="col-12">
        <table>
            <tbody>
                <tr>
                    <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL PAS. CORR.</td>
                    <td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(b_initotal.t_p_corriente) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br><br>
    <div class="col-7 ">
        <h3 class="text-primary">NO CORRIENTE <a data-toggle="tooltip" data-placement="top"
                title="Agregar Pasivo No Corriente" @click="abrirPasivoNoC()" class="btn btn-sm btn-info text-light"><i
                    class="fa fa-plus"></i></a></h3>
        <draggable class="list-group list-group-flush" :list="p_nocorrientes" group="people" @change="cambioPasivoNo()">
            <div v-for="(element, index) in p_nocorrientes" :key="element.name">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    @{{ element.cuenta }}
                    <span class=" badge-pill">@{{ decimales(element.saldo) }} <a @click="editPNocorriente(index)"
                            class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></a><a
                            @click="deletePaNoCooriente(index)" class="btn btn-danger btn-sm re_diario"><i
                                class="fas fa-trash-alt"></i></a></span>
                </li>
            </div>
        </draggable>
    </div>
    <div class="col-12">
        <table>
            <tbody>
                <tr>
                    <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL PAS. CORR.</td>
                    <td style="font-size: 20px;" class="badge-danger badge">
                        @{{ decimales(b_initotal.t_p_no_corriente) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br><br>
    <div class="col-12">
        <table>
            <tbody>
                <tr>
                    <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL PASIVO</td>
                    <td style="font-size: 20px;" class="badge-danger badge">
                        @{{ decimales(total_balance_inicial.t_pasivo) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<h2 class="text-center font-weight-bold text-danger">PATRIMONIO <a data-toggle="tooltip" data-placement="top"
        title="Agregar Patrimonio" @click="abrirPatrimonio()" class="btn btn-sm btn-info text-light"><i
            class="fa fa-plus"></i></a></h2>

<div class="row">
    <div class="col-7">
        <draggable class="list-group list-group-flush" :list="patrimonios" group="people" @change="cambioPatrimonio()">
            <div v-for="(element, index) in patrimonios" :key="element.name">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    @{{ element.cuenta }}
                    <span class="badge-pill">@{{ decimales(element.saldo) }} <a @click="editPatrimonio(index)"
                            class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></a><a
                            @click="deletePatrimonio(index)" class="btn btn-danger btn-sm re_diario"><i
                                class="fas fa-trash-alt"></i></a></span>
                </li>
            </div>
        </draggable>
    </div>
    <div class="col-12">
        <table>
            <tbody>
                <tr>
                    <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL PATRIMONIO.</td>
                    <td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(b_initotal.t_patrimonio) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-12">
        <table class="table table-borderless table-sm">
            <tbody>
                <tr>
                    <td class="font-weight-bold" style="font-size: 20px;">TOT. PAS. Y PATRI.</td>
                    <td width="250"><input autocomplete="ÑÖcompletes" type="number"
                            v-model="total_balance_inicial.t_patrimonio_pasivo" class="form-control text-right"></td>
                </tr>
            </tbody>
        </table>
        {{--  <button type="button" class="btn btn-sm  btn-block btn-outline-secondary" data-toggle="modal" data-target="#pasivo_patrimonio2">   
          TOTAL
        </button> --}}
    </div>
</div>
@if ($rol === 'estudiante' or 'docente')
<div class="row justify-content-center">
    <a class="btn p-2 mt-3 btn-outline-info" @click.prevent="guardarBalanceGeneral()">Guardar Balance General</a>
</div>
@endif
@include ('contabilidad.modales.modalbalancegeneral')
</div>