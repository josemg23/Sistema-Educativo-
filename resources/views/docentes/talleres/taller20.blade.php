@extends('layouts.nav')


@section('title', $datos->taller->nombre)
@section('content')

<!-- LLENE  CON  LOS  SIGUIENTES  DATOS  EL  PAGARÉ  CORRECTAMENTE -->


<form action="{{ route('taller1.docente', ['idtaller' => $d]) }}" method="POST">
  @csrf
      <div class="container">
        <h1 class="text-center text-danger display-1">{{ $datos->taller->nombre }}</h1>
        <div class="card border border-danger mb-3" >
          
          <div class="card-header "> 
            <div class="row">
              <div class="col-7" style="font-size: 25px;">
            <h1 class="display-3 font-weight-bold">{{ $user->name }} {{ $user->apellido }}</h1>
                
              </div>
              <div class="col-5">
                <table>
                  <tr>
                    <td width="200" class="font-weight-bold text-danger">Fecha de Entrega:</td>
                    <td>@isset($fecha->fecha_entrega)
                         {{Carbon\Carbon::parse($fecha->fecha_entrega)->formatLocalized('%d de %B %Y ') }}
                      @endisset</td>
                  </tr>
                  <tr>
                    <td width="200" class="font-weight-bold text-primary">Entregado:</td>
                    <td>{{Carbon\Carbon::parse($update_imei->pivot->fecha_entregado)->formatLocalized('%d de %B %Y ') }}</td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold text-info">Estado de entrega:</td>
                    <td > @isset($fecha->fecha_entrega)
                      @if ($update_imei->pivot->fecha_entregado <= $fecha->fecha_entrega)
                      <span class="badge badge-success">PUNTUAL</span>
                      @else
                      <span class="badge badge-danger">ATRASADO</span>
                      @endif 
                     @endisset</td>
                  </tr>
                </table>
              </div>
            </div>

          </div>
          <div class="card-body">
            <h2 class="font-weight-bold "><span class="badge badge-danger">#</span>{{ $datos->enunciado }}</h2>
              
        <div class="row justify-content-center">
              <div class="col-6">
            <label>Beneficiario : </label>
            <span >
              {{ $taller->beneficiario }}
            </span>
            <br>
            <label>Deudor :  </label>
            <span >
              {{ $taller->deudor }}
            </span>
            <br>
            <label>Garante :</label>
            <span>
              {{ $taller->garante }}
            </span>
          </div>
          <div class="col-6">
            <label>Valor :</label>
            <span>
              {{ $taller->valor }}
            </span>
           <br>
            <label>Plazo de Pago :</label>
            <span>
              {{ $taller->plazo_pago }}
            </span><br>
            <label>Taza de interes :</label>
            <span >
              {{ $taller->tasa_interes}}%
            </span>
          </div>
          <div class="col-12">
            <label>Lugar y fecha de emision :</label>
            <span >
              {{ $taller->lugar }}, {{ $taller->fecha_emision }}
            </span>
            <br>
            <label>Fecha de vencimiento :</label>
            <span>
              {{ $taller->fecha_de_vencimiento }}
            </span>
            <br>
          </div>
        <div class="col-10 border border-warning">
          <div class="row justify-content-center">
            <div class="col-10 p-2  ">
              <div class="row justify-content-center">
                <div class="col-4">
                  <img class="img-fluid" src="{{ asset('img/talleres/imagen-19.jpg') }}" alt="">
                </div>
              </div>
              <div class="row justify-content-around">
                <div class="col-5">
                  <span class="border border-right-0 border-left-0 border-success">No. 1</span>
                </div>
                <div class="col-4 form-inline">
                  <label for="">Por $<input required  name="cantidad" disabled value="{{ $datos->cantidad }}" type="text" class="form-control form-control-sm text-right"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <p class="form-inline text-justify">
                    Deb <input required   name="resp1" disabled  value="{{ $datos->resp1 }}" type="text" class="form-control form-control-sm m-1" size="1"> y pagar <input required   name="resp2"disabled  value="{{ $datos->resp2 }}" type="text" class="form-control form-control-sm m-1" size="2"> de la fecha en <input required   name="resp3"disabled  value="{{ $datos->resp3 }}" type="text" class="form-control form-control-sm m-1" size="5"> fijos en esta ciudad o en el lugar en que<input required   name="resp4"disabled  value="{{ $datos->resp4 }}" type="text" class="form-control form-control-sm m-1" size="5"> reconvenga a la orden de <input required   name="resp5"disabled  value="{{ $datos->resp5 }}" type="text" class="form-control form-control-sm m-1" size="60"> la cantidad de <input required   name="resp6"disabled  value="{{ $datos->resp6 }}" type="text" class="form-control form-control-sm m-1" size="60"> por igual valor que ten <input required   type="text" name="resp7"disabled  value="{{ $datos->resp7 }}" class="form-control form-control-sm m-1" size="1"> recibido, en calidad de préstamo y en dinero efectivo para destinarlo a negocios de comercio; esta cantidad  <input required   type="text" name="resp8" disabled  value="{{ $datos->resp8 }}" class="form-control form-control-sm m-1" size="1"> obli <input required disabled=""  type="text" name="resp9" value="{{ $datos->resp9 }}" class="form-control form-control-sm m-1" size="1">a devolveria al vencimiento del plazo expresado, enmonedas de este curso legal.
                  </p>
                  <p class="form-inline text-justify">
                    Tambien <input required   type="text" name="resp10"disabled  value="{{ $datos->resp10 }}" class="form-control form-control-sm m-1" size="1"> oblig <input required   type="text" name="resp11" disabled value="{{ $datos->resp11 }}" class="form-control form-control-sm m-1" size="1"> a pagar el interes del <input required  disabled="" type="text" name="resp12" value="{{ $datos->resp12 }}" class="form-control form-control-sm m-1" size="1"> por ciento anual desde el vencimiento hasta la completa cancelacion y en el caso de mora, a pagar todos los gastos judiciales y extrajudiciales que ocasione el cobro, bastando para terminar el montode tales gastos la sola afirmacion del agreedor.</p>
                  <p class="form-inline text-justify">

                    Al fiel cumplimiento de lo acordado <input required   type="text" name="resp13" disabled value="{{ $datos->resp13 }}" class="form-control form-control-sm m-1" size="1"> oblig <input required   type="text" name="resp14" disabled value="{{ $datos->resp14 }}" class="form-control form-control-sm m-1" size="1"> con todos v bienes presentes y futuros, y ademas, renunci<input required   type="text" name="resp15" disabled value="{{ $datos->resp15 }}" class="form-control form-control-sm m-1" size="1"> domicilio y toda ley o excepcion que pudiera favorecer <input required   type="text" name="resp16" disabled value="{{ $datos->resp16 }}" class="form-control form-control-sm m-1" size="1"> en jucio o fuera de el.
                  </p>
                  <p class="form-inline text-justify">

                    Renuncia <input required   type="text" name="resp17" disabled value="{{ $datos->resp17 }}" class="form-control form-control-sm m-1" size="1"> tambien al derecho de interponer el recurso de apelacion y el de hecho de las providencias que se expidieron en el juicio a que diere lugar, estipul <input required   type="text" name="resp18" disabled value="{{ $datos->resp18 }}" class="form-control form-control-sm m-1" size="1"> expresamente que el tenedor no podra ser obligado a recibir el pago por partes ni aun por <input required   type="text" name="resp19" disabled value="{{ $datos->resp19 }}" class="form-control form-control-sm m-1" size="1"> herederos o sucesores, sin protesto
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label for="">Ciudad</label><input required disabled  class="form-control" name="resp20" value="{{ $datos->resp20 }}" type="text">
                </div>
                <div class="col-6">
                  <label for="">Fecha Vencimiento</label><input required disabled  class="form-control" name="resp21" value="{{ $datos->fecha_vencimiento }}" type="text">
                  
                </div>
              
              </div>
                    <div class="row justify-content-end mt-3">
                <div class="col-10">
                  <p class="form-inline text-justify">Me <input disabled value="{{ $datos->resp21 }}" required   class="form-control mb-1 ml-1 mr-1" size="1" name="resp21" type="text">  constituy <input disabled value="{{ $datos->resp22 }}" required size="1"   class="form-control mb-1 ml-1 mr-1" name="resp22" type="text"> fiador <input disabled value="{{ $datos->resp23 }}" required  size="1"  class="form-control mb-1 ml-1 mr-1" name="resp23" type="text">  llano <input disabled value="{{ $datos->resp24 }}" required  size="1"  class="form-control mb-1 ml-1 mr-1" name="resp23" type="text"> pagador <input disabled value="{{ $datos->resp25 }}" required   class="form-control mb-1 ml-1 mr-1" size="1" name="resp24" type="text"> de <input disabled value="{{ $datos->resp25 }}" required   class="form-control mb-1 ml-1 mr-1" size="1" name="resp25" type="text">  señor <input disabled value="{{ $datos->resp26 }}" required   class="form-control mb-1 ml-1 mr-1" size="15" name="resp26" type="text"> por las obligaciones que he  <input disabled value="{{ $datos->resp27 }}" required   class="form-control mb-1 ml-1 mr-1" size="1" name="resp27" type="text">  ontraído en el pagaré anterior haciendo de deuda ajena deuda propia renunciando  los beneficios de orden y de excusión de bienes de <input disabled value="{{ $datos->resp28 }}" required   class="form-control mb-1 ml-1 mr-1" size="1" name="resp28" type="text"> deudor <input disabled value="{{ $datos->resp29 }}" required   class="form-control mb-1 ml-1 mr-1" size="1" name="resp29" type="text"> principal  <input disabled value="{{ $datos->resp30 }}" required   class="form-control mb-1 ml-1 mr-1" size="1" name="resp30" type="text"> el de división y cualquier ley, excepción o derecho que pueda favorecer <input disabled value="{{ $datos->resp31 }}" required   class="form-control mb-1 ml-1 mr-1" size="1" name="resp31" type="text"> así como la apelación y el recurso de hecho.  Quedo sometido a los jueces de  Provincia o de la que elija el acreedor. Sin protesto.</p>
                </div>
              </div>
              <div class="row">
                <div class="col-6 ">
                  <div class="form-group">
                    <label >FECHA UT SUPRA <br>DEUDOR(ES)</label>
                    <input disabled value="{{ $datos->resp32 }}" type="text" name="resp32" class="form-control" >
                  </div>
                </div>
                <div class="col-6 mt-4">
                  <div class="form-group">
                    <label >GARANTE(ES)</label>
                    <input disabled value="{{ $datos->resp33 }}" type="text" name="resp33" class="form-control">
                  </div>
                </div>
                  <div class="col-6 ">
                  <div class="form-group">
                    <input disabled value="{{ $datos->resp34 }}" type="text" name="resp34" class="form-control form-control-sm" placeholder="CI">
                  </div>
                </div>
                  <div class="col-6 ">
                  <div class="form-group">
                    <input disabled value="{{ $datos->resp35 }}" type="text" name="resp35" class="form-control form-control-sm" placeholder="CI">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
          </div>
            <div class="row justify-content-center">
            <div class="col-5">
              <div class="form-group">
                <label for="exampleFormControlInput1">Calificacion</label>
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="text" value="{{ $update_imei->pivot->calificacion }}" class="form-control" name="calificacion" placeholder="Añada una nota al estudiante">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Retroalimentacion</label>
                <textarea class="form-control" name="retroalimentacion" rows="3" placeholder="Agregue una retroalimentacion">{{ $update_imei->pivot->retroalimentacion }}</textarea>
              </div>   
               <div class="row justify-content-center mb-5">
                <input type="submit" value="Calificar" class="btn p-2 mt-3 btn-danger">
             </div>
            </div>
        </div>
        </div>

        <div class="row justify-content-center">
          <input required   type="submit" value="Enviar Respuesta" class="btn p-2 mt-3 btn-danger">
      </div>
      </div>
    </form>

@endsection