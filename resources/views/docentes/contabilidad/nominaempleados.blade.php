<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="ne-nomina-tab" data-toggle="tab" href="#ne-nomina" role="tab"
            aria-controls="ne-nomina" aria-selected="true">Nomina de empleados</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="ne-provision-tab" data-toggle="tab" href="#ne-provision" role="tab"
            aria-controls="ne-provision" aria-selected="false">Provision de beneficios</a>
    </li>
</ul>
<div class="tab-content border border-danger p-3" id="myTabContent">
    <div class="tab-pane fade show active " id="ne-nomina" role="tabpanel" aria-labelledby="ne-nomina-tab">
        <div id="nomina_empleado">
            <h1 class="text-center text-danger font-weight-bold mt-2">Nómina Empleados</h1>
            <div class="row p-4  mb-3 justify-content-center ">
                <div class="col-5 mb-3">
                    <h3 class="text-center font-weight-bold display-4">@{{ nombre }}</h3>
                    <h3 class="text-center font-weight-bold display-4">@{{ fecha }}</h3>
                </div>
            </div>
            <table class="table table-bordered table-sm">
                <thead class="bg-dark">
                    <tr>
                        <th class="text-center " style="vertical-align: middle;">EMPLEADOS</th>
                        <th class="text-center" style="vertical-align: middle;">CARGO</th>
                        <td class="text-center" width="125">SUELDO</td>
                        <td class="text-center" width="125">SOBRE TIEMPO</td>
                        <td class="text-center" style="vertical-align: middle;">T. INGRESOS</td>
                        <td class="text-center" width="125">IESS 9.45%</td>
                        <th class="text-center" style="vertical-align: middle;">PREST.IESS</th>
                        <th class="text-center" style="vertical-align: middle;">PREST.CIA</th>
                        <th class="text-center" style="vertical-align: middle;">ANTIC.</th>
                        <th class="text-center" style="vertical-align: middle;">IMP. RENTA</th>
                        <th class="text-center" style="vertical-align: middle;">T.EGRESOS</th>
                        <th class="text-center" style="vertical-align: middle;">V.NETO A PAGAR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(n, index) in t_nomina">
                        <td align="left" width="300">@{{ n.nombre_e}}</td>
                        <td align="left" width="100">@{{ n.cargo}}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(n.sueldo)}}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(n.s_tiempo)}}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(n.ingresos)}}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(n.iees)}}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(n.pres_iees)}}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(n.pres_cia)}}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(n.anticipo)}}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(n.imp_renta)}}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(n.egresos)}}</td>
                        <td class="text-right" align="center" width="125">@{{ decimales(n.neto_pagar)}}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">TOTALES</td>
                        <td class="text-right"></td>
                        <td class="text-right">@{{ suma.s_sueldo }}</td>
                        <td class="text-right">@{{ suma.s_sobretiempo}}</td>
                        <td class="text-right">@{{ suma.s_tingreso }}</td>
                        <td class="text-right">@{{ suma.s_iess }}</td>
                        <td class="text-right">@{{ suma.s_piess }}</td>
                        <td class="text-right">@{{ suma.s_pcias }}</td>
                        <td class="text-right">@{{ suma.s_anticipo }}</td>
                        <td class="text-right">@{{ suma.s_impr }}</td>
                        <td class="text-right">@{{ suma.s_tegresos }}</td>
                        <td class="text-right">@{{ suma.s_netopagar }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="ne-provision" role="tabpanel" aria-labelledby="ne-provision-tab">
        @include ('docentes.contabilidad.provisiondebeneficio')
    </div>
</div>