<div id="conciliacionb" class="border border-danger p-4">
    <h1 class="text-center text-danger font-weight-bold mt-2">Conciliación Bancaria</h1>
    <div class="row p-3  mb-2 justify-content-center ">
        <div class="col-8 mb-3">
            <h3 class="text-center font-weight-bold display-4">@{{ nombre }}</h3>
        </div>
        <div class="col-5">
            <h3 class="text-center font-weight-bold display-4">@{{ fecha }}</h3>
        </div>
    </div>
    <br><br>
    <div class="row justify-content-around mb-2">
        <div class="col col-lg-5">
            <h3 class="text-center font-weight-bold display-4">@{{ n_banco }}</h3>
        </div>
    </div>
    <br>
    <h2></h2>
    <div class="row">
        <div class="col-7">
            <h3 class="text-left font-weight-bold text-danger">SALDO</h3>
            <draggable class="list-group list-group-flush" :list="c_saldos" group="people">
            <div v-for="(element, index) in c_saldos" :key="element.name">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="badge-pill"> @{{formatoFecha(element.fecha)}}</span> @{{ element.detalle }}<span
                class="badge-pill">@{{ decimales(element.saldo) }}</span>
            </li>
        </div>
        </draggable>
    </div>
    <div class="col-12">
        <table>
            <tbody>
                <tr v-for="(element, index) in c_saldos" :key="element.name">
                    <td class="font-weight-bold" style="font-size: 20px;" width="2000"></td>
                    <td style="font-size: 20px;" class="badge-success badge">@{{ decimales(element.saldo) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<h2></h2>
    <div class="row">
        <div class="col-7">
            <h3 class="text-left font-weight-bold text-danger"> + DEPÓSITOS NO ACREDITADOS POR EL BANCO</h3>
            <draggable class="list-group list-group-flush" :list="c_depositos" group="people">
                <div v-for="(element, index) in c_depositos" :key="element.name">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="badge-pill"> @{{formatoFecha(element.fecha)}}</span> @{{ element.detalle }}<span
                            class="badge-pill">@{{ decimales(element.saldo) }} </span>
                    </li>
                </div>
            </draggable>
        </div>
        <div class="col-12">
            <table>
                <tbody>
                    <tr>
                        <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL DEPÓSITOS. NO ACREDITADOS</td>
                        <td style="font-size: 20px;" class="badge-success badge"> + @{{ decimales(suman.saldo_depositos) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <h2></h2>
<div class="row">
    <div class="col-7">
        <h3 class="text-left font-weight-bold text-danger"> + DÉBITOS BANCARIOS NO CONTABILIZADOS</h3>
        <draggable class="list-group list-group-flush" :list="c_debitos" group="people">
        <div v-for="(element, index) in c_debitos" :key="element.name">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="badge-pill"> @{{formatoFecha(element.fecha)}}</span> @{{ element.detalle }}<span
            class="badge-pill">@{{ decimales(element.saldo) }}</span>
        </li>
    </div>
    </draggable>
</div>
<div class="col-12">
    <table>
        <tbody>
            <tr>
                <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL DÉB. BANCARIOS</td>
                <td style="font-size: 20px;" class="badge-success badge"> + @{{ decimales(suman.saldo_d) }}</td>
            </tr>
        </tbody>
    </table>
</div>
</div>
<h2></h2>
<div class="row">
<div class="col-7">
    <h3 class="text-left font-weight-bold text-danger"> - CRÉDITOS BANCARIOS NO CONTABILIZADOS
    </h3>
    <draggable class="list-group list-group-flush" :list="c_creditos" group="people">
    <div v-for="(element, index) in c_creditos" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="badge-pill"> @{{formatoFecha(element.fecha)}}</span> @{{ element.detalle }}<span
        class="badge-pill">@{{ decimales(element.saldo) }}</span>
    </li>
</div>
</draggable>
</div>
<div class="col-12">
<table>
    <tbody>
        <tr>
            <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL CRÉD. BANCARIOS</td>
            <td style="font-size: 20px;" class="badge-success badge">-@{{ decimales(suman.saldo_c) }}</td>
        </tr>
    </tbody>
</table>
</div>
</div>
<h2></h2>
<div class="row">
<div class="col-7">
<h3 class="text-left font-weight-bold text-danger"> - CHEQUES GIRADOS Y NO COBRADOS
</h3>
<draggable class="list-group list-group-flush" :list="c_cheques" group="people">
<div v-for="(element, index) in c_cheques" :key="element.name">
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span class="badge-pill"> @{{formatoFecha(element.fecha)}}</span> @{{ element.detalle }}<span
    class="badge-pill">@{{ decimales(element.saldo) }}</span>
</li>
</div>
</draggable>
</div>
<div class="col-12">
<table>
<tbody>
    <tr>
        <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL CHEQ. BANCARIOS</td>
        <td style="font-size: 20px;" class="badge-success badge">-@{{ decimales(suman.saldo_ch) }}</td>
    </tr>
</tbody>
</table>
</div>
</div>
<h2></h2>
<div class="row">
<div class="col-12">
<table>
<tbody>
    <tr>
        <td class="font-weight-bold" style="font-size: 20px;" width="2000">SALDO EN LIBRO BANCO</td>
        <td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(suman.total) }}</td>
    </tr>
</tbody>
</table>
</div>
</div>
</div>