<div id="b_vertical">
  <div class="row p-3  mb-2 justify-content-center ">
    <div class="col-8">
      <h2 align="center">Balance Inicial</h2>
    </div>
    <div class="col-8 mb-3">
      <h2 class="text-center font-weight-bold text-danger display-4">@{{ balance_inicial.nombre }}</h2>
    </div>
  
    <div class="col-5">
      <h4 class="text-center font-weight-bold">@{{ balance_inicial.fecha }}</h4>

    </div>
  </div>
  <h2 class="text-center font-weight-bold text-danger">ACTIVOS</h2>
  <div class="row">
    <div class="col-7">
      <h3 class="text-primary">ACTIVOS CORRIENTE</h3>
      <ul class="list-group list-group-flush">
      <div v-for="(element, index) in a_corrientes" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.nom_cuenta }}<span class="badge-pill">@{{ decimales(element.saldo) }}</span>
        </li>
      </div>
      </ul>
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
      <h3 class="text-primary">ACTIVOS NO CORRIENTE</h3>
      <ul class="list-group list-group-flush" >
      <div v-for="(element, index) in a_nocorrientes" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">@{{ element.nom_cuenta }}
          <span class="badge-pill">@{{ decimales(element.saldo) }}</span>
        </li>
      </div>
      </ul>
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
      <ul class="list-group list-group-flush" >
      <div v-for="(element, index) in p_corrientes" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.nom_cuenta }}
          <span class=" badge-pill">@{{ decimales(element.saldo) }}</span>
        </li>
      </div>
      </ul>
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
      <h3 class="text-primary">NO CORRIENTE </h3>
      <ul class="list-group list-group-flush" >
      <div v-for="(element, index) in p_nocorrientes" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.nom_cuenta }}
          <span class=" badge-pill">@{{ decimales(element.saldo) }} </span>
        </li>
      </div>
      </ul>
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
  <h2 class="text-center font-weight-bold text-danger">PATRIMONIO</h2>
  
  <div class="row">
    <div class="col-7">
      <ul class="list-group list-group-flush">
      <div v-for="(element, index) in patrimonios" :key="element.name">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          @{{ element.nom_cuenta }}
          <span class="badge-pill">@{{ decimales(element.saldo) }}</span>
        </li>
      </div>
      </ul>
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
    <div class="col-12 mt-1">
      <table>
        <tbody>
          <tr>
            <td class="font-weight-bold" style="font-size: 20px;" width="2000">TOT. PAS. Y PATRI.</td>
            <td class="text-right"><span style="font-size: 20px;" class="badge badge-danger">@{{ decimales(total_balance_inicial.t_patrimonio_pasivo) }}</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>