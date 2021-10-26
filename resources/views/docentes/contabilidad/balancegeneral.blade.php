<div id="balance_general" class="border border-danger p-4">
  <h2 class="text-center display-4 font-weight-bold text-danger">Balance General</h2>
  <div class="row p-3 justify-content-center ">
    <div class="col-5 mb-3">
      <h2 class="text-center font-weight-bold display-4">@{{ balance_general.nombre }}</h2>
      <h4 class="text-center font-weight-bold display-4">@{{ balance_general.fecha }}</h4>
    </div>
    
  </div>
  <div class="row p-3  mb-2 justify-content-center ">
  </div>
  <h2 class="text-center font-weight-bold text-danger">ACTIVOS</h2>
  <div class="row">
    <div class="col-9">
      <h3 class="text-primary">ACTIVOS CORRIENTE </h3><br>
           <table class="table table-borderless">
                <tbody v-for="(element, index) in a_corrientes" :key="element.name">
                    <tr>
                        <td width="400">@{{ element.cuenta }}</td>
                        <td class="text-right">@{{ decimales(element.saldo) }}</td>
                        <td class="text-right">@{{ decimales(element.total_saldo) }}</td>
                        <td></td>
                        <td></td>
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
     {{--  <draggable class="list-group list-group-flush" :list="a_corrientes" group="people">
      <div v-for="(element, index) in a_corrientes" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.cuenta }}<span class="badge-pill">@{{ decimales(element.saldo) }}</span>
        </li>
      </div>
      </draggable> --}}
    </div>
    <div class="col-12">
      <table>
        <tbody>
          <tr>
            <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOTAL ACT. CORR.</td>
            <td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(b_initotal.t_a_corriente )}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-9">
      <h3 class="text-primary">ACTIVOS NO CORRIENTE</h3><br>
      
      <table class="table table-borderless">
        <tbody v-for="(element, index) in a_nocorrientes" :key="element.name">
          <tr>
            <td width="400">@{{ element.cuenta }}</td>
            <td class="text-right">@{{ decimales(element.saldo) }}</td>
            <td class="text-right">@{{ decimales(element.total_saldo) }}</td>
            <td></td>
            <td></td>
          </tr>
          <tr v-if="element.cuenta2 !== '' && element.saldo2 !== '' && element.total_saldo2 !=='' && element.cuenta2 !== null">
            <td width="400">(-)@{{ element.cuenta2 }}</td>
            <td style="border-bottom: solid 2px" class="text-right border-danger">@{{ decimales(element.saldo2) }}</td>
            <td class="text-right">@{{ decimales(element.total_saldo2) }}</td>
            <td colspan="2"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-12">
      <table>
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
            <td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(total_balance_inicial.t_activo) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <h2 class="text-center font-weight-bold text-danger">PASIVOS</h2>
  <div class="row">
    <div class="col-7 ">
      <h3 class="text-primary">PASIVOS CORRIENTE</h3>
      <draggable class="list-group list-group-flush" :list="p_corrientes" group="people">
      <div v-for="(element, index) in p_corrientes" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.cuenta }}
          <span class=" badge-pill">@{{ decimales(element.saldo) }}</span>
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
      <h3 class="text-primary">NO CORRIENTE</h3>
      <draggable class="list-group list-group-flush" :list="p_nocorrientes" group="people">
      <div v-for="(element, index) in p_nocorrientes" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.cuenta }}
          <span class=" badge-pill">@{{ decimales(element.saldo) }}</span>
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
            <td style="font-size: 20px;" class="badge-danger badge">@{{ decimales(total_balance_inicial.t_pasivo) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <h2 class="text-center font-weight-bold text-danger">PATRIMONIO </h2>
  
  <div class="row">
    <div class="col-7">
      <draggable class="list-group list-group-flush" :list="patrimonios" group="people">
      <div v-for="(element, index) in patrimonios" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.cuenta }}
          <span class="badge-pill">@{{ decimales(element.saldo) }}</span>
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
      <table>
        <tbody>
          <tr>
            <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOT. PAS. Y PATRI.</td>
            <td style="font-size: 20px;" class="badge-danger badge">@{{decimales(total_balance_inicial.t_patrimonio_pasivo)}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>