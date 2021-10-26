<?php

namespace App\Http\Controllers;

use App\ModuloLetraCambio;
use App\Modulo\ModuloCheque;
use App\Modulo\ModuloFactura;
use App\Modulo\ModuloNotaCredito;
use App\Modulo\ModuloPagare;
use App\Modulo\ModuloPapeleta;
use App\User;
use Auth;
use Illuminate\Http\Request;

class ModuloDocumentoController extends Controller
{
    public function cheque(Request $request)
    {
    	$userID = Auth::id();
    	$tallerID = $request->id;
    // $conteo = ModuloCheque::where('taller_id', $tallerID)->where('user_id', $userID)->count();
    	// if ($conteo == 0) {
			$cheque                 = new  ModuloCheque;
			$cheque->taller_id      =  $tallerID;
			$cheque->user_id        =  $userID;
			$cheque->modulo         =  $request->modulo;
			$cheque->tipo_documento =  $request->tipo_documento;
			$cheque->tipo_cheque    =  $request->tipo_cheque;
			$cheque->banco          =  $request->banco;
			$cheque->girador        =  $request->girador;
			$cheque->cantidad       =  $request->cantidad;
			$cheque->n_cheque       =  $request->n_cheque;
			$cheque->cantidad_letra =  $request->cantidad_letra;
			$cheque->ciudad         =  $request->ciudad;
			$cheque->fecha          =  $request->fecha;
			$cheque->firma          =  $request->firma;
			$cheque->save();

			 return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'cheque' => $cheque,
                    'message' => 'Kardex Fifo actualizado correctamente'
                ),200,[]);
    	// }else {
    		
    	// }
    	
    }
        public function letra_cambio(Request $request)
    {
        $userID = Auth::id();
        $tallerID = $request->id;
            $letra_cambio                 = new  ModuloLetraCambio;
            $letra_cambio->taller_id      =  $tallerID;
            $letra_cambio->user_id        =  $userID;
            $letra_cambio->modulo         =  $request->modulo;
            $letra_cambio->tipo_documento =  $request->tipo_documento;
            $letra_cambio->vencimiento    =  $request->vencimiento;
            $letra_cambio->numero         =  $request->numero;
            $letra_cambio->por            =  $request->por;
            $letra_cambio->ciudad         =  $request->ciudad;
            $letra_cambio->fecha          =  $request->fecha;
            $letra_cambio->orden_de       =  $request->orden_de;
            $letra_cambio->de             =  $request->de;
            $letra_cambio->cantidad       =  $request->cantidad;
            $letra_cambio->interes        =  $request->interes;
            $letra_cambio->desde          =  $request->desde;
            $letra_cambio->direccion      =  $request->direccion;
            $letra_cambio->ciudad2        =  $request->ciudad2;
            $letra_cambio->atentamente    =  $request->atentamente;
            $letra_cambio->save();

             return response(array(                                         //ENVIO DE RESPUESTA
                    'success'      => true,
                    'estado'       => 'guardado',
                    'letra_cambio' => $letra_cambio,
                    'message'      => 'Kardex Fifo actualizado correctamente'
                ),200,[]);   
    }
    public function pagare(Request $request)
    {
            $userID                    = Auth::id();
            $tallerID                  = $request->id;
            $pagare                    = new  ModuloPagare;
            $pagare->taller_id         =  $tallerID;
            $pagare->user_id           =  $userID;
            $pagare->modulo            =  $request->modulo;
            $pagare->tipo_documento    =  $request->tipo_documento;
            $pagare->por               =  $request->por;
            $pagare->fecha             =  $request->fecha;
            $pagare->nombre            =  $request->nombre;
            $pagare->cantidad          =  $request->cantidad;
            $pagare->interes           =  $request->interes;
            $pagare->ciudad            =  $request->ciudad;
            $pagare->fecha_vencimiento =  $request->fecha_vencimiento;
            $pagare->señor             =  $request->señor;
            $pagare->deudor1           =  $request->deudor1;
            $pagare->garante           =  $request->garante;
            $pagare->save();
             return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado'  => 'guardado',
                    'pagare'  => $pagare,
                    'message' => 'Kardex Fifo actualizado correctamente'
                ),200,[]);   
    }
       public function papeleta(Request $request)
    {
            $userID                   = Auth::id();
            $tallerID                 = $request->id;
            $papeleta                 = new  ModuloPapeleta;
            $papeleta->taller_id      =  $tallerID;
            $papeleta->user_id        =  $userID;
            $papeleta->modulo         =  $request->modulo;
            $papeleta->tipo_documento =  $request->tipo_documento;
            $papeleta->banco          =  $request->banco;
            $papeleta->cuenta         =  $request->cuenta;
            $papeleta->nombre         =  $request->nombre;
            $papeleta->lugar_fecha    =  $request->lugar_fecha;
            $papeleta->cantidad       =  $request->cantidad;
            $papeleta->depositante    =  $request->depositante;
            $papeleta->save();
             return response(array(                                         //ENVIO DE RESPUESTA
                    'success'           => true,
                    'estado'            => 'guardado',
                    'papeleta_deposito' => $papeleta,
                    'message'           => 'Kardex Fifo actualizado correctamente'
                ),200,[]);   
    }
    public function documentos(Request $request)
    {
        $user          = User::find(Auth::id());
        $tallerID      = $request->id;
        
        $cheques       = ModuloCheque::where('taller_id', $tallerID)->where('user_id', $user->id)->get();
        $nota_creditos = ModuloNotaCredito::where('taller_id', $tallerID)->where('user_id', $user->id)->get();
        $facturas      = ModuloFactura::where('taller_id', $tallerID)->where('user_id', $user->id)->get();
        $letras        = ModuloLetraCambio::where('taller_id', $tallerID)->where('user_id', $user->id)->get();
        $pagares       = ModuloPagare::where('taller_id', $tallerID)->where('user_id', $user->id)->get();
        $papeleta_depositos       = ModuloPapeleta::where('taller_id', $tallerID)->where('user_id', $user->id)->get();




    	return response(array(                                         //ENVIO DE RESPUESTA
                    'success'  => true,
                    'estado'   => 'guardado',
                    'cheques'  => $cheques,
                    'creditos' => $nota_creditos,
                    'facturas' => $facturas,
                    'letras'   => $letras,
                    'pagares'   => $pagares,
                    'papeleta_depositos'   => $papeleta_depositos,
                    'message'  => 'Kardex Fifo actualizado correctamente'
                ),200,[]);
    }
        public function vista(Request $request)
    {
        $user = User::find($request->user);
        $tallerID = $request->id;

        // $cheques       = $user->cheques->where('taller_id', $tallerID);
        // $nota_creditos = $user->creditos->where('taller_id', $tallerID);
        // $facturas      = $user->facturas->where('taller_id', $tallerID);
        // $facturas      = $user->facturas->where('taller_id', $tallerID);
        $cheques       = ModuloCheque::where('taller_id', $tallerID)->where('user_id', $user->id)->get();
        $nota_creditos = ModuloNotaCredito::where('taller_id', $tallerID)->where('user_id', $user->id)->get();
        $facturas      = ModuloFactura::where('taller_id', $tallerID)->where('user_id', $user->id)->get();
        $letras        = ModuloLetraCambio::where('taller_id', $tallerID)->where('user_id', $user->id)->get();
        $pagares       = ModuloPagare::where('taller_id', $tallerID)->where('user_id', $user->id)->get();
        $papeleta_depositos       = ModuloPapeleta::where('taller_id', $tallerID)->where('user_id', $user->id)->get();


        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'cheques' => $cheques,
                    'creditos' => $nota_creditos,
                    'facturas' => $facturas,
                    'letras'   => $letras,
                    'pagares'   => $pagares,
                    'papeleta_depositos'   => $papeleta_depositos,
                    'message' => 'Kardex Fifo actualizado correctamente'
                ),200,[]);
    }
        public function edicion(Request $request)
    {
    
		$tipo = $request->tipo;
		$id = $request->id;

		if ($tipo == 'cheque') {
			$cheque                 = ModuloCheque::find($id);
			$cheque->modulo         =  $request->modulo;
			$cheque->tipo_documento =  $request->tipo_documento;
			$cheque->tipo_cheque    =  $request->tipo_cheque;
			$cheque->banco          =  $request->banco;
			$cheque->girador        =  $request->girador;
			$cheque->cantidad       =  $request->cantidad;
			$cheque->n_cheque       =  $request->n_cheque;
			$cheque->cantidad_letra =  $request->cantidad_letra;
			$cheque->ciudad         =  $request->ciudad;
			$cheque->fecha          =  $request->fecha;
			$cheque->firma          =  $request->firma;
			$cheque->save();
		}elseif ($tipo == 'nota_credito') {

            $nota_credito                     = ModuloNotaCredito::find($id);
            $nota_credito->modulo             =  $request->modulo;
            $nota_credito->tipo_documento     =  $request->tipo_documento;
            $nota_credito->razon_social       =  $request->razon_social;
            $nota_credito->fecha_emision      =  $request->fecha_emision;
            $nota_credito->ruc                =  $request->ruc;
            $nota_credito->comprobante        =  $request->comprobante;
            $nota_credito->razon_modificacion =  $request->razon_modificacion;
            $nota_credito->emision            =  $request->emision;
            $nota_credito->datos              = json_encode($request->datos);
            $nota_credito->totales            = json_encode($request->totales);
            $nota_credito->save();

			
		}
        elseif ($tipo == 'factura') {

            $factura                     = ModuloFactura::find($id);
            $factura->modulo             =  $request->modulo;
            $factura->tipo_documento     =  $request->tipo_documento;
            $factura->razon_social       =  $request->razon_social;
            $factura->fecha_emision      =  $request->fecha_emision;
            $factura->ruc                =  $request->ruc;
            $factura->guia_remision      =  $request->guia_remision;
            $factura->datos              = json_encode($request->datos);
            $factura->totales            = json_encode($request->totales);
            $factura->save();

            
        }
          elseif ($tipo == 'letra_cambio') {

            $letra_cambio                 =   ModuloLetraCambio::find($id);
            $letra_cambio->modulo         =  $request->modulo;
            $letra_cambio->tipo_documento =  $request->tipo_documento;
            $letra_cambio->vencimiento    =  $request->vencimiento;
            $letra_cambio->numero         =  $request->numero;
            $letra_cambio->por            =  $request->por;
            $letra_cambio->ciudad         =  $request->ciudad;
            $letra_cambio->fecha          =  $request->fecha;
            $letra_cambio->orden_de       =  $request->orden_de;
            $letra_cambio->de             =  $request->de;
            $letra_cambio->cantidad       =  $request->cantidad;
            $letra_cambio->interes        =  $request->interes;
            $letra_cambio->desde          =  $request->desde;
            $letra_cambio->direccion      =  $request->direccion;
            $letra_cambio->ciudad2        =  $request->ciudad2;
            $letra_cambio->atentamente    =  $request->atentamente;
            $letra_cambio->save();


            
        }
           elseif ($tipo == 'pagare') {
            $pagare                     =   ModuloPagare::find($id);
            $pagare->modulo             =  $request->modulo;
            $pagare->tipo_documento    =  $request->tipo_documento;
            $pagare->por               =  $request->por;
            $pagare->fecha             =  $request->fecha;
            $pagare->nombre            =  $request->nombre;
            $pagare->cantidad          =  $request->cantidad;
            $pagare->interes           =  $request->interes;
            $pagare->ciudad            =  $request->ciudad;
            $pagare->fecha_vencimiento =  $request->fecha_vencimiento;
            $pagare->señor             =  $request->señor;
            $pagare->deudor1           =  $request->deudor1;
            $pagare->garante           =  $request->garante;
            $pagare->save();
        }
            elseif ($tipo == 'papeleta_deposito') {
            $papeleta                 =   ModuloPapeleta::find($id);
            $papeleta->modulo         =  $request->modulo;
            $papeleta->tipo_documento =  $request->tipo_documento;
            $papeleta->banco          =  $request->banco;
            $papeleta->cuenta         =  $request->cuenta;
            $papeleta->nombre         =  $request->nombre;
            $papeleta->lugar_fecha    =  $request->lugar_fecha;
            $papeleta->cantidad       =  $request->cantidad;
            $papeleta->depositante    =  $request->depositante;
            $papeleta->save();
        }
    	return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    // 'cheques' => $cheque,
                    'message' => 'Documento actualizado correctamente'
                ),200,[]);


    }
        public function eliminar(Request $request)
    {
    
		$tipo = $request->tipo;
		$id = $request->id;

		if ($tipo === 'Cheque') {
			$cheque                 = ModuloCheque::find($id);
			$cheque->delete();
		}elseif ($tipo === 'Nota de Credito') {
			$nota_credito = ModuloNotaCredito::find($id);
            $nota_credito->delete();
		}elseif ($tipo === 'Factura') {
            $factura = ModuloFactura::find($id);
            $factura->delete();
        }
        elseif ($tipo === 'Letra de Cambio') {
            $letra_cambio = ModuloLetraCambio::find($id);
            $letra_cambio->delete();
        }
          elseif ($tipo === 'Pagare') {
            $pagare = ModuloPagare::find($id);
            $pagare->delete();
        }
          elseif ($tipo === 'Papeleta De Deposito') {
            $papeleta = ModuloPapeleta::find($id);
            $papeleta->delete();
        }
    	return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'elimina',
                    // 'cheques' => $cheque,
                    'message' => 'Documento eliminado correctamente'
                ),200,[]);


    }
    public function nota_credito(Request $request)
    {
        $userID = Auth::id();
        $tallerID = $request->id;
            $nota_credito                     = new  ModuloNotaCredito;
            $nota_credito->taller_id          =  $tallerID;
            $nota_credito->user_id            =  $userID;
            $nota_credito->modulo             =  $request->modulo;
            $nota_credito->tipo_documento     =  $request->tipo_documento;
            $nota_credito->razon_social       =  $request->razon_social;
            $nota_credito->fecha_emision      =  $request->fecha_emision;
            $nota_credito->ruc                =  $request->ruc;
            $nota_credito->comprobante        =  $request->comprobante;
            $nota_credito->razon_modificacion =  $request->razon_modificacion;
            $nota_credito->emision            =  $request->emision;
            $nota_credito->datos              = json_encode($request->datos);
            $nota_credito->totales            = json_encode($request->totales);
            $nota_credito->save();
             return response(array(  
                    'success' => true,
                    'estado' => 'guardado',
                    'nota_credito' => $nota_credito,
                    'message' => 'Kardex Fifo actualizado correctamente'
                ),200,[]);
    }
        public function factura(Request $request)
    {
            $userID = Auth::id();
            $tallerID = $request->id;
            $factura                     = new  ModuloFactura;
            $factura->taller_id          =  $tallerID;
            $factura->user_id            =  $userID;
            $factura->modulo             =  $request->modulo;
            $factura->tipo_documento     =  $request->tipo_documento;
            $factura->razon_social       =  $request->razon_social;
            $factura->fecha_emision      =  $request->fecha_emision;
            $factura->ruc                =  $request->ruc;
            $factura->guia_remision      =  $request->guia_remision;
            $factura->datos              = json_encode($request->datos);
            $factura->totales            = json_encode($request->totales);
            $factura->save();
             return response(array(  
                    'success' => true,
                    'estado' => 'guardado',
                    'factura' => $factura,
                    'message' => 'Kardex Fifo actualizado correctamente'
                ),200,[]);
    }
}
