<!-- Arqueo Caja Correción  -->

<div id="arqueo_caja" class="border border-danger p-4">
    <h2 class="text-center display-4 font-weight-bold text-danger">Anexos de Control Interno</h2>
    <h2 class="text-center display-4 font-weight-bold text-danger">Arqueo de Caja</h2>

    <br>
    @if ($rol === 'estudiante' or 'docente')
    <a href="#" class="addDiario btn btn-outline-info " @click.prevent="abrirArqueo()">Agregar Existencias</a>
    <a href="#" class="addDiario btn btn-outline-success ml-1 " @click.prevent="guardaArqueo()">Guardar Arqueo Caja</a>
    @endif

    <table style="border: hidden" class="table table-bordered table-sm mt-2 mb-2">
        <thead>
            <tr style="border: hidden" class="text-center bg-dark">
                <th style="border: hidden; color:red" width="500"></th>
                <th style="border: hidden" align="right"><em>
                        <h5>Debe</h5>
                    </em></th>
                <th style="border: hidden" align="right"><em>
                        <h5>Haber</h5>
                    </em></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody group="people" :list="t_saldo" tag="tbody" style="border: hidden">
            <tr style="border: hidden" v-for="(s, index) in t_saldo">
                <td style="border: hidden;">@{{s.detalle}}</td>
                <td style="border: hidden" align="right">@{{decimales(s.s_debe)}}</td>
                <td style="border: hidden" align="right">@{{decimales(s.s_haber)}}</td>

                <td style="border: hidden" align="center" width="50">
                    <a @click.prevent="editSaldoFuera(index)" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td style="border: hidden" align="center" width="50">
                    <a @click.prevent="WarningEliminarSaldo(index)" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>

            </tr>
        </tbody>
        <td style="border: hidden"><em>Existencia física al momento del arqueo:</em></td>
        <td style="border: hidden"></td>
        <td style="border: hidden"></td>
        <td style="border: hidden"></td>
        <td style="border: hidden"></td>

        <tbody is="draggable" group="people" :list="t_exis" tag="tbody">
            <tr style="border: hidden" v-for="(e, index) in t_exis">
                <td style="padding-left:50px">@{{e.detalle}}</td>
                <td style="border: hidden" align="right">@{{decimales(e.e_debe)}}</td>
                <td style="border: hidden" align="right">@{{decimales(e.e_haber)}}</td>
                <td style="border: hidden" align="center" width="50">
                    <a @click.prevent="editExisFuera(index)" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td style="border: hidden" align="center" width="50">
                    <a @click.prevent="WarningEliminarExis(index)" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr class="bg-secondary">
                <td class="text-left font-weight-bold">SUMAN</td>
                <td class="text-right font-weight-bold">@{{sumas.td}}</td>
                <td class="text-right font-weight-bold">@{{sumas.th}}</td>
            </tr>

        </tbody>
    </table>
    
    <br><br>
    @if ($datos->metodo == 'individual')

    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <table class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th width="200"></th>
                            <th class="text-left">DATOS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <label for="inputEmail3" class="col-sm col-form-label">Saldo de Cta. Caja</label></td>
                            <td>
                                <div class="col-sm-10">
                                    <input class="form-control  text-right  form-control-sm" type="number" step="0.01"
                                    v-model="pruebas.saldo_ctcaja"  placeholder="Saldo cta Caja" >
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td> <label for="inputEmail3" class="col-sm col-form-label">Arqueo Caja</label></td>
                            <td>
                                <div class="col-sm-10">
                                    <input class="form-control  text-right  form-control-sm" type="number" step="0.01"
                                    v-model="pruebas.saldo_arqueocaja" placeholder="Arqueo Caja" name="">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>
                                <select  v-model="pruebas.select_resultado" class="custom-select custom-select-sm">
                                    <option selected>Seleccione </option>
                                    <option value="1">Saldo Correcto</option>
                                    <option value="2">Saldo Faltante</option>
                                    <option value="3">Saldo Sobrante</option>
                                </select>
                            </td>
                            <td>
                                <div class="col-sm-10">
                                    <input class="form-control  text-right  form-control-sm" type="number" step="0.01"
                                    v-model="pruebas.select_valor" placeholder="valor" name="">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm">
                <table class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th width="200">Contabilizar:</th>
                            <th class="text-center">DEBE</th>
                            <th class="text-center ">HABER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left" width="300"><input class="form-control form-control-sm" type="text"
                            v-model="pruebas.cuenta1"  placeholder="cuenta"></td>
                            <td  width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="pruebas.valor1"
                            placeholder="valor" class="form-control form-control-sm text-right"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="text-left" width="300"><input class="form-control form-control-sm" type="text"
                            v-model="pruebas.cuenta2"  placeholder="cuenta"></td>
                            <td></td>
                            <td width="125"><input autocomplete="ÑÖcompletes" type="number" v-model="pruebas.valor2"
                            placeholder="valor"  class="form-control form-control-sm text-right text-right"></td>
                        </tr>

                    </tbody>
                </table>

            </div>

        </div>
    </div>

    @endif

    @if ($rol === 'estudiante' or 'docente')
    <div class="row justify-content-center mb-2">
        <a href="#" class="addDiario btn btn-outline-info " @click.prevent="abrirArqueo()">Agregar Existencias</a>
    </div>

    <div class="row justify-content-center">
        <a href="#" class="addDiario btn btn-outline-success " @click.prevent="guardaArqueo()">Guardar Arqueo Caja</a>
    </div>
    <br>
    @endif

    @include ('contabilidad.modalarqueocaja')
</div>