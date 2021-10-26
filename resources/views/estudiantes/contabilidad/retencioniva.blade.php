<div id="retencion_iva" class="border border-danger p-4">
    <h2 class="text-center display-4 font-weight-bold text-danger"> CUADRO DE RETENCIÓN EN LA FUENTE DEL IVA</h2>
    <div class="row p-3  mb-2 justify-content-center ">
        <div class="col-5 mb-3">
            <h3 class="text-center font-weight-bold display-4">@{{ nombre_c }}</h3>
            <h3 class="text-center font-weight-bold display-4">@{{ contribuyente }}</h3>
            <h3 class="text-center font-weight-bold display-4">@{{ ruc }}</h3>
            <h3 class="text-center font-weight-bold display-4">@{{ fecha }}</h3>
        </div>
    </div>
    <h3 class="text-center font-weight-bold text-danger">COMPRAS</h3>
    <table class="table table-bordered table-sm">
        <thead class="bg-dark">
            <tr>
                <th class="text-center " style="vertical-align: middle;" rowspan="2">FECHA</th>
                <th class="text-center " style="vertical-align: middle;" rowspan="3">COMPRA DE BIENES Y SERVICIOS</th>
                <th class="text-center " style="vertical-align: middle;" rowspan="2">PROVEEDOR</th>
                <th class="text-center" style="vertical-align: middle;" colspan="3">RETENCIÓN EN LA FUENTE</th>
                <th class="text-center " style="vertical-align: middle;" rowspan="2">IVA</th>
                <th class="text-center" style="vertical-align: middle;" colspan="5">RETENCIÓN DEL IVA</th>
                </th>
            </tr>
            <tr>
                <td class="text-center" width="125">BASE IMPONIBLE</td>
                <td class="text-center" width="125">%</td>
                <td class="text-center" width="125">VALOR RETENIDO</td>
                <td class="text-center" width="125">10%</td>
                <td class="text-center" width="125">20%</td>
                <td class="text-center" width="125">30%</td>
                <td class="text-center" width="125">70%</td>
                <td class="text-center" width="125">100%</td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(c , index) in t_compras">
                <td class="text-right" align="center" width="125">@{{ formatoFecha(c.fecha_c)}}</td>
                <td class="text-left" align="center" width="300">@{{ c.detalle}}</td>
                <td class="text-left" align="center" width="100">@{{ c.proveedor}}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(c.base_im) }}</td>
                <td class="text-right" align="center" width="100">@{{ c.porcentaje }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(c.v_retenido) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(c.iva) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(c.ret_10) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(c.ret_20) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(c.ret_30) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(c.ret_70) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(c.ret_100) }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="font-weight-bold">SUMAN</td>
                <td class="text-right"></td>
                <td class="text-right">@{{ suma_c.suma_base }}</td>
                <td></td>
                <td class="text-right">@{{ suma_c.suma_reten}}</td>
                <td class="text-right">@{{ suma_c.suma_ivac }}</td>
                <td class="text-right">@{{ suma_c.suma_10 }}</td>
                <td class="text-right">@{{ suma_c.suma_20 }}</td>
                <td class="text-right">@{{ suma_c.suma_30 }}</td>
                <td class="text-right">@{{ suma_c.suma_70 }}</td>
                <td class="text-right">@{{ suma_c.suma_100 }}</td>
            </tr>
        </tbody>
    </table>
    {{-- VENTAS DE RETENCION DEL IVA--}}
    <br><br>
    <h3 class="text-center font-weight-bold text-danger">VENTAS</h3>
    <table class="table table-bordered table-sm">
        <thead class="bg-dark">
            <tr>
                <th class="text-center " style="vertical-align: middle;" rowspan="2">FECHA</th>
                <th class="text-center " style="vertical-align: middle;" rowspan="3">VENTA DE BIENES Y SERVICIOS</th>
                <th class="text-center " style="vertical-align: middle;" rowspan="2">CLIENTE</th>
                <th class="text-center" style="vertical-align: middle;" colspan="3">RETENCIÓN EN LA FUENTE</th>
                <th class="text-center " style="vertical-align: middle;" rowspan="2">IVA</th>
                <th class="text-center" style="vertical-align: middle;" colspan="5">RETENCIÓN DEL IVA</th>
                </th>
            </tr>
            <tr>
                <td class="text-center" width="125">BASE IMPONIBLE</td>
                <td class="text-center" width="125">%</td>
                <td class="text-center" width="125">VALOR RETENIDO</td>
                <td class="text-center" width="125">10%</td>
                <td class="text-center" width="125">20%</td>
                <td class="text-center" width="125">30%</td>
                <td class="text-center" width="125">70%</td>
                <td class="text-center" width="125">100%</td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(v , index) in t_ventas">
                <td class="text-right" align="center" width="125">@{{ formatoFecha(v.fecha_v)}}</td>
                <td class="text-left" align="center" width="300">@{{ v.detalle}}</td>
                <td class="text-left" align="center" width="100">@{{ v.cliente}}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(v.base_im) }}</td>
                <td class="text-right" align="center" width="100">@{{ v.porcentaje }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(v.v_retenido) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(v.iva) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(v.ret_10) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(v.ret_20) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(v.ret_30) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(v.ret_70) }}</td>
                <td class="text-right" align="center" width="125">@{{ decimales(v.ret_100) }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="font-weight-bold">SUMAN</td>
                <td class="text-right"></td>
                <td class="text-right">@{{ suma_v.suma_base }}</td>
                <td></td>
                <td class="text-right">@{{ suma_v.suma_reten}}</td>
                <td class="text-right">@{{ suma_v.suma_ivav }}</td>
                <td class="text-right">@{{ suma_v.suma_10 }}</td>
                <td class="text-right">@{{ suma_v.suma_20 }}</td>
                <td class="text-right">@{{ suma_v.suma_30 }}</td>
                <td class="text-right">@{{ suma_v.suma_70 }}</td>
                <td class="text-right">@{{ suma_v.suma_100 }}</td>
            </tr>
        </tbody>
    </table>
    <div class="row p-4  mb-4 justify-content-center ">
        <table>
            <tbody>
                <tr>
                    <td> <label for="inputEmail3" class="col-sm col-form-label">IVA EN VENTAS</label></td>
                    <td>
                        <div class="col-sm-8">
                            <input disabled="" class="form-control  text-right  form-control-sm" type="number"
                                step="0.01" v-model="total.t_ivaventa" placeholder="0,00" name="">
                        </div>
                    </td>

                </tr>
            </tbody>
            <tbody>
                <tr>

                    <td><label for="inputEmail3" class="col-sm col-form-label"> -IVA EN COMPRAS</label></td>
                    <td>

                        <div class="col-sm-8">
                            <input disabled="" class="form-control  text-right  form-control-sm" type="number"
                                step="0.01" v-model="total.t_ivacompra" placeholder="0,00" name="">
                        </div>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td> <label for="inputEmail3" class="col-sm col-form-label"></label></td>
                    <td>
                        <div class="col-sm-8">
                            <input disabled="" class="form-control  text-right  form-control-sm" type="number"
                                step="0.01" v-model="total.result_iva" placeholder="0,00" name="">
                        </div>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td><label for="inputEmail3" class="col-sm col-form-label"> + RET. IVA</label></td>
                    <td>

                        <div class="col-sm-8">
                            <input disabled="" class="form-control  text-right  form-control-sm" type="number"
                                step="0.01" v-model="total.t_reten" placeholder="0,00" name="">
                        </div>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td><label for="inputEmail3" class="col-sm col-form-label"> TOTAL A PAGAR</label></td>
                    <td>
                        <div class="col-sm-8">
                            <input disabled="" class="form-control  text-right  form-control-sm" type="number"
                                step="0.01" v-model="total.total_pagar" placeholder="0,00" name="">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <br>
</div>