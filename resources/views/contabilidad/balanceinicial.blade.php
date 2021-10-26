{{-- BALANCE HORIZONTAL --}}
@if($datos->metodo == 'concatenado')
<div class="tab-pane fade  show active" id="b_horizontal" role="tabpanel" aria-labelledby="b_horizontal-tab">
    @elseif($datos->metodo == 'individual')
    <div class="tab-pane border border-danger p-3 fade @if ($datos->balance_inicial_horizontal == 1) show active @endif" id="b_horizontal" role="tabpanel" aria-labelledby="b_horizontal-tab">
        @endif
        {{-- <div class="row mb-2 p-sm-2">
            <div class="col-12">
                <table class="table table-sm ">
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm  btn-outline-primary" data-toggle="modal" data-target="#a_corriente"   @click="limpiar()">
                                Activo Corriente
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn  btn-sm btn-outline-primary" data-toggle="modal" data-target="#a_nocorriente"  @click="limpiar()">
                                Activo No Corriente
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn  btn-sm btn-outline-success" data-toggle="modal" data-target="#p_corriente" @click="limpiar()">
                                Pasivo Corriente
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm  btn-outline-success" data-toggle="modal" data-target="#p_nocorriente" @click="limpiar()">
                                Pasivo No Corriente
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm  btn-outline-secondary" data-toggle="modal" data-target="#patrimonio" @click="limpiar()">
                                Patrimonio
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> --}}
        <div class="row p-3  mb-2 justify-content-center ">
            <div class="col-6">
                <h2 align="center">Balance Inicial</h2>
            </div>
            <div class="col-8 mb-3">
                <input autocomplete="ÑÖcompletes" class="form-control text-center" type="text" v-model="balance_inicial.nombre"
                placeholder="Nombre de la empresa" name="">
            </div>
            <div class="col-5">
                <input autocomplete="ÑÖcompletes" class="form-control text-center" type="date" v-model="balance_inicial.fecha"
                placeholder="Agrega la fecha" name="">
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-6">
                <h3 class="text-danger">ACTIVOS</h3>
                <h3 class="text-primary">CORRIENTE <a data-toggle="tooltip" data-placement="top"
                    title="Agregar Activo Corriente" @click="abrirActivoC()" class="btn btn-sm btn-info text-light"><i
                class="fa fa-plus"></i></a></h3>
                <draggable class="list-group list-group-flush" :list="a_corrientes" group="people" @change="cambioActivo">
                <div v-for="(element, index) in a_corrientes" :key="element.name">
                    <li class="list-group-item d-flex justify-content-between align-items-center" style=" font-size:14px">
                        @{{ element.nom_cuenta }}
                        <!-- este boton es para editar y eliminar los datos -->
                        <span class="badge-pill">@{{ decimales(element.saldo) }} <a @click="editAcorriente(index)"
                        class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></a><a
                        @click="deleteAcCooriente(index)" class="btn btn-danger btn-sm re_diario"><i
                    class="fas fa-trash-alt"></i></a></span>
                </li>
            </div>
            </draggable>
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td width="250">TOTAL ACT. CORR.</td>
                        <td class="text-right"><span style="font-size: 20px; margin-left: 35px;"
                        class="badge badge-danger">@{{ decimales(b_initotal.t_a_corriente) }}</span></td>
                    </tr>
                </tbody>
            </table>
            <br><br>
            <h3 class="text-primary">NO CORRIENTE <a data-toggle="tooltip" data-placement="top"
                title="Agregar Activo No Corriente" @click="abrirActivoNoC()"
            class="btn btn-sm btn-info text-light"><i class="fa fa-plus"></i></a></h3>
            <draggable class="list-group list-group-flush" :list="a_nocorrientes" group="people"
            @change="cambioActivoNo()">
            <div v-for="(element, index) in a_nocorrientes" :key="element.name">
                <li class="list-group-item d-flex justify-content-between align-items-center" style=" font-size:14px">
                    @{{ element.nom_cuenta }}
                    <span class="badge-pill">@{{ decimales(element.saldo) }} <a @click="editNoAcorriente(index)"
                    class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></a><a
                    @click="deleteAcNoCooriente(index)" class="btn btn-danger btn-sm re_diario"><i
                class="fas fa-trash-alt"></i></a></span>
            </li>
        </div>
        </draggable>
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td width="250">TOTAL ACT. NO CORR.</td>
                    <td class="text-right"><span style="font-size: 20px; margin-left: 35px;"
                    class="badge badge-danger">@{{ decimales(b_initotal.t_a_nocorriente) }}</span></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-6">
        <h3 class="text-danger">PASIVO</h3>
        <h3 class="text-primary">CORRIENTE <a data-toggle="tooltip" data-placement="top"
            title="Agregar Pasivo Corriente" @click="abrirPasivoC()" class="btn btn-sm btn-info text-light"><i
        class="fa fa-plus"></i></a></h3>
        <draggable class="list-group list-group-flush" :list="p_corrientes" group="people" @change="cambioPasivo()">
        <div v-for="(element, index) in p_corrientes" :key="element.name">
            <li class="list-group-item d-flex justify-content-between align-items-center" style=" font-size:14px">
                @{{ element.nom_cuenta }}
                <span class=" badge-pill">@{{ decimales(element.saldo) }} <a @click="editPcorriente(index)"
                class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></a><a
                @click="deletePaCooriente(index)" class="btn btn-danger btn-sm re_diario"><i
            class="fas fa-trash-alt"></i></a></span>
        </li>
    </div>
    </draggable>
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td width="250">TOTAL PAS. CORR.</td>
                <td class="text-right"><span style="font-size: 20px; margin-left: 35px;"
                class="badge badge-danger">@{{ decimales(b_initotal.t_p_corriente) }}</span></td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <h3 class="text-primary">NO CORRIENTE <a data-toggle="tooltip" data-placement="top"
        title="Agregar Pasivo No Corriente" @click="abrirPasivoNoC()"
    class="btn btn-sm btn-info text-light"><i class="fa fa-plus"></i></a></h3>
    <draggable class="list-group list-group-flush" :list="p_nocorrientes" group="people"
    @change="cambioPasivoNo()">
    <div v-for="(element, index) in p_nocorrientes" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center" style=" font-size:14px">
            @{{ element.nom_cuenta }}
            <span class=" badge-pill">@{{ decimales(element.saldo) }} <a @click="editPNocorriente(index)"
            class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></a><a
            @click="deletePaNoCooriente(index)" class="btn btn-danger btn-sm re_diario"><i
        class="fas fa-trash-alt"></i></a></span>
    </li>
</div>
</draggable>
<table class="table table-borderless">
    <tbody>
        <tr>
            <td width="250">TOTAL PAS. CORR.</td>
            <td class="text-right"> <span style="font-size: 20px; margin-left: 35px;"
            class="badge badge-danger">@{{ decimales(b_initotal.t_p_no_corriente) }}</span></td>
        </tr>
    </tbody>
</table>
<br><br>
<table class="table table-borderless">
    <tbody>
        <tr>
            <td class="font-weight-bold" width="250">TOTAL PASIVO</td>
            <td class="text-right"><span style="font-size: 20px; margin-left: 35px;"
            class="badge badge-danger">@{{ decimales(total_balance_inicial.t_pasivo) }}</span></td>
        </tr>
    </tbody>
</table>
<br><br>
<h3 class="text-danger">PATRIMONIO <a data-toggle="tooltip" data-placement="top" title="Agregar Patrimonio"
@click="abrirPatrimonio()" class="btn btn-sm btn-info text-light"><i class="fa fa-plus"></i></a>
</h3>
<draggable class="list-group list-group-flush" :list="patrimonios" group="people"
@change="cambioPatrimonio()">
<div v-for="(element, index) in patrimonios" :key="element.name">
    <li class="list-group-item d-flex justify-content-between align-items-center" style=" font-size:14px">
        @{{ element.nom_cuenta }}
        <span class="badge-pill">@{{ decimales(element.saldo) }} <a @click="editPatrimonio(index)"
        class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></a><a
        @click="deletePatrimonio(index)" class="btn btn-danger btn-sm re_diario"><i
    class="fas fa-trash-alt"></i></a></span>
</li>
</div>
</draggable>
<table class="table table-borderless">
<tbody>
    <tr>
        <td width="250">TOTAL PATRIMONIO.</td>
        <td class="text-right"> <span style="font-size: 20px; margin-left: 35px;"
        class="badge badge-danger">@{{ decimales(b_initotal.t_patrimonio) }}</span></td>
    </tr>
</tbody>
</table>
</div>
</div>
<div class="row justify-content-between">
<div class="col-6">
<table class="table table-borderless">
<tbody>
    <tr>
        <td class="font-weight-bold" style="font-size: 20px;" width="250">TOTAL ACTIVO.</td>
        <td class="text-right"><span style="font-size: 20px; margin-left: 35px;"
        class="badge badge-danger text-right">@{{ decimales(total_balance_inicial.t_activo) }}</span></td>
    </tr>
</tbody>
</table>
</div>
<div class="col-6">
<table class="table table-borderless">
<tbody>
    <tr>
        <td class="font-weight-bold" style="font-size: 20px;" width="200">TOT. PAS. Y PATRI.</td>
        <td class="text-right"><input autocomplete="ÑÖcompletes" type="number"
            v-model="total_balance_inicial.t_patrimonio_pasivo"
        class="form-control text-right font-weight-bold"></td>
    </tr>
</tbody>
</table>
{{--    <button type="button" class="btn btn-sm  btn-block btn-outline-secondary" data-toggle="modal" data-target="#pasivo_patrimonio">
TOTAL
</button> --}}
</div>
</div>
@if ($rol === 'estudiante' or 'docente')
<div class="row justify-content-center">
<a class="btn p-2 mt-3 btn-outline-info" @click.prevent="guardarBalanceInicial()">Guardar Balance Inicial</a>
</div>
@endif
@include ('contabilidad.modales.modalbalanceinicialhorizontal')
{{-- @include ('contabilidad.modalbhorizontal') --}}
</div>



{{-- BALANCE VERTICAL --}}
@if($datos->metodo == 'concatenado')
<div class="tab-pane fade" id="b_vertical" role="tabpanel" aria-labelledby="b_vertical-tab">
@elseif($datos->metodo == 'individual')
<div class="tab-pane border border-danger p-3  fade @if ($datos->balance_inicial_vertical == 1) show active @endif" id="b_vertical" role="tabpanel" aria-labelledby="b_vertical-tab">
@endif
{{--       <div class="row mb-2 p-sm-2">
<div class="col-12">
<table class="table table-sm ">
    <tbody>
        <tr>
            <td>
                <button type="button" class="btn btn-sm  btn-outline-primary" data-toggle="modal" data-target="#a_corriente2"   @click="limpiar()">
                Activo Corriente
                </button>
            </td>
            <td>
                <button type="button" class="btn  btn-sm btn-outline-primary" data-toggle="modal" data-target="#a_nocorriente2"  @click="limpiar()">
                Activo No Corriente
                </button>
            </td>
            <td>
                <button type="button" class="btn  btn-sm btn-outline-success" data-toggle="modal" data-target="#p_corriente2" @click="limpiar()">
                Pasivo Corriente
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-sm  btn-outline-success" data-toggle="modal" data-target="#p_nocorriente2" @click="limpiar()">
                Pasivo No Corriente
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-sm  btn-outline-secondary" data-toggle="modal" data-target="#patrimonio2" @click="limpiar()">
                Patrimonio
                </button>
            </td>
        </tr>
    </tbody>
</table>
</div>
</div> --}}
<div class="row p-3  mb-2 justify-content-center ">
<div class="col-8">
<h2 align="center">Balance Inicial</h2>
</div>
<div class="col-8 mb-3">
<input autocomplete="ÑÖcompletes" class="form-control text-center" type="text" v-model="balance_inicial.nombre"
placeholder="Nombre de la empresa" name="">
</div>
<div class="col-5">
<input autocomplete="ÑÖcompletes" class="form-control text-center" type="date" v-model="balance_inicial.fecha"
placeholder="Agrega la fecha" name="">
</div>
</div>
<h2 class="text-center font-weight-bold text-danger">ACTIVOS</h2>
<div class="row">
<div class="col-7">
<h3 class="text-primary">ACTIVOS CORRIENTE <a data-toggle="tooltip" data-placement="top"
    title="Agregar Activo Corriente" @click="abrirActivoC()" class="btn btn-sm btn-info text-light"><i
class="fa fa-plus"></i></a></h3>
<draggable class="list-group list-group-flush" :list="a_corrientes" group="people" @change="cambioActivo">
<div v-for="(element, index) in a_corrientes" :key="element.name">
    <li class="list-group-item d-flex justify-content-between align-items-center">
        @{{ element.nom_cuenta }}<span class="badge-pill">@{{ decimales(element.saldo) }} <a
            @click="editAcorriente(index)" class="btn btn-warning btn-sm mr-1"><i
        class="fas fa-edit"></i></a><a @click="deleteAcCooriente(index)"
    class="btn btn-danger btn-sm re_diario"><i class="fas fa-trash-alt"></i></a></span>
</li>
</div>
</draggable>
</div>
<div class="col-12">
<table>
<tbody>
    <tr>
        <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL ACT. CORR.</td>
        <td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(b_initotal.t_a_corriente) }}</td>
    </tr>
</tbody>
</table>
</div>
<div class="col-7">
<h3 class="text-primary">ACTIVOS NO CORRIENTE <a data-toggle="tooltip" data-placement="top"
title="Agregar Activo No Corriente" @click="abrirActivoNoC()"
class="btn btn-sm btn-info text-light"><i class="fa fa-plus"></i></a></h3>
<draggable class="list-group list-group-flush" :list="a_nocorrientes" group="people"
@change="cambioActivoNo()">
<div v-for="(element, index) in a_nocorrientes" :key="element.name">
<li class="list-group-item d-flex justify-content-between align-items-center">
    @{{ element.nom_cuenta }}
    <span class="badge-pill">@{{ decimales(element.saldo) }} <a @click="editNoAcorriente(index)"
    class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></a><a
    @click="deleteAcNoCooriente(index)" class="btn btn-danger btn-sm re_diario"><i
class="fas fa-trash-alt"></i></a></span>
</li>
</div>
</draggable>
</div>
<div class="col-12">
<table class="table table-sm table-borderless">
<tbody>
<tr>
    <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL ACT. NO CORR.</td>
    <td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(b_initotal.t_a_nocorriente) }}</td>
</tr>
</tbody>
</table>
<table>
<tbody>
<tr>
    <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL ACTIVO.</td>
    <td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(total_balance_inicial.t_activo) }}
    </td>
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
@{{ element.nom_cuenta }}
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
<td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(b_initotal.t_p_corriente) }}</td>
</tr>
</tbody>
</table>
</div>
<br><br>
<div class="col-7 ">
<h3 class="text-primary">NO CORRIENTE <a data-toggle="tooltip" data-placement="top"
title="Agregar Pasivo No Corriente" @click="abrirPasivoNoC()"
class="btn btn-sm btn-info text-light"><i class="fa fa-plus"></i></a></h3>
<draggable class="list-group list-group-flush" :list="p_nocorrientes" group="people"
@change="cambioPasivoNo()">
<div v-for="(element, index) in p_nocorrientes" :key="element.name">
<li class="list-group-item d-flex justify-content-between align-items-center">
@{{ element.nom_cuenta }}
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
<td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(b_initotal.t_p_no_corriente) }}</td>
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
<td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(total_balance_inicial.t_pasivo) }}
</td>
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
<draggable class="list-group list-group-flush" :list="patrimonios" group="people"
@change="cambioPatrimonio()">
<div v-for="(element, index) in patrimonios" :key="element.name">
<li class="list-group-item d-flex justify-content-between align-items-center">
@{{ element.nom_cuenta }}
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
<td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(b_initotal.t_patrimonio) }}</td>
</tr>
</tbody>
</table>
</div>
<div class="col-12">
<table class="table table-borderless table-sm">
<tbody>
<tr>
<td class="font-weight-bold" style="font-size: 20px;" width="950">TOT. PAS. Y PATRI.</td>
<td width="250" class="text-right"><input autocomplete="ÑÖcompletes" type="number"
v-model="total_balance_inicial.t_patrimonio_pasivo"
class="form-control text-right font-weight-bold"></td>
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
<a class="btn p-2 mt-3 btn-outline-info" @click.prevent="guardarBalanceInicial()">Guardar Balance Inicial</a>
</div>
@endif
{{-- @include ('contabilidad.modalbvertical') --}}
@include ('contabilidad.modales.modalbalanceinicialvertical')
</div>