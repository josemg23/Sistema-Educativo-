{{-- BALANCE HORIZONTAL --}}
<div class="tab-pane fade show active" id="b_horizontal" role="tabpanel" aria-labelledby="b_horizontal-tab">
  <div class="row p-3  mb-2 justify-content-center ">
    <div class="col-6">
      <h2 align="center">Balance Inicial</h2>
    </div>
    <div class="col-8 mb-3">
      <h2 class="text-center font-weight-bold display-4">@{{ balance_inicial.nombre }}</h2>
    </div>
    <div class="col-5">
      <h4 class="text-center font-weight-bold display-4">@{{ balance_inicial.fecha }}</h4>
    </div>
    
  </div>
  <div class="row justify-content-between">
    <div class="col-6">
      <h3 class="text-danger">ACTIVOS</h3>
      <h3 class="text-primary">CORRIENTE</h3>
      <ul class="list-group list-group-flush"  >
      <div v-for="(element, index) in a_corrientes" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.nom_cuenta }}
          
          <span class="badge-pill">@{{ decimales(element.saldo) }}</span>
        </li>
      </div>
      </ul>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td width="250">TOTAL ACT. CORR.</td>
            <td class="text-right"><span style="font-size: 20px; margin-left: 35px;" class="badge badge-danger">@{{ decimales(b_initotal.t_a_corriente) }}</span></td>
          </tr>
        </tbody>
      </table>
      
      <br><br>
      <h3 class="text-primary">NO CORRIENTE</h3>
      <ul class="list-group list-group-flush" >
      <div v-for="(element, index) in a_nocorrientes" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.nom_cuenta }}
          <span class="badge-pill">@{{ decimales(element.saldo) }}</span>
        </li>
      </div>
      </ul>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td width="250">TOTAL ACT. NO CORR.</td>
            <td class="text-right"><span style="font-size: 20px; margin-left: 35px;" class="badge badge-danger">@{{ decimales(b_initotal.t_a_nocorriente) }}</span></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-6">
      <h3 class="text-danger">PASIVO</h3>
      <h3 class="text-primary">CORRIENTE</h3>
      <ul class="list-group list-group-flush">
      <div v-for="(element, index) in p_corrientes" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.nom_cuenta }}
          <span class=" badge-pill">@{{ decimales(element.saldo) }}</span>
        </li>
      </div>
      </ul>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td width="250">TOTAL PAS. CORR.</td>
            <td class="text-right"><span style="font-size: 20px; margin-left: 35px;" class="badge badge-danger">@{{ decimales(b_initotal.t_p_corriente) }}</span></td>
          </tr>
        </tbody>
      </table>
      <br><br>
      
      <h3 class="text-primary">NO CORRIENTE </h3>
      <ul class="list-group list-group-flush">
      <div v-for="(element, index) in p_nocorrientes" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.nom_cuenta }}
          <span class=" badge-pill">@{{ decimales(element.saldo) }}</span>
        </li>
      </div>
      </ul>
      
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td width="250">TOTAL PAS. CORR.</td>
            <td class="text-right"> <span style="font-size: 20px; margin-left: 35px;" class="badge badge-danger">@{{ decimales(b_initotal.t_p_no_corriente) }}</span></td>
          </tr>
        </tbody>
      </table>
      <br><br>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td class="font-weight-bold" width="250">TOTAL PASIVO</td>
            <td class="text-right"><span style="font-size: 20px; margin-left: 35px;" class="badge badge-danger">@{{ decimales(total_balance_inicial.t_pasivo) }}</span></td>
          </tr>
        </tbody>
      </table>
      <br><br>
      <h3 class="text-danger">PATRIMONIO </h3>
      <ul class="list-group list-group-flush" >
      <div v-for="(element, index) in patrimonios" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.nom_cuenta }}
          <span class="badge-pill">@{{ decimales(element.saldo) }}</span>
        </li>
      </div>
      </ul>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td width="250">TOTAL PATRIMONIO.</td>
            <td class="text-right"> <span style="font-size: 20px; margin-left: 35px;" class="badge badge-danger">@{{ decimales(b_initotal.t_patrimonio) }}</span></td>
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
            <td class="text-right"><span style="font-size: 20px; margin-left: 35px;" class="badge badge-danger">@{{ decimales(total_balance_inicial.t_activo) }}</span></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-6">
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td class="font-weight-bold" style="font-size: 20px;" width="200">TOT. PAS. Y PATRI.</td>
            <td class="text-right">
              <td class="text-right"><span style="font-size: 20px; margin-left: 35px;" class="badge badge-danger">@{{ decimales(total_balance_inicial.t_patrimonio_pasivo) }}</span></td>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
{{-- BALANCE VERTICAL --}}
