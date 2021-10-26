<div id="provision_beneficio">
    <h1 class="text-center text-danger font-weight-bold mt-2">PROVISIÓN DE BENEFICIOS SOCIALES</h1>
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
</div>