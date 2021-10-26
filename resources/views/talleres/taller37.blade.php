@extends('layouts.nav')

@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">

        .input-css{
        color:#495057;
        background-color:#fff;
        background-clip:padding-box;
        border:1px solid #ced4da;
        border-radius:.25rem;
        box-shadow:inset 0 0 0 transparent;
        transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
#calApp {
    display: flex;
    align-items: center;
    justify-content: center;
    /* height: 100vh;
  width: 100vw;*/
}

.swal-wide {
    width: 300px !important;
}

.calculator {
    display: grid;
    grid-template-rows: repeat(7, minmax(50px, auto));
    grid-template-columns: repeat(4, 50px);
    grid-gap: 10px;
    /*  padding: 35px;*/
    font-family: "Poppins";
    font-weight: 300;
    font-size: 18px;
    /*background-color: #ffffff;*/
    border-radius: 10px;
    /*box-shadow: 0px 3px 80px -30px rgba(13, 81, 134, 1);*/
}

.boton,
.zero {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    outline: none;
    color: #484848;
    background-color: #f4faff;
    border-radius: 5px;
    border: 1px solid #E42D2D;
}

.display,
.answer {
    grid-column: 1 / 5;
    display: flex;
    align-items: center;
}

.display {
    color: #0B0202;
    font-size: 20px;
    border-bottom: 1px solid #e1e1e1;
    margin-bottom: 15px;
    overflow: hidden;
    text-overflow: clip;
}

.answer {
    font-weight: 500;
    color: #146080;
    font-size: 55px;
    height: 65px;
}

.zero {
    grid-column: 1 / 3;
}

.operator {
    background-color: #d9efff;
    color: #3fa9fc;
}
</style>

@endsection
@section('title', 'Talleres de contabilidad')
@section('content')
    <li class="d-none">
        @if (Auth::check())
        @foreach (auth()->user()->roles as $role)
        {{ $rol = $role->descripcion}}
        @endforeach
        @endif
    </li>
<div class="container mb-3">
    <h1 class="text-center text-danger font-weight-bold display-4">Modulo Contable</h1>
    {{-- <h1 class="text-center m-2">{{ $datos->taller->nombre }}</h1> --}}
    <h3 class="text-center mt-3">{!! $datos->enunciado !!}</h3>

    @isset ($datos->archivo)
    <div class="row justify-content-center mb-5">
        <a target="_blank" class="btn btn-danger" href="{{ $datos->archivo }}"><i class="fad fa-file-pdf"></i> Descargar PDF</a>
    </div>
    @endisset
 {{--       <div class="row justify-content-center mb-5">
        <a class="btn btn-success btn-sm mr-1" href="#" data-toggle="modal" data-target="#m_cheque"><i class="far fa-money-bill"></i> CHEQUE</a>
        <a class="btn btn-danger btn-sm mr-1" href="#" data-toggle="modal" data-target="#m_credito"><i class="fas fa-file-invoice-dollar"></i> NOTA DE CREDITO</a>
        <a class="btn btn-info btn-sm mr-1" href="#" data-toggle="modal" data-target="#m_factura"><i class="fas fa-file-invoice-dollar"></i> FACTURA</a>
        <a class="btn btn-warning btn-sm mr-1" href="#" data-toggle="modal" data-target="#m_letra_cambio"><i class="fas fa-file-invoice-dollar"></i> LETRA DE CAMBIO</a>
        <a class="btn btn-secondary btn-sm" href="#" data-toggle="modal" data-target="#m_papeleta"><i class="fas fa-file-invoice-dollar"></i> PAPELETA DE DEPOSITO</a>
    </div> --}}
 @if ($datos->metodo == 'concatenado')
    <div class="row justify-content-md-center">
        <div class="col-12 col-sm-12 col-md-2 mb-3">
            <div class="list-group" id="list-tab" role="tablist">
               
                @foreach ($modulo as $key => $element)
                  <a class="list-group-item list-group-item-action @if ($key == 0) active @endif" id="list-{{ $element->code }}-list" data-toggle="list"
                    href="#list-{{ $element->code }}" role="tab" aria-controls="{{ $element->code }}">{{ $element->name }}</a>
               @endforeach 
            
         {{--        <a class="list-group-item list-group-item-action active" id="list-kardex-list" data-toggle="list"
                    href="#list-kardex" role="tab" aria-controls="kardex">Kardex</a>
                <a class="list-group-item list-group-item-action " id="list-kardex-promedio-list" data-toggle="list"
                    href="#list-kardex-promedio" role="tab" aria-controls="kardex-promedio">Kardex Promedio</a>
                <a class="list-group-item list-group-item-action " id="list-diario-list" data-toggle="list"
                    href="#list-diario" role="tab" aria-controls="home">Balance Inicial</a>
                <a class="list-group-item list-group-item-action" id="list-balance_comp-list" data-toggle="list"
                    href="#list-balance_comp" role="tab" aria-controls="profile">Balance de Comprobacion</a>
                <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
                    href="#list-messages" role="tab" aria-controls="messages">Diario General</a>
                <a class="list-group-item list-group-item-action" id="list-balance-ajustado-list" data-toggle="list"
                    href="#list-balance-ajustado" role="tab" aria-controls="balance-ajustado">Balance Ajustado</a>
                <a class="list-group-item list-group-item-action" id="list-mayor-general-list" data-toggle="list"
                    href="#list-mayor-general" role="tab" aria-controls="mayor-general">Mayor General</a>
                <a class="list-group-item list-group-item-action" id="list-hoja-trabajo-list" data-toggle="list"
                    href="#list-hoja-trabajo" role="tab" aria-controls="hoja-trabajo">Hoja de Trabajo</a>
                <a class="list-group-item list-group-item-action" id="list-estado-resultado-list" data-toggle="list"
                    href="#list-estado-resultado" role="tab" aria-controls="estado-resultado">Estado de
                    Resultado</a>
                <a class="list-group-item list-group-item-action" id="list-balance-general-list" data-toggle="list"
                    href="#list-balance-general" role="tab" aria-controls="balance-general">Balance General</a>
                <a class="list-group-item list-group-item-action" id="list-asento-cierre-list" data-toggle="list"
                    href="#list-asento-cierre" role="tab" aria-controls="asento-cierre">Asientos de Cierre</a>
                <a class="list-group-item list-group-item-action" id="list-libro-caja-list" data-toggle="list"
                    href="#list-libro-caja" role="tab" aria-controls="libro-caja">Libro Caja</a>
                <a class="list-group-item list-group-item-action" id="list-arqueo-caja-list" data-toggle="list"
                    href="#list-arqueo-caja" role="tab" aria-controls="arqueo-caja">Arqueo Caja</a>
                <a class="list-group-item list-group-item-action" id="list-libro-banco-list" data-toggle="list"
                    href="#list-libro-banco" role="tab" aria-controls="libro-banco">Libro Banco</a>
                <a class="list-group-item list-group-item-action" id="list-conciliacion-bancaria-list"
                    data-toggle="list" href="#list-conciliacion-bancaria" role="tab"
                    aria-controls="conciliacion-bancaria">Conciliación Bancaria</a>
                <a class="list-group-item list-group-item-action" id="list-retencion-iva-list" data-toggle="list"
                    href="#list-retencion-iva" role="tab" aria-controls="retencion-iva">Retencion del IVA</a>
                <a class="list-group-item list-group-item-action" id="list-nomina-empleado-list" data-toggle="list"
                    href="#list-nomina-empleado" role="tab" aria-controls="nomina-empleado">Nomina Empleados</a>
                <a class="list-group-item list-group-item-action" id="list-provision-beneficio-list" data-toggle="list"
                    href="#list-provision-beneficio" role="tab" aria-controls="provision-beneficio">Provisión de
                    Benficios</a> --}}

            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-10">
            <div class="tab-content" id="nav-tabContent">

                {{--ARREGLADOS--}}

                <div class="tab-pane  @if ($modulo[0]->code == 'kardex' )show active @endif  fade" id="list-kardex" role="tabpanel"
                    aria-labelledby="list-kardex-list">
                    @include('contabilidad.kardex')
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'kardex-promedio' ) show active @endif  fade" id="list-kardex-promedio" role="tabpanel"
                    aria-labelledby="list-kardex-promedio-list">
                    @include('contabilidad.kardex_promedio')
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'balance_comp' ) show active @endif  fade" id="list-balance_comp" role="tabpanel"
                    aria-labelledby="list-balance_comp-list">
                    @include('contabilidad.balancecomprobacion')
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'messages' ) show active @endif  fade  " id="list-messages" role="tabpanel"
                    aria-labelledby="list-messages-list">
                    @include('contabilidad.diariogeneral')
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'balance-ajustado' ) show active @endif  fade" id="list-balance-ajustado" role="tabpanel"
                    aria-labelledby="list-balance-ajustado-list">
                    @include('contabilidad.balanceajustado')
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'mayor-general' ) show active @endif  fade " id="list-mayor-general" role="tabpanel"
                    aria-labelledby="list-mayor-general-list">
                    @include('contabilidad.mayorgeneral')
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'hoja-trabajo' ) show active @endif  fade" id="list-hoja-trabajo" role="tabpanel"
                    aria-labelledby="list-hoja-trabajo-list">
                    @include('contabilidad.hojatrabajo')
                </div>      
                <div class="tab-pane @if ($modulo[0]->code == 'diario' ) show active @endif  fade border border-danger p-4" id="list-diario" role="tabpanel"
                    aria-labelledby="list-diario-list">
                    <ul class="nav nav-tabs" id="bInicial" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#b_horizontal" role="tab"
                                aria-controls="b_horizontal" aria-selected="true">Balance Inicial Horizontal</a>
                        </li>
                        @if ($datos->metodo == 'individual')

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#b_vertical" role="tab"
                                aria-controls="b_vertical" aria-selected="false">Balance Inicial Vertical</a>
                        </li>

                        @endif
                    </ul>
                    <div class="tab-content" id="bInicialContent">
                        @include('contabilidad.balanceinicial')
                    </div>
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'estado-resultado' ) show active @endif  fade" id="list-estado-resultado" role="tabpanel"
                    aria-labelledby="list-estado-resultado-list">
                    @include('contabilidad.estadoresultado')
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'balance-general' ) show active @endif  fade" id="list-balance-general" role="tabpanel"
                    aria-labelledby="list-balance-general-list">
                    @include('contabilidad.balancegeneral')
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'list-asento-cierre' ) show active @endif  fade" id="list-asento-cierre" role="tabpanel"
                    aria-labelledby="list-asento-cierre-list">
                    @include('contabilidad.asientosdecierre')
                </div>
                {{--ARREGLADOS--}}

                {{--parte anexos arreglado--}}
                <div class="tab-pane @if ($modulo[0]->code == 'libro-caja' ) show active @endif  fade" id="list-libro-caja" role="tabpanel" aria-labelledby="list-libro-caja-list">
                    @include('contabilidad.librocaja')
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'conciliacion-bancaria' ) show active @endif  fade" id="list-conciliacion-bancaria" role="tabpanel"
                    aria-labelledby="list-conciliacion-bancaria-list">
                    @include('contabilidad.conciliacionbancaria')

                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'arqueo-caja' ) show active @endif  fade" id="list-arqueo-caja" role="tabpanel"
                    aria-labelledby="list-arqueo-caja-list">
                    @include('contabilidad.arqueocaja')

                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'libro-banco' ) show active @endif  fade" id="list-libro-banco" role="tabpanel"
                    aria-labelledby="list-libro-banco-list">
                    @include('contabilidad.librobanco')
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'retencion-iva' ) show active @endif  fade" id="list-retencion-iva" role="tabpanel"
                    aria-labelledby="list-retencion-iva-list">
                    @include('contabilidad.retencioniva')
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'nomina-empleado' ) show active @endif  fade" id="list-nomina-empleado" role="tabpanel"
                    aria-labelledby="list-nomina-empleado-list">
                    @include('contabilidad.nominaempleados')
                </div>
                <div class="tab-pane @if ($modulo[0]->code == 'provision-beneficio' ) show active @endif  fade" id="list-provision-beneficio" role="tabpanel"
                    aria-labelledby="list-provision-beneficio-list">
                    @include('contabilidad.provisiondebeneficio')
                </div>
                {{--parte anexos arreglados--}}
            </div>
        </div>
    </div>

    @elseif($datos->metodo == 'individual')
    
    <div class="row">
        <div class="col-12">
            @if ($datos->balance_inicial_vertical == 1)
             {{--    <ul class="nav nav-tabs" id="bInicial" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#b_vertical" role="tab"
                                aria-controls="b_vertical" aria-selected="false">Balance Inicial Vertical</a>
                        </li>
                    </ul> --}}
                    <div class="tab-content" id="bInicialContent">
                        @include('contabilidad.balanceinicial')
                    </div>

            @elseif ($datos->balance_inicial_horizontal == 1)
        {{--     <ul class="nav nav-tabs" id="bInicial" role="tablist">
                    <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#b_horizontal" role="tab"
                                aria-controls="b_horizontal" aria-selected="true">Balance Inicial Horizontal</a>
                        </li>
                    </ul> --}}
                    <div class="tab-content" id="bInicialContent">
                        @include('contabilidad.balanceinicial')
                    </div>
            @elseif ($datos->kardex_fifo == 1)
                    @include('contabilidad.kardex')
                @elseif ($datos->kardex_promedio == 1)
                    @include('contabilidad.kardex_promedio')
                
                @elseif ($datos->balance_comprobacion== 1)
                    @include('contabilidad.balancecomprobacion')
                
                @elseif ($datos->diario_general == 1)
                    @include('contabilidad.diariogeneral')
                
                @elseif ($datos->balance_comprobacion_ajustado == 1)
                    @include('contabilidad.balanceajustado')
                
                @elseif ($datos->mayor_general == 1)
                    @include('contabilidad.mayorgeneral')
                
                @elseif ($datos->hoja_trabajo == 1)
                    @include('contabilidad.hojatrabajo')
                
                @elseif ($datos->estado_resultado == 1)
                    @include('contabilidad.estadoresultado')
                
                @elseif ($datos->balance_general == 1)
                    @include('contabilidad.balancegeneral')
                
                @elseif ($datos->asientos_cierre == 1)
                    @include('contabilidad.asientosdecierre')
                
                @elseif ($datos->librocaja == 1)
                
                    @include('contabilidad.librocaja')
                
                @elseif ($datos->conciliacionbancaria == 1)
                    @include('contabilidad.conciliacionbancaria')
                
                @elseif ($datos->arqueocaja == 1)
                    @include('contabilidad.arqueocaja')
                
                @elseif ($datos->librobanco == 1)
                    @include('contabilidad.librobanco')
                
                @elseif ($datos->retencioniva == 1)
                    @include('contabilidad.retencioniva')
                
                @elseif ($datos->nominaempleados == 1)
                    @include('contabilidad.nominaempleados')
                
                @elseif ($datos->provisiondebeneficio == 1)
                    @include('contabilidad.provisiondebeneficio')

            @endif
        </div>
    </div>

      @endif
     {{--   <h2 class="text-center font-weight-bold">Aplicacion de Documentos</h2>
        <div class="row justify-content-center mb-5" id="documentos"  style="height: 200px; overflow-y: scroll; overflow-x: hidden;">
            <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Tipo de Documento</th>
      <th scope="col">Modulo</th>
      <th  width="200" class="text-center">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(cheque, index) in cheques">
      <td>@{{ cheque.tipo_documento }}</td>
      <td>@{{ cheque.modulo }}</td>
      <td class="text-center"><a class="btn btn-warning" href="" @click.prevent="editarCheque(cheque.id, index)"><i class="fa fa-edit"></i></a>
      <a class="btn btn-danger" href="" @click.prevent="warningEliminar(cheque.id, index, cheque.tipo_documento)"><i class="fa fa-trash"></i></a></td>
    </tr>


  <tr v-for="(nota_credito, index) in nota_creditos">
      <td>@{{ nota_credito.tipo_documento }}</td>
      <td>@{{ nota_credito.modulo }}</td>
      <td class="text-center"><a class="btn btn-warning" href="" @click.prevent="editarNota(nota_credito.id, index)"><i class="fa fa-edit"></i></a>
      <a class="btn btn-danger" href="" @click.prevent="warningEliminar(nota_credito.id, index, nota_credito.tipo_documento)"><i class="fa fa-trash"></i></a></td>
    </tr>  
      <tr v-for="(factura, index) in facturas">
      <td>@{{ factura.tipo_documento }}</td>
      <td>@{{ factura.modulo }}</td>
      <td class="text-center"><a class="btn btn-warning" href="" @click.prevent="editarFactura(factura.id, index)"><i class="fa fa-edit"></i></a>
      <a class="btn btn-danger" href="" @click.prevent="warningEliminar(factura.id, index, factura.tipo_documento)"><i class="fa fa-trash"></i></a></td>
    </tr>  
    <tr v-for="(letra_cambio, index) in letra_cambios">
      <td>@{{ letra_cambio.tipo_documento }}</td>
      <td>@{{ letra_cambio.modulo }}</td>
      <td class="text-center"><a class="btn btn-warning" href="" @click.prevent="editarLetra(letra_cambio.id, index)"><i class="fa fa-edit"></i></a>
      <a class="btn btn-danger" href="" @click.prevent="warningEliminar(letra_cambio.id, index, letra_cambio.tipo_documento)"><i class="fa fa-trash"></i></a></td>
    </tr>  
</tbody>
</table>
@include('contabilidad.modales.modaldocumentos')

        </div>
             --}}
 @if ($rol === 'estudiante' or 'docente')
    <div class="row justify-content-center" id="enviarTaller">
        <a href="" @click.prevent="CompletarTaller" class="btn p-2 mt-3 btn-danger">Completar Taller Contable</a>
        
     </div>
@endif
    {{--  @include ('layouts.modacontabilidad') --}}
</div>

@include ('layouts.footer')
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
{{--   <script>
  $( function() {
          $("#m_letra_cambio").draggable({
      handle: ".modal-header"
  });
  } );
  </script> --}}
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script type="text/javascript" src="{{ asset('js/tallercontabilidad.js') }}"></script>
<script type="text/javascript">
      //$("#m_cheque").draggable({
      //handle: ".modal-header"
  //});
    let taller_id = @json($d);
    let enviar = new Vue({
    
      el: "#enviarTaller",
      methods:{
        CompletarTaller(){
        Swal.fire({
        title: 'Seguro que deseas completar el taller??' ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, completar!'
          }).then((result) => {
        if (result.isConfirmed) {
            this.enviado();
        }
      });
        },
        enviado: function() {
        let _this = this;
        let url = '/sistema/admin/taller37/'+taller_id;
        axios.post(url,{
        }).then(response => {
          if (response.data.success == true) {
            Swal.fire(
            'Completado!',
            'success'
          );
            if (response.data.rol == 'docente') {
        window.location = "/sistema/contenido/"+response.data.id+"/talleres/resueltos";

            } else if(response.data.rol == 'estudiante'){
  window.location = "/sistema/unidad/"+response.data.id;
}

            // window.location = "/sistema/homees"; 
            }          
        }).catch(function(error){

        }); 
     } 
      }
    
    });
    const documentos = new Vue({
      el: "#documentos",
      data:{
        modulo:'',
        show:true,
        cheque:{
            tipo_cheque:'',
            banco:'',
            girador:'',
            cantidad:'',
            n_cheque:'',
            cantidad_letra:'',
            ciudad:'',
            fecha:'',
            firma:'',
            update:false,
            cheque_id:'',
            index:'',
        },
        letra_cambio:{
            vencimiento:'',
            numero:'',
            por:'',
            ciudad:'',
            fecha:'',
            orden_de:'',
            de:'',
            cantidad:'',
            interes:'',
            desde:'',
            direccion:'',
            ciudad2:'',
            atentamente:'',
            update:false,
            letra_id:'',
            index:'',
        },
        papeleta_deposito:{
            banco:'',
            cuenta:'',
            nombre:'',
            lugar_fecha:'',
            cantidad:'',
            depositante:'',
            update:false,
            show:true,
            papeleta_id:'',
            index:'',
        },
        pagare:{
            por:'',
            fecha:'',
            nombre:'',
            cantidad:'',
            interes:'',
            ciudad:'',
            fecha_vencimiento:'',
            señor:'',
            deudor1:'',
            garante:'',
            update:false,
            pagare_id:'',
            index:'',
        },
        nota_credito:{
            razon_social:'',
            fecha_emision:'',
            razon_modificacion:'',
            ruc:'',
            comprobante:'',
            emision:'',
            update:false,
            nota_id:'',
            index:'',
            dato:{
                codigo:'',
                cod_aux:'',
                cantidad:'',
                descripcion:'',
                descuento:'',
                p_unitario:'',
                venta:'',
            },
            datos:[
                {
                codigo:'',
                cod_aux:'',
                cantidad:'',
                descripcion:'',
                p_unitario:'',
                descuento:'',
                venta:'', 
                }
            ],
            totales:{
                subtotal_12:'',
                subtotal_0:'',
                subtotal_no_iva:'',
                subtotal_exe_iva:'',
                subtotal_sin_va:'',
                total_descuento:'',
                ice:'',
                iva_12:'',
                irbpnr:'',
                total:'',
            }
        },
        factura:{
            razon_social:'',
            fecha_emision:'',
            ruc:'',
            guia_remision:'',
            update:false,
            nota_id:'',
            index:'',
            dato:{
                codigo:'',
                cod_aux:'',
                cantidad:'',
                descripcion:'',
                descuento:'',
                p_unitario:'',
                venta:'',
            },
            datos:[
                {
                codigo:'',
                cod_aux:'',
                cantidad:'',
                descripcion:'',
                p_unitario:'',
                descuento:'',
                venta:'', 
                }
            ],
            totales:{
                subtotal_12:'',
                subtotal_0:'',
                subtotal_no_iva:'',
                subtotal_exe_iva:'',
                subtotal_sin_va:'',
                total_descuento:'',
                ice:'',
                iva_12:'',
                irbpnr:'',
                total:'',
            }
        },
        cheques:[],
        pagares:[],
        papeleta_depositos:[],
        letra_cambios:[],
        documentos:[],
        facturas:[],
        nota_creditos:[],
      },
       mounted: function(){
        this.getdocumentos();
      },
      methods:{
            formatoFecha(fecha){
      if (fecha !== null) {
         let date = fecha.split('-').reverse().join('-');
      return date;
    }else{
      return
    }
    },
        aggDatoNota(){
            let dato = {
                codigo:'',
                cod_aux:'',
                cantidad:'',
                descripcion:'',
                p_unitario:'',
                descuento:'',
                venta:'', 
                }
                this.nota_credito.datos.push(dato);
        },
          aggDatoFactura(){
            let dato = {
                codigo:'',
                cod_aux:'',
                cantidad:'',
                descripcion:'',
                p_unitario:'',
                descuento:'',
                venta:'', 
                }
                this.factura.datos.push(dato);
        },
        eliminarDatoNota(index){
             this.nota_credito.datos.splice(index, 1); 
        },
         eliminarDatoFactura(index){
             this.factura.datos.splice(index, 1); 
        },
        getdocumentos(){
        let set = this;
        let url = '/sistema/admin/modulo/documentos';
            axios.post(url,{
                id: taller_id,
            }).then(response => {
                console.log(response.data.cheques)
                this.cheques            = response.data.cheques;
                this.nota_creditos      = response.data.creditos;
                this.facturas           = response.data.facturas;
                this.letra_cambios      = response.data.letras;
                this.pagares            = response.data.pagares;
                this.papeleta_depositos = response.data.papeleta_depositos;
            }).catch(function(error){

            }); 
        },
        editarCheque(id, index){
                let set                   = this;
                let cheque                = set.cheques.filter(x => x.id == id);
                set.cheque.cheque_id      = cheque[0].id;
                set.cheque.index          = index;
                set.modulo                = cheque[0].modulo;
                set.cheque.tipo_cheque    = cheque[0].tipo_cheque;
                set.cheque.banco          = cheque[0].banco;
                set.cheque.girador        = cheque[0].girador;
                set.cheque.cantidad       = cheque[0].cantidad;
                set.cheque.n_cheque       = cheque[0].n_cheque;
                set.cheque.cantidad_letra = cheque[0].cantidad_letra;
                set.cheque.ciudad         = cheque[0].ciudad;
                set.cheque.fecha          = cheque[0].fecha;
                set.cheque.firma          = cheque[0].firma;
                $('#m_cheque').modal('show');
                set.cheque.update = true

            // console.log(cheque);
        },
        editarLetra(id, index){
                let set                      = this;
                let letra_cambio             = this.letra_cambios.filter(x => x.id == id);
                set.letra_cambio.letra_id    = letra_cambio[0].id;
                set.letra_cambio.index       = index;
                set.modulo                   = letra_cambio[0].modulo;
                set.letra_cambio.vencimiento = letra_cambio[0].vencimiento;
                set.letra_cambio.numero      = letra_cambio[0].numero;
                set.letra_cambio.por         = letra_cambio[0].por;
                set.letra_cambio.ciudad      = letra_cambio[0].ciudad;
                set.letra_cambio.fecha       = letra_cambio[0].fecha;
                set.letra_cambio.orden_de    = letra_cambio[0].orden_de;
                set.letra_cambio.de          = letra_cambio[0].de;
                set.letra_cambio.cantidad    = letra_cambio[0].cantidad;
                set.letra_cambio.interes     = letra_cambio[0].interes;
                set.letra_cambio.desde       = letra_cambio[0].desde;
                set.letra_cambio.direccion   = letra_cambio[0].direccion;
                set.letra_cambio.ciudad2     = letra_cambio[0].ciudad2;
                set.letra_cambio.atentamente = letra_cambio[0].atentamente;
                $('#m_letra_cambio').modal('show');
                set.letra_cambio.update = true;
        },
            editarNota(id, index){
                     let set                                   = this;
                     let nota_credito                          = this.nota_creditos.filter(x => x.id == id);
                     let obj                                   = JSON.parse(nota_credito[0].datos);
                     let totales                               = JSON.parse(nota_credito[0].totales);
                     set.nota_credito.nota_id                  = nota_credito[0].id;
                     set.nota_credito.index                    = index;
                     set.modulo                                = nota_credito[0].modulo;
                     set.nota_credito.razon_social             = nota_credito[0].razon_social;
                     set.nota_credito.fecha_emision            = nota_credito[0].fecha_emision;
                     set.nota_credito.ruc                      = nota_credito[0].ruc;
                     set.nota_credito.comprobante              = nota_credito[0].comprobante;
                     set.nota_credito.razon_modificacion       = nota_credito[0].razon_modificacion;
                     set.nota_credito.emision                  = nota_credito[0].emision;
                     set.nota_credito.datos                    = JSON.parse(nota_credito[0].datos);
                     set.nota_credito.totales.subtotal_12      = totales.subtotal_12;
                     set.nota_credito.totales.subtotal_0       = totales.subtotal_0;
                     set.nota_credito.totales.subtotal_no_iva  = totales.subtotal_no_iva;
                     set.nota_credito.totales.subtotal_exe_iva = totales.subtotal_exe_iva;
                     set.nota_credito.totales.subtotal_sin_va  = totales.subtotal_sin_va;
                     set.nota_credito.totales.total_descuento  = totales.total_descuento;
                     set.nota_credito.totales.ice              = totales.ice;
                     set.nota_credito.totales.iva_12           = totales.iva_12;
                     set.nota_credito.totales.irbpnr           = totales.irbpnr;
                     set.nota_credito.totales.total            = totales.total;
                     set.nota_credito.update                   = true;

                       $('#m_credito').modal('show');

            // console.log(obj);
        },
               editarFactura(id, index){
                     let set                                   = this;
                     let factura                          = this.facturas.filter(x => x.id == id);
                     let obj                                   = JSON.parse(factura[0].datos);
                     let totales                               = JSON.parse(factura[0].totales);
                     set.factura.factura_id                  = factura[0].id;
                     set.factura.index                    = index;
                     set.modulo                                = factura[0].modulo;
                     set.factura.razon_social             = factura[0].razon_social;
                     set.factura.fecha_emision            = factura[0].fecha_emision;
                     set.factura.ruc                      = factura[0].ruc;
                     set.factura.guia_remision              = factura[0].guia_remision;
                     set.factura.datos                    = JSON.parse(factura[0].datos);
                     set.factura.totales.subtotal_12      = totales.subtotal_12;
                     set.factura.totales.subtotal_0       = totales.subtotal_0;
                     set.factura.totales.subtotal_no_iva  = totales.subtotal_no_iva;
                     set.factura.totales.subtotal_exe_iva = totales.subtotal_exe_iva;
                     set.factura.totales.subtotal_sin_va  = totales.subtotal_sin_va;
                     set.factura.totales.total_descuento  = totales.total_descuento;
                     set.factura.totales.ice              = totales.ice;
                     set.factura.totales.iva_12           = totales.iva_12;
                     set.factura.totales.irbpnr           = totales.irbpnr;
                     set.factura.totales.total            = totales.total;
                     set.factura.update                   = true;

                       $('#m_factura').modal('show');

            // console.log(obj);
        },
        updateNota(){
               if (this.modulo === '') {
                 toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
            } else {
            let index = this.nota_credito.index;
            let set = this;
            let url = '/sistema/admin/modulo/documento/edit';
                axios.post(url,{
                id: set.nota_credito.nota_id,
                tipo: 'nota_credito',
                modulo: set.modulo,
                tipo_documento: 'Nota de Credito',
                razon_social: set.nota_credito.razon_social,
                fecha_emision: set.nota_credito.fecha_emision,
                ruc: set.nota_credito.ruc,
                comprobante: set.nota_credito.comprobante,
                razon_modificacion: set.nota_credito.razon_modificacion,
                emision: set.nota_credito.emision,
                datos: set.nota_credito.datos,
                totales: set.nota_credito.totales,

            }).then(response => {
                $('#m_credito').modal('hide');
                set.nota_creditos[index].modulo        = set.modulo;
                set.nota_creditos[index].razon_social  = set.nota_credito.razon_social;
                set.nota_creditos[index].fecha_emision = set.nota_credito.fecha_emision;
                set.nota_creditos[index].ruc           = set.nota_credito.ruc;
                set.nota_creditos[index].comprobante   = set.nota_credito.comprobante;
                set.nota_creditos[index].razon_modificacion   = set.nota_credito.razon_modificacion;
                set.nota_creditos[index].emision       = set.nota_credito.emision;
                set.nota_creditos[index].datos         = JSON.stringify(set.nota_credito.datos);
                set.nota_creditos[index].totales       = JSON.stringify(set.nota_credito.totales);
                toastr.info("Nota de credito editada Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
               this.resetNota();
            }).catch(function(error){

            }); 
        }
        },
            updateFactura(){
               if (this.modulo === '') {
                 toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
            } else {
            let index = this.factura.index;
            let set = this;
            let url = '/sistema/admin/modulo/documento/edit';
                axios.post(url,{
                id: set.factura.factura_id,
                tipo: 'factura',
                modulo: set.modulo,
                tipo_documento: 'Factura',
                razon_social: set.factura.razon_social,
                fecha_emision: set.factura.fecha_emision,
                ruc: set.factura.ruc,
                guia_remision: set.factura.guia_remision,
                datos: set.factura.datos,
                totales: set.factura.totales,

            }).then(response => {
                $('#m_factura').modal('hide');
                set.facturas[index].modulo        = set.modulo;
                set.facturas[index].razon_social  = set.factura.razon_social;
                set.facturas[index].fecha_emision = set.factura.fecha_emision;
                set.facturas[index].ruc           = set.factura.ruc;
                set.facturas[index].guia_remision = set.factura.guia_remision;
                set.facturas[index].datos         = JSON.stringify(set.factura.datos);
                set.facturas[index].totales       = JSON.stringify(set.factura.totales);
                toastr.info("Factura editada Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
               this.resetFactura();
            }).catch(function(error){

            }); 
        }
        },
        warningEliminar(id, index, tipo){
        Swal.fire({
        title: 'Seguro que deseas eliminar este documento??' ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
            this.eliminarDocumento(id, index, tipo);
        }
      });
        },
        eliminarDocumento(id, index, tipo){
            let set = this;
            let url = '/sistema/admin/modulo/documento/delete';
                axios.post(url,{
                id: id,
                tipo: tipo,
            }).then(response => {
                if (tipo === 'Cheque' ) {

                    this.cheques.splice(index, 1); 

                }else if (tipo === 'Nota de Credito') {

                    this.nota_creditos.splice(index, 1); 

                }else if (tipo === 'Factura') {

                    this.facturas.splice(index, 1); 
                }else if (tipo === 'Letra de Cambio') {

                    this.letra_cambios.splice(index, 1); 
                }
                else if (tipo === 'Pagare') {

                    this.pagares.splice(index, 1); 
                }
                else if (tipo === 'Papeleta Deposito') {

                    this.papeleta_depositos.splice(index, 1); 
                }
                toastr.info("Documento Eliminado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
               
            }).catch(function(error){

            }); 
        },
        resetCheque(){
                let set                   = this;
                set.modulo                = '';
                set.cheque.tipo_cheque    = '';
                set.cheque.banco          = '';
                set.cheque.girador        = '';
                set.cheque.cantidad       = '';
                set.cheque.n_cheque       = '';
                set.cheque.cantidad_letra = '';
                set.cheque.ciudad         = '';
                set.cheque.fecha          = '';
                set.cheque.firma          = '';
                set.cheque.cheque_id      = '';
                set.cheque.index          = '';
                set.cheque.update         = false;
        },
        updateCheque(){
               if (this.modulo === '') {
                 toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
            } else {
            let index = this.cheque.index;
            let set = this;
            let url = '/sistema/admin/modulo/documento/edit';
                axios.post(url,{
                id: set.cheque.cheque_id,
                tipo: 'cheque',
                modulo: set.modulo,
                tipo_documento: 'Cheque',
                tipo_cheque: set.cheque.tipo_cheque,
                banco: set.cheque.banco,
                girador: set.cheque.girador,
                cantidad: set.cheque.cantidad,
                n_cheque: set.cheque.n_cheque,
                cantidad_letra: set.cheque.cantidad_letra,
                ciudad: set.cheque.ciudad,
                fecha: set.cheque.fecha,
                firma: set.cheque.firma
            }).then(response => {
                $('#m_cheque').modal('hide');
                set.cheques[index].modulo         = set.modulo;
                set.cheques[index].tipo_cheque    = set.cheque.tipo_cheque;
                set.cheques[index].banco          = set.cheque.banco;
                set.cheques[index].girador        = set.cheque.girador;
                set.cheques[index].cantidad       = set.cheque.cantidad;
                set.cheques[index].n_cheque       = set.cheque.n_cheque;
                set.cheques[index].cantidad_letra = set.cheque.cantidad_letra;
                set.cheques[index].ciudad         = set.cheque.ciudad;
                set.cheques[index].fecha          = set.cheque.fecha;
                set.cheques[index].firma          = set.cheque.firma;
                toastr.info("Cheque editado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
               this.resetCheque();
            }).catch(function(error){

            }); 
        }
        },
            updateLetra(){
               if (this.modulo === '') {
                 toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
            } else {
            let index = this.letra_cambio.index;
            let set = this;
            let url = '/sistema/admin/modulo/documento/edit';
                axios.post(url,{
                id:                 set.letra_cambio.letra_id,
                tipo:               'letra_cambio',
                modulo:             set.modulo,
                tipo_documento:     'Letra de Cambio',
                vencimiento:        set.letra_cambio.vencimiento,
                numero:             set.letra_cambio.numero,
                por:                set.letra_cambio.por,
                ciudad:             set.letra_cambio.ciudad,
                fecha:              set.letra_cambio.fecha,
                orden_de:           set.letra_cambio.orden_de,
                de:                 set.letra_cambio.de,
                cantidad:           set.letra_cambio.cantidad,
                interes:            set.letra_cambio.interes,
                desde:              set.letra_cambio.desde,
                direccion:          set.letra_cambio.direccion,
                ciudad2:            set.letra_cambio.ciudad2,
                atentamente:        set.letra_cambio.atentamente
            }).then(response => {
                $('#m_letra_cambio').modal('hide');
                set.letra_cambios[index].modulo      = set.modulo;
                set.letra_cambios[index].vencimiento = set.letra_cambio.vencimiento;
                set.letra_cambios[index].numero      = set.letra_cambio.numero;
                set.letra_cambios[index].por         = set.letra_cambio.por;
                set.letra_cambios[index].ciudad      = set.letra_cambio.ciudad;
                set.letra_cambios[index].fecha       = set.letra_cambio.fecha;
                set.letra_cambios[index].orden_de    = set.letra_cambio.orden_de;
                set.letra_cambios[index].de          = set.letra_cambio.de;
                set.letra_cambios[index].cantidad    = set.letra_cambio.cantidad;
                set.letra_cambios[index].interes     = set.letra_cambio.interes;
                set.letra_cambios[index].desde       = set.letra_cambio.desde;
                set.letra_cambios[index].direccion   = set.letra_cambio.direccion;
                set.letra_cambios[index].ciudad2     = set.letra_cambio.ciudad2;
                set.letra_cambios[index].atentamente = set.letra_cambio.atentamente;
                toastr.info("Letra de cambio editada Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
               this.resetLetra();
            }).catch(function(error){

            }); 
        }
        },
        guardarCheque(){
            if (this.modulo === '') {
                 toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
            }else{
                 this.show = false;
            let set = this;
            let cheque = {
                modulo: set.modulo,
                tipo_documento: 'Cheque',
                tipo_cheque: set.tipo_cheque,
                banco: set.banco,
                girador: set.girador,
                cantidad: set.cantidad,
                n_cheque: set.n_cheque,
                cantidad_letra: set.cantidad_letra,
                ciudad: set.ciudad,
                fecha: set.fecha,
                firma: set.firma
                };

            let url = '/sistema/admin/modulo/cheque';
            axios.post(url,{
                id: taller_id,
                tipo: 'cheque',
                modulo: set.modulo,
                tipo_documento: 'Cheque',
                tipo_cheque: set.cheque.tipo_cheque,
                banco: set.cheque.banco,
                girador: set.cheque.girador,
                cantidad: set.cheque.cantidad,
                n_cheque: set.cheque.n_cheque,
                cantidad_letra: set.cheque.cantidad_letra,
                ciudad: set.cheque.ciudad,
                fecha: set.cheque.fecha,
                firma: set.cheque.firma
            }).then(response => {
                $('#m_cheque').modal('hide');
                 this.show = true;
                // console.log(response.data.cheque)
                this.cheques.push(response.data.cheque);
                toastr.success("Cheque creado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                // set.modulo         = '';
                set.cheque.tipo_cheque    = '';
                set.cheque.banco          = '';
                set.cheque.girador         = '';
                set.cheque.cantidad       = '';
                set.cheque.n_cheque       = '';
                set.cheque.cantidad_letra = '';
                set.cheque.ciudad         = '';
                set.cheque.fecha          = '';
                set.cheque.firma          = '';
            }).catch(function(error){

            }); 
            }
            
        },
             guardarLetra(){
            if (this.modulo === '') {
                 toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
            } else {
                 this.show = false;
            let set = this;
            let url = '/sistema/admin/modulo/letra-cambio';
            axios.post(url,{
               id:                 taller_id,
                tipo:               'letra_cambio',
                modulo:             set.modulo,
                tipo_documento:     'Letra de Cambio',
                vencimiento:        set.letra_cambio.vencimiento,
                numero:             set.letra_cambio.numero,
                por:                set.letra_cambio.por,
                ciudad:             set.letra_cambio.ciudad,
                fecha:              set.letra_cambio.fecha,
                orden_de:           set.letra_cambio.orden_de,
                de:                 set.letra_cambio.de,
                cantidad:           set.letra_cambio.cantidad,
                interes:            set.letra_cambio.interes,
                desde:              set.letra_cambio.desde,
                direccion:          set.letra_cambio.direccion,
                ciudad2:            set.letra_cambio.ciudad2,
                atentamente:        set.letra_cambio.atentamente
            }).then(response => {
                $('#m_letra_cambio').modal('hide');
                 this.show = true;
                // console.log(response.data.cheque)
                this.letra_cambios.push(response.data.letra_cambio);
                toastr.success("Letra de Cambio creada Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                this.resetLetra();
            }).catch(function(error){

            }); 
            }
            
        },
            guardarNota(){
            if (this.modulo === '') {
                 toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
                "timeOut": "3000"
          });
            }else {
                 this.show = false;
            let set = this;
            let url = '/sistema/admin/modulo/nota_credito';
            axios.post(url,{
                id: taller_id,
                tipo: 'nota_credito',
                modulo: set.modulo,
                tipo_documento: 'Nota de Credito',
                razon_social: set.nota_credito.razon_social,
                fecha_emision: set.nota_credito.fecha_emision,
                ruc: set.nota_credito.ruc,
                comprobante: set.nota_credito.comprobante,
                razon_modificacion: set.nota_credito.razon_modificacion,
                emision: set.nota_credito.emision,
                datos: set.nota_credito.datos,
                totales: set.nota_credito.totales,
            }).then(response => {
                $('#m_credito').modal('hide');
                 this.show = true;
                // console.log(response.data.cheque)
                this.nota_creditos.push(response.data.nota_credito);
                toastr.success("Nota de Credito creada Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                    set.resetNota();
                }).catch(function(error){

                }); 
            }
        },
                resetLetra(){
                    let set                      = this;
                    set.modulo                   = '';
                    set.letra_cambio.vencimiento = '';
                    set.letra_cambio.numero      = '';
                    set.letra_cambio.por         = '';
                    set.letra_cambio.ciudad      = '';
                    set.letra_cambio.fecha       = '';
                    set.letra_cambio.orden_de    = '';
                    set.letra_cambio.de          = '';
                    set.letra_cambio.cantidad    = '';
                    set.letra_cambio.interes     = '';
                    set.letra_cambio.desde       = '';
                    set.letra_cambio.direccion   = '';
                    set.letra_cambio.ciudad2     = '';
                    set.letra_cambio.atentamente = '';
                    set.letra_cambio.update      = false
                    set.letra_cambio.letra_id    = '';
                    set.letra_cambio.index       = '';      
        },
        resetNota(){
                    let set = this;
                     set.modulo                                = '';
                     set.nota_credito.razon_social             = '';
                     set.nota_credito.fecha_emision            = '';
                     set.nota_credito.ruc                      = '';
                     set.nota_credito.comprobante              = '';
                     set.nota_credito.razon_modificacion       = '';
                     set.nota_credito.emision                  = '';
                     set.nota_credito.datos                    = 
                     [
                         {
                             codigo:'',
                             cod_aux:'',
                             cantidad:'',
                             descripcion:'',
                             p_unitario:'',
                             descuento:'',
                             venta:'', 
                         }
                     ];
                     set.nota_credito.totales.subtotal_12      = '';
                     set.nota_credito.totales.subtotal_0       = '';
                     set.nota_credito.totales.subtotal_no_iva  = '';
                     set.nota_credito.totales.subtotal_exe_iva = '';
                     set.nota_credito.totales.subtotal_sin_va  = '';
                     set.nota_credito.totales.total_descuento  = '';
                     set.nota_credito.totales.ice              = '';
                     set.nota_credito.totales.iva_12           = '';
                     set.nota_credito.totales.irbpnr           = '';
                     set.nota_credito.totales.total            = '';
                     set.nota_credito.update                   = false
                     set.nota_credito.nota_id                  = '';
                     set.nota_credito.index                    = '';


                    
        },
        guardarFactura(){
            if (this.modulo === '') {
                 toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
                "timeOut": "3000"
          });
            }else {
                 this.show = false;
            let set = this;
            let url = '/sistema/admin/modulo/factura';
            axios.post(url,{
                id: taller_id,
                tipo: 'factura',
                modulo: set.modulo,
                tipo_documento: 'Factura',
                razon_social: set.factura.razon_social,
                fecha_emision: set.factura.fecha_emision,
                ruc: set.factura.ruc,
                guia_remision: set.factura.guia_remision,
                datos: set.factura.datos,
                totales: set.factura.totales,
            }).then(response => {
                $('#m_factura').modal('hide');
                 this.show = true;
                // console.log(response.data.cheque)
                this.facturas.push(response.data.factura);
                toastr.success("Factura creada Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
               this.resetFactura();
                }).catch(function(error){

                }); 
            }
            
        },
               resetFactura(){
                    let set = this;
                     set.modulo                                = '';
                     set.factura.razon_social             = '';
                     set.factura.fecha_emision            = '';
                     set.factura.ruc                      = '';
                     set.factura.guia_remision            = '';
                     set.factura.datos                    = 
                     [
                         {
                             codigo:'',
                             cod_aux:'',
                             cantidad:'',
                             descripcion:'',
                             p_unitario:'',
                             descuento:'',
                             venta:'', 
                         }
                     ];
                        set.factura.totales.subtotal_12      = '';
                        set.factura.totales.subtotal_0       = '';
                        set.factura.totales.subtotal_no_iva  = '';
                        set.factura.totales.subtotal_exe_iva = '';
                        set.factura.totales.subtotal_sin_va  = '';
                        set.factura.totales.total_descuento  = '';
                        set.factura.totales.ice              = '';
                        set.factura.totales.iva_12           = '';
                        set.factura.totales.irbpnr           = '';
                        set.factura.totales.total            = '';
                        set.factura.update                   = false
                        set.factura.factura_id               = '';
                        set.factura.index                    = '';   
        },
        guardarPagare(){
             if (this.modulo === '') {
                 toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
                "timeOut": "3000"
          });
            }else {
                 this.show = false;
            let set = this;
            let url = '/sistema/admin/modulo/pagare';
            axios.post(url,{
               id:                      taller_id,
                tipo:                   'pagare',
                modulo:                  set.modulo,
                tipo_documento:         'Pagare',
                por:                    set.pagare.por,
                fecha:                  set.pagare.fecha,
                nombre:                 set.pagare.nombre,
                cantidad:               set.pagare.cantidad,
                interes:                set.pagare.interes,
                ciudad:                 set.pagare.ciudad,
                fecha_vencimiento:      set.pagare.fecha_vencimiento,
                señor:                  set.pagare.señor,
                deudor1:                set.pagare.deudor1,
                garante:                set.pagare.garante,
            }).then(response => {
                $('#m_pagare').modal('hide');
                 this.show = true;
                // console.log(response.data.cheque)
                this.pagares.push(response.data.pagare);
                toastr.success("Pagaré creado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                this.resetPagare();
            }).catch(function(error){

            }); 
        }
        },
              editarPagare(id, index){
                let set                      = this;
                let pagare                   = this.pagares.filter(x => x.id == id);
                set.pagare.pagare_id         = pagare[0].id;
                set.pagare.index             = index;
                set.modulo                   = pagare[0].modulo;
                set.pagare.por               = pagare[0].por;
                set.pagare.fecha             = pagare[0].fecha;
                set.pagare.nombre            = pagare[0].nombre;
                set.pagare.cantidad          = pagare[0].cantidad;
                set.pagare.interes           = pagare[0].interes;
                set.pagare.ciudad            = pagare[0].ciudad;
                set.pagare.fecha_vencimiento = pagare[0].fecha_vencimiento;
                set.pagare.señor             = pagare[0].señor;
                set.pagare.deudor1           = pagare[0].deudor1;
                set.pagare.garante           = pagare[0].garante;
               
                $('#m_pagare').modal('show');
                set.pagare.update = true;
        },
        updatePagare(){
             if (this.modulo === '') {
                 toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
                "timeOut": "3000"
          });
            }else {
            let index = this.pagare.index;
            let set = this;
            let url = '/sistema/admin/modulo/documento/edit';
                axios.post(url,{
                id:                 set.pagare.pagare_id,
                tipo:               'pagare',
                modulo:             set.modulo,
                tipo_documento:     'Pagare',
                por:                set.pagare.por,
                fecha:              set.pagare.fecha,
                nombre:             set.pagare.nombre,
                cantidad:           set.pagare.cantidad,
                interes:            set.pagare.interes,
                ciudad:             set.pagare.ciudad,
                fecha_vencimiento:  set.pagare.fecha_vencimiento,
                señor:              set.pagare.señor,
                deudor1:            set.pagare.deudor1,
                garante:            set.pagare.garante,

            }).then(response => {
                $('#m_pagare').modal('hide');
                set.pagares[index].modulo            = set.modulo;
                set.pagares[index].por               = set.pagare.por;
                set.pagares[index].fecha             = set.pagare.fecha;
                set.pagares[index].nombre            = set.pagare.nombre;
                set.pagares[index].cantidad          = set.pagare.cantidad;
                set.pagares[index].interes           = set.pagare.interes;
                set.pagares[index].ciudad            = set.pagare.ciudad;
                set.pagares[index].fecha_vencimiento = set.pagare.fecha_vencimiento;
                set.pagares[index].señor             = set.pagare.señor;
                set.pagares[index].deudor1           = set.pagare.deudor1;
                set.pagares[index].garante           = set.pagare.garante;
                
                toastr.info("Pagare Actualizado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
               this.resetPagare();
            }).catch(function(error){

            }); 
        }
        
        },
        resetPagare(){
            let set                      = this;
            set.modulo = '';
            set.pagare.por               = '';
            set.pagare.fecha             = '';
            set.pagare.nombre            = '';
            set.pagare.cantidad          = '';
            set.pagare.interes           = '';
            set.pagare.ciudad            = '';
            set.pagare.fecha_vencimiento = '';
            set.pagare.señor             = '';
            set.pagare.deudor1           = '';
            set.pagare.garante           = '';
            set.pagare.update            = false;
            set.pagare.pagare_id         = '';
            set.pagare.index             = '';         
        },
        guardarPapeleta(){
             if (this.modulo === '') {
                 toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
                "timeOut": "3000"
          });
            }else {
            let set = this;
            this.show = false;
            let url = '/sistema/admin/modulo/papeleta';
            axios.post(url,{
                id:                      taller_id,
                tipo:                   'papeleta',
                modulo:                  set.modulo,
                tipo_documento:         'Papeleta De Deposito',
                banco:                  set.papeleta_deposito.banco,
                cuenta:                 set.papeleta_deposito.cuenta,
                nombre:                 set.papeleta_deposito.nombre,
                lugar_fecha:            set.papeleta_deposito.lugar_fecha,
                cantidad:               set.papeleta_deposito.cantidad,
                depositante:            set.papeleta_deposito.depositante,
            }).then(response => {
           

                $('#m_papeleta').modal('hide');
                 this.show = true;
                // console.log(response.data.cheque)
                this.papeleta_depositos.push(response.data.papeleta_deposito);
                toastr.success("Papeleta de Deposito Creada Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                this.resetPapeleta();
            }).catch(function(error){

            }); 
        }
        },
              editarPapeleta(id, index){
                let set                           = this;
                let papeleta_deposito             = this.papeleta_depositos.filter(x => x.id == id);
                set.papeleta_deposito.papeleta_id = papeleta_deposito[0].id;
                set.papeleta_deposito.index       = index;
                set.modulo                        = papeleta_deposito[0].modulo;
                set.papeleta_deposito.banco       = papeleta_deposito[0].banco;
                set.papeleta_deposito.cuenta      = papeleta_deposito[0].cuenta;
                set.papeleta_deposito.nombre      = papeleta_deposito[0].nombre;
                set.papeleta_deposito.lugar_fecha = papeleta_deposito[0].lugar_fecha;
                set.papeleta_deposito.cantidad    = papeleta_deposito[0].cantidad;
                set.papeleta_deposito.depositante = papeleta_deposito[0].depositante;
                $('#m_papeleta').modal('show');
                set.papeleta_deposito.update = true;
        },
        updatePapeleta(){
             if (this.modulo === '') {
                 toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
                "timeOut": "3000"
          });
            }else {
          
            let index = this.papeleta_deposito.index;
            let set = this;
            let url = '/sistema/admin/modulo/documento/edit';
                axios.post(url,{
                id:                 set.papeleta_deposito.papeleta_id,
                tipo:               'papeleta_deposito',
                modulo:             set.modulo,
                tipo_documento:     'Papeleta De Deposito',
                banco:                  set.papeleta_deposito.banco,
                cuenta:                 set.papeleta_deposito.cuenta,
                nombre:                 set.papeleta_deposito.nombre,
                lugar_fecha:            set.papeleta_deposito.lugar_fecha,
                cantidad:               set.papeleta_deposito.cantidad,
                depositante:            set.papeleta_deposito.depositante,

            }).then(response => {
                $('#m_papeleta').modal('hide');
                set.papeleta_depositos[index].modulo      = set.modulo;
                set.papeleta_depositos[index].banco       = set.papeleta_deposito.banco;
                set.papeleta_depositos[index].cuenta      = set.papeleta_deposito.cuenta;
                set.papeleta_depositos[index].nombre      = set.papeleta_deposito.nombre;
                set.papeleta_depositos[index].lugar_fecha = set.papeleta_deposito.lugar_fecha;
                set.papeleta_depositos[index].cantidad    = set.papeleta_deposito.cantidad;
                set.papeleta_depositos[index].depositante = set.papeleta_deposito.depositante;
                
                toastr.info("Papeleta De Deposito Actualizada Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
               this.resetPapeleta();
            }).catch(function(error){

            }); 
            }
        },
        resetPapeleta(){
            let set                           = this;
            set.modulo = '';
            set.papeleta_deposito.banco       = '';
            set.papeleta_deposito.cuenta      = '';
            set.papeleta_deposito.nombre      = '';
            set.papeleta_deposito.lugar_fecha = '';
            set.papeleta_deposito.cantidad    = '';
            set.papeleta_deposito.depositante = '';
            set.papeleta_deposito.update      = false;
            set.papeleta_deposito.papeleta_id = '';
            set.papeleta_deposito.index       = '';         
        }

      }
    });
</script>

@endsection
@endsection