<div id="provision_beneficio">
    <h1 class="text-center text-danger font-weight-bold mt-2">PROVISIÓN DE BENEFICIOS SOCIALES</h1>
    @if ($rol === 'estudiante' or 'docente')
    <a href="#" class="addDiario btn btn-outline-info " @click.prevent="abrirProvision()">Agregar Provisión</a>

    <a href="#" class="addDiario btn btn-outline-success ml-1" @click.prevent="guardarProvision()">Guardar Provisión</a>
    @endif
    <div class="row p-3  mb-2 ">
        <br><br>
        <div class="col-12">
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
                        <th width="50" colspan="2" v-if="t_pro.length > 0">ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(p , index) in t_pro">
                        <td class="text-left" align="center" width="300">@{{ p.nombre_em}}</td>
                        <td class="text-right" align="center" width="100">@{{ p.dias}}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(p.v_recibido) }}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(p.d_tercero) }}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(p.d_cuarto) }}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(p.vacaciones) }}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(p.f_reserva) }}</td>
                        <td align="center" width="50"><a @click.prevent="editProvisionFuera(index)"
                                class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                        <td align="center" width="50"><a @click.prevent="WarningEliminarProvision(index)"
                                class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <tr>

                        <td class="font-weight-bold">TOTALES</td>
                        <td></td>
                        <td class="text-right">@{{ suma.s_valor}}</td>
                        <td class="text-right">@{{ suma.s_tercero}}</td>
                        <td class="text-right">@{{ suma.s_cuarto}}</td>
                        <td class="text-right">@{{ suma.s_vacaciones}}</td>
                        <td class="text-right">@{{ suma.s_res}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @if ($rol === 'estudiante' or 'docente')

    <div class="row justify-content-center mb-2">
        <a href="#" class="addDiario btn btn-outline-info " @click.prevent="abrirProvision()">Agregar Provisión</a>
    </div>

    <div class="row justify-content-center">
        <a href="#" class="addDiario btn btn-outline-success " @click.prevent="guardarProvision()">Guardar
            Provisión de Beneficio</a>
    </div>
    @endif
    @include ('contabilidad.modalprovision')
</div>