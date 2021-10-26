<!-- Arqueo Caja Correción  -->
<div id="arqueo_caja" class="border border-danger p-4">
    <h2 class="text-center display-4 font-weight-bold text-danger">Anexos de Control Interno</h2>
    <h2 class="text-center display-4 font-weight-bold text-danger">Arqueo de Caja</h2>
    <div class="form-row mb-3 justify-content-center">
    </div>
    <br>
    <table style="border: hidden" class="table table-bordered table-sm mb-2">
        <thead>
            <tr style="border: hidden" class="text-center bg-dark">
                <th style="border: hidden; color:red" width="500"></th>
                <th style="border: hidden" align="right"><em>
                    <h5>Debe</h5>
                </em></th>
                <th style="border: hidden" align="right"><em>
                    <h5>Haber</h5>
                </em></th>
            </tr>
        </thead>
        <tbody group="people" :list="t_saldo" tag="tbody" style="border: hidden">
            <tr style="border: hidden" v-for="(s, index) in t_saldo">
                <td style="border: hidden;">@{{s.detalle}}</td>
                <td style="border: hidden" align="center">@{{decimales(s.s_debe)}}</td>
                <td style="border: hidden" align="center">@{{decimales(s.s_haber)}}</td>
            </tr>
        </tbody>
        <td style="border: hidden"><em>Existencia física al momento del arqueo:</em></td>
        <td style="border: hidden"></td>
        <td style="border: hidden"></td>
        
        <tbody is="draggable" group="people" :list="t_exis" tag="tbody">
            <tr style="border: hidden" v-for="(e, index) in t_exis">
                <td style="padding-left:50px">@{{e.detalle}}</td>
                <td style="border: hidden" align="center">@{{decimales(e.e_debe)}}</td>
                <td style="border: hidden" align="center">@{{decimales(e.e_haber)}}</td>
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
</div>