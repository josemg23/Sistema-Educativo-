<?php

namespace App\Http\Controllers;

use App\Admin\TallerContabilidad;

use App\Anexocaja;
use App\Arqueocajas;
use App\ArqueoExi;
use App\ArqueoSaldo;
use App\Cajadatos;
use App\Conciliacionbancaria;
use App\Conciliacioncheque;
use App\Conciliacioncredito;
use App\Conciliaciondebito;
use App\Conciliacionsaldo;
use App\Conciliaciondeposito;

use App\Admin\TallerModuloContable;
use App\Admin\TallerModuloTransaccion;
use App\Contabilidad\BCARegistro;
use App\Contabilidad\BCRegistro;
use App\Contabilidad\BIActivo;
use App\Contabilidad\BIPasivo;
use App\Contabilidad\BIPatrimonio;
use App\Contabilidad\BGActivo;
use App\Contabilidad\BGPasivo;
use App\Contabilidad\BGPatrimonio;
use App\Contabilidad\BalanceAjustado;
use App\Contabilidad\BalanceComprobacion;
use App\Contabilidad\BalanceInicial;
use App\Contabilidad\BalanceGeneral;
use App\Contabilidad\DGRDebe;
use App\Contabilidad\DGRHaber;
use App\Contabilidad\DGRegistro;
use App\Contabilidad\DiarioGeneral;
use App\Contabilidad\ACRDebe;
use App\Contabilidad\ACRHaber;
use App\Contabilidad\ACRegistro;
use App\Contabilidad\AsientoCierre;
use App\Contabilidad\ERIngreso;
use App\Contabilidad\EstadoResultado;
use App\Contabilidad\HTRegistro;
use App\Contabilidad\HojaTrabajo;
use App\Contabilidad\KFRMovimiento;
use App\Contabilidad\KFRegistro;
use App\Contabilidad\KPRegistro;
use App\Contabilidad\KardexFIfo;
use App\Contabilidad\KardexPromedio;
use App\Librobanco;
use App\Movimientobanco;
use App\Contabilidad\MGRMovimiento;
use App\Contabilidad\MGRegistro;
use App\Contabilidad\MayorGeneral;
use App\Movimientonomina;
use App\Movimientoprovision;
use App\Nominaempleado;
use App\Provisionsocial;
use App\Retencioniva;
use App\Retencionivacompra;
use App\Retencionivaventa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TallerContabilidadController extends Controller
{
      
       
         public function kardexFifo(Request $request)
            {
                            $id            = Auth::id();
                            $taller_id     = $request->id;
                            $producto_id   = $request->producto_id;
                            $transacciones = $request->kardex_fifo;
                            $conteokardex  = KardexFifo::where('user_id',$id)->where('taller_id', $taller_id)->where('producto_id', $producto_id)->count();
                            if ($conteokardex == 0) { 

                            $kardexfifo                       = new KardexFifo;
                            $kardexfifo->taller_id            = $taller_id;
                            $kardexfifo->user_id              = $id;
                            $kardexfifo->producto_id          = $request->producto_id;
                            $kardexfifo->nombre               = $request->nombre;
                            $kardexfifo->producto             = $request->producto;
                            $kardexfifo->inv_inicial_cantidad = $request->inv_inicial_cantidad;
                            $kardexfifo->adquisicion_cantidad = $request->adquisicion_cantidad;
                            $kardexfifo->ventas_cantidad      = $request->ventas_cantidad;
                            $kardexfifo->inv_final_cantidad   = $request->inv_final_cantidad;
                            $kardexfifo->inv_inicial_precio   = $request->inv_inicial_precio;
                            $kardexfifo->adquisicion_precio   = $request->adquisicion_precio;
                            $kardexfifo->ventas_precio        = $request->ventas_precio;
                            $kardexfifo->inv_final_precio     = $request->inv_final_precio;
                            $kardexfifo->save();

                            $kardexF = KardexFifo::where('user_id', $id)->get()->last();
                                foreach ($transacciones as $key => $value) {                         //RECORRER TODOS LOS REGISTROS EN EL ARRAY
                                    $regis=array(
                                            'kardex_fifo_id'     => $kardexF->id,
                                            'no_registro'        => $key + 1,
                                            // 'comentario'         => $value['comentario'],
                                            // 'fecha'              => $value['debe']['fecha'],
                                            'created_at'         => now(),
                                            'updated_at'         => now(),
                                        );
                                    KFRegistro::insert($regis);                           //GUARDAR CADA REGISTRO EN LA BASE DE DATOS
                                }
                                $register = $kardexF->kfRegistro;
                                foreach ($transacciones as $key => $value) {                         ////RECORRER TODOS LOS REGISTROS EN EL ARRAY
                                    foreach ($value as $key1 => $value1) {              ////RECORRER TODOS LAS CUENTAS DE DEBE QUE PERTENECEN A UN REGISTRO
                                        $regis1=array(
                                            'k_f_registro_id'     => $register[$key]->id,
                                            'fecha'               => $value1['fecha'],
                                            'movimiento'          => $value1['movimiento'],
                                            'tipo'                => $value1['tipo'],
                                            'ingreso_cantidad'    => $value1['ingreso_cantidad'],
                                            'ingreso_precio'      => $value1['ingreso_precio'],
                                            'ingreso_total'       => $value1['ingreso_total'],
                                            'egreso_cantidad'     => $value1['egreso_cantidad'],
                                            'egreso_precio'       => $value1['egreso_precio'],
                                            'egreso_total'        => $value1['egreso_total'],
                                            'existencia_cantidad' => $value1['existencia_cantidad'],
                                            'existencia_precio'   => $value1['existencia_precio'],
                                            'existencia_total'    => $value1['existencia_total'],
                                            'created_at'          => now(),
                                            'updated_at'          => now(),
                                        );
                                    KFRMovimiento::insert($regis1);                             //GURDAR ESAS CUENTAS EN LA TABLA DEBE CON EL ID DEL REGISTRO AL QUE CORRESPONDEN
                                    }
                                }                                           //GUARDAR ESE CAMBIO
                                return response(array(                                         //ENVIO DE RESPUESTA
                                        'success' => true,
                                        'estado' => 'guardado',
                                        'message' => 'Kardex Fifo creado correctamente'
                                    ),200,[]);
                                
                        }else{
                        $kardexfifod  = KardexFifo::where('user_id',$id)->where('taller_id', $taller_id)->where('producto_id', $producto_id)->first();
                        $idkardex = $kardexfifod->id;
                        $kardexfifod->delete();
                        $kardexfifo                       = new KardexFifo;
                            $kardexfifo->id                    = $idkardex;
                            $kardexfifo->taller_id            = $taller_id;
                            $kardexfifo->user_id              = $id;
                            $kardexfifo->producto_id          = $request->producto_id;
                            $kardexfifo->nombre               = $request->nombre;
                            $kardexfifo->producto             = $request->producto;
                            $kardexfifo->inv_inicial_cantidad = $request->inv_inicial_cantidad;
                            $kardexfifo->adquisicion_cantidad = $request->adquisicion_cantidad;
                            $kardexfifo->ventas_cantidad      = $request->ventas_cantidad;
                            $kardexfifo->inv_final_cantidad   = $request->inv_final_cantidad;
                            $kardexfifo->inv_inicial_precio   = $request->inv_inicial_precio;
                            $kardexfifo->adquisicion_precio   = $request->adquisicion_precio;
                            $kardexfifo->ventas_precio        = $request->ventas_precio;
                            $kardexfifo->inv_final_precio     = $request->inv_final_precio;
                            $kardexfifo->save();

                            $kardexF = KardexFifo::where('user_id', $id)->where('producto_id', $producto_id)->get()->last();
                                foreach ($transacciones as $key => $value) {                         //RECORRER TODOS LOS REGISTROS EN EL ARRAY
                                    $regis=array(
                                            'kardex_fifo_id'     => $kardexF->id,
                                            'no_registro'        => $key + 1,
                                            // 'comentario'         => $value['comentario'],
                                            // 'fecha'              => $value['debe']['fecha'],
                                            'created_at'         => now(),
                                            'updated_at'         => now(),
                                        );
                                    KFRegistro::insert($regis);                           //GUARDAR CADA REGISTRO EN LA BASE DE DATOS
                                }
                                $register = $kardexF->kfRegistro;
                                foreach ($transacciones as $key => $value) {                         ////RECORRER TODOS LOS REGISTROS EN EL ARRAY
                                    foreach ($value as $key1 => $value1) {              ////RECORRER TODOS LAS CUENTAS DE DEBE QUE PERTENECEN A UN REGISTRO
                                        $regis1=array(
                                            'k_f_registro_id'     => $register[$key]->id,
                                            'fecha'               => $value1['fecha'],
                                            'movimiento'          => $value1['movimiento'],
                                            'tipo'                => $value1['tipo'],
                                            'ingreso_cantidad'    => $value1['ingreso_cantidad'],
                                            'ingreso_precio'      => $value1['ingreso_precio'],
                                            'ingreso_total'       => $value1['ingreso_total'],
                                            'egreso_cantidad'     => $value1['egreso_cantidad'],
                                            'egreso_precio'       => $value1['egreso_precio'],
                                            'egreso_total'        => $value1['egreso_total'],
                                            'existencia_cantidad' => $value1['existencia_cantidad'],
                                            'existencia_precio'   => $value1['existencia_precio'],
                                            'existencia_total'    => $value1['existencia_total'],
                                            'created_at'          => now(),
                                            'updated_at'          => now(),
                                        );
                                    KFRMovimiento::insert($regis1);                             //GURDAR ESAS CUENTAS EN LA TABLA DEBE CON EL ID DEL REGISTRO AL QUE CORRESPONDEN
                                    }
                                }                                           //GUARDAR ESE CAMBIO
                                return response(array(                                         //ENVIO DE RESPUESTA
                                        'success' => true,
                                        'estado' => 'actualizado',
                                        'message' => 'Kardex Fifo actualizado correctamente'
                                    ),200,[]);
                                


                        }
            }
        public function obtenerKardexFifo(Request $request)
            {
                $id         = Auth::id();
                $taller_id  = $request->id;
                $producto_id = $request->producto_id;
                $kardexFifo = KardexFifo::where('user_id',$id)->where('taller_id', $taller_id)->where('producto_id', $producto_id)->count();
                $registros  = [];
                if ($kardexFifo  >= 1) {
                    $producto =  TallerModuloTransaccion::where('id', $producto_id)->first();
                    $kardex  = KardexFifo::select('id', 'nombre', 'producto', 'inv_inicial_cantidad', 'adquisicion_cantidad', 'ventas_cantidad', 'inv_final_cantidad', 'inv_inicial_precio', 'adquisicion_precio', 'ventas_precio', 'inv_final_precio')->where('user_id',$id)->where('taller_id', $taller_id)->where('producto_id', $producto_id)->first();

                $obtener = KFRegistro::where('kardex_fifo_id', $kardex->id)->get();
                    foreach ($obtener as $key => $registro) {
                        $registros[$key]= $registro->kfrMovimientos;
                    }
                    return response(array(
                        'datos' => true,
                        'kardex_fifo' => $registros,
                        'informacion' => $kardex,
                        'transacciones' => $producto
                    ),200,[]);

                }else{
                    $producto = TallerModuloTransaccion::where('id', $producto_id)->first();
                    return response(array(
                        'datos' => false,
                        'transacciones' => $producto
                    ),200,[]);

                }
            }

        public function kardexPromedio(Request $request)
            {
                $id                 = Auth::id();
                $taller_id          = $request->id;
                $kardex             = $request->kardex_promedio;
                $producto_id  = $request->producto_id;
                $kardexCompro       = KardexPromedio::where('user_id',$id)->where('taller_id', $taller_id)->where('producto_id', $producto_id)->count();
                if ($kardexCompro  == 0) {
                // $contenido          = TallerContabilidad::select('enunciado')->where('taller_id', $taller_id)->firstOrFail();
                $kardex_promedio            = new KardexPromedio;
                $kardex_promedio->taller_id            = $taller_id;
                $kardex_promedio->user_id              = $id;
                $kardex_promedio->nombre               = $request->nombre;
                $kardex_promedio->producto             = $request->producto;
                $kardex_promedio->producto_id          = $request->producto_id;
                $kardex_promedio->inv_inicial_cantidad = $request->inv_inicial_cantidad;
                $kardex_promedio->adquisicion_cantidad = $request->adquisicion_cantidad;
                $kardex_promedio->ventas_cantidad      = $request->ventas_cantidad;
                $kardex_promedio->inv_final_cantidad   = $request->inv_final_cantidad;
                $kardex_promedio->inv_inicial_precio   = $request->inv_inicial_precio;
                $kardex_promedio->adquisicion_precio   = $request->adquisicion_precio;
                $kardex_promedio->ventas_precio        = $request->ventas_precio;
                $kardex_promedio->inv_final_precio     = $request->inv_final_precio;
                $kardex_promedio->save();

                $o = KardexPromedio::where('user_id', $id)->get()->last(); 

                foreach ($kardex as $key => $kardex_promedio) {
                        $datos=array(
                            'kardex_promedio_id'  => $o->id,
                            'fecha'               => $kardex_promedio['fecha'],
                            'movimiento'          => $kardex_promedio['movimiento'],
                            'tipo'                 => $kardex_promedio['tipo'],
                            'ingreso_cantidad'    => $kardex_promedio['ingreso_cantidad'],
                            'ingreso_precio'      => $kardex_promedio['ingreso_precio'],
                            'ingreso_total'       => $kardex_promedio['ingreso_total'],
                            'egreso_cantidad'     => $kardex_promedio['egreso_cantidad'],
                            'egreso_precio'       => $kardex_promedio['egreso_precio'],
                            'egreso_total'        => $kardex_promedio['egreso_total'],
                            'existencia_cantidad' => $kardex_promedio['existencia_cantidad'],
                            'existencia_precio'   => $kardex_promedio['existencia_precio'],
                            'existencia_total'    => $kardex_promedio['existencia_total'],
                            'created_at'          => now(),
                            'updated_at'          => now(),
                        );
                        KPRegistro::insert($datos);
                    }
                return response(array(
                        'success' => true,
                        'estado'  => 'guardado',
                        'message' => 'Kardex Promedio creado correctamente'
                    ),200,[]);
                }elseif($kardexCompro  == 1){
                $ids                                 = [];
                $kardexComprob                       = KardexPromedio::where('user_id',$id)->where('taller_id', $taller_id)->where('producto_id', $producto_id)->first();
                $kardexComprob->nombre               = $request->nombre;
                $kardexComprob->producto             = $request->producto;
                $kardexComprob->producto_id          = $request->producto_id;
                $kardexComprob->inv_inicial_cantidad = $request->inv_inicial_cantidad;
                $kardexComprob->adquisicion_cantidad = $request->adquisicion_cantidad;
                $kardexComprob->ventas_cantidad      = $request->ventas_cantidad;
                $kardexComprob->inv_final_cantidad   = $request->inv_final_cantidad;
                $kardexComprob->inv_inicial_precio   = $request->inv_inicial_precio;
                $kardexComprob->adquisicion_precio   = $request->adquisicion_precio;
                $kardexComprob->ventas_precio        = $request->ventas_precio;
                $kardexComprob->inv_final_precio     = $request->inv_final_precio;
                $kardexComprob->save();


                $registros= KPRegistro::where('kardex_promedio_id', $kardexComprob->id)->get();
                
                foreach($registros as $regis){
                        $ids[]=$regis->id;
                }
                $deleteRegistros = KPRegistro::destroy($ids);
                $o = KardexPromedio::where('user_id', $id)->get()->last(); 
                foreach ($kardex as $key => $kardex_promedio) {
                            $datos=array(
                            'kardex_promedio_id'  => $o->id,
                            'fecha'               => $kardex_promedio['fecha'],
                            'movimiento'          => $kardex_promedio['movimiento'],
                            'tipo'                 => $kardex_promedio['tipo'],
                            'ingreso_cantidad'    => $kardex_promedio['ingreso_cantidad'],
                            'ingreso_precio'      => $kardex_promedio['ingreso_precio'],
                            'ingreso_total'       => $kardex_promedio['ingreso_total'],
                            'egreso_cantidad'     => $kardex_promedio['egreso_cantidad'],
                            'egreso_precio'       => $kardex_promedio['egreso_precio'],
                            'egreso_total'        => $kardex_promedio['egreso_total'],
                            'existencia_cantidad' => $kardex_promedio['existencia_cantidad'],
                            'existencia_precio'   => $kardex_promedio['existencia_precio'],
                            'existencia_total'    => $kardex_promedio['existencia_total'],
                            'created_at'          => now(),
                            'updated_at'          => now(),
                        );
                        KPRegistro::insert($datos);
                    }
                    return response(array(
                        'success' => true,
                        'estado' => 'actualizado',
                        'message' => 'Balance de Comprobacion Ajustado actualizado correctamente'
                    ),200,[]);

                }
            }

        public function obtenerKardexPromedio(Request $request)
            {
                $id         = Auth::id();
                $taller_id  = $request->id;
                $producto_id  = $request->producto_id;
                $kardexpro = KardexPromedio::where('user_id',$id)->where('taller_id', $taller_id)->where('producto_id', $producto_id)->count();
                $producto = TallerModuloTransaccion::where('id', $producto_id)->first();

                // $registros  = [];
                if ($kardexpro  == 1) {

                    $kardexPromedio = KardexPromedio::select('id', 'nombre', 'producto', 'inv_inicial_cantidad', 'adquisicion_cantidad', 'ventas_cantidad', 'inv_final_cantidad', 'inv_inicial_precio', 'adquisicion_precio', 'ventas_precio', 'inv_final_precio',)->where('user_id',$id)->where('taller_id', $taller_id)->first();

                    $obtener       = KPRegistro::select('fecha', 'movimiento', 'tipo', 'ingreso_cantidad', 'ingreso_precio', 'ingreso_total', 'egreso_cantidad', 'egreso_precio','egreso_total','existencia_cantidad','existencia_precio','existencia_total')->where('kardex_promedio_id', $kardexPromedio->id)->get();
                
                    return response(array(
                        'datos' => true,
                        'informacion' => $kardexPromedio,
                        'kardex_promedio' => $obtener,
                        'transacciones' => $producto

                    ),200,[]);

                }else{
                    return response(array(
                        'datos' => false,
                        'transacciones' => $producto

                    ),200,[]);

                }
            }


        public function balanceAjustado(Request $request)
            {
                $id                    = Auth::id();
                $taller_id             = $request->id;
                $balances              = $request->balances;
                $balanceCompro         = BalanceAjustado::where('user_id',$id)->where('taller_id', $taller_id)->count();
                if ($balanceCompro     == 0) {
                // $contenido          = TallerContabilidad::select('enunciado')->where('taller_id', $taller_id)->firstOrFail();
                $balance               = new BalanceAjustado;
                $balance->taller_id    = $taller_id ;
                $balance->user_id      = $id;
                // $balance->enunciado = $contenido->enunciado;
                $balance->nombre       = $request->nombre;
                $balance->fecha        = $request->fecha;
                $balance->total_debe   = $request->total_debe;
                $balance->total_haber  = $request->total_haber;
                $balance->save();
                $o = BalanceAjustado::where('user_id', $id)->get()->last(); 
                foreach ($balances as $key => $balance) {
                        $datos=array(
                            'balance_ajustado_id' => $o->id,
                            'cuenta'              => $balance['cuenta'],
                            'cuenta_id'           => $balance['cuenta_id'],
                            'debe'                => $balance['debe'],
                            'haber'               => $balance['haber'],
                            'created_at'          => now(),
                            'updated_at'          => now(),
                        );
                        BCARegistro::insert($datos);
                    }
                return response(array(
                        'success' => true,
                        'estado'  => 'guardado',
                        'message' => 'Balance de Comprobacion Ajustado creado correctamente'
                    ),200,[]);
                }elseif($balanceCompro  == 1){
                $ids                         = [];
                $balanceComprob              = BalanceAjustado::where('user_id',$id)->where('taller_id', $taller_id)->first();
                $balanceComprob->total_debe  = $request->total_debe;
                $balanceComprob->nombre      = $request->nombre;
                $balanceComprob->fecha       = $request->fecha;
                $balanceComprob->total_haber = $request->total_haber;
                $balanceComprob->save();

                $registros= BCARegistro::where('balance_ajustado_id', $balanceComprob->id)->get();
                
                foreach($registros as $regis){
                        $ids[]=$regis->id;
                }
                $deleteRegistros = BCARegistro::destroy($ids);
                $o = BalanceAjustado::where('user_id', $id)->get()->last(); 
                foreach ($balances as $key => $balance) {
                        $datos=array(
                            'balance_ajustado_id' => $o->id,
                            'cuenta'                  => $balance['cuenta'],
                            'cuenta_id'                  => $balance['cuenta_id'],
                            'debe'                    => $balance['debe'],
                            'haber'                   => $balance['haber'],
                            'created_at'              => now(),
                            'updated_at'              => now(),
                        );
                        BCARegistro::insert($datos);
                    }
                    return response(array(
                        'success' => true,
                        'estado' => 'actualizado',
                        'message' => 'Balance de Comprobacion Ajustado actualizado correctamente'
                    ),200,[]);
                }
            }
        public function obtenerBalanceAjustado(Request $request)
            {
                $id         = Auth::id();
                $taller_id  = $request->id;
                $dioGeneral = BalanceAjustado::where('user_id',$id)->where('taller_id', $taller_id)->count();
                // $registros  = [];
                if ($dioGeneral  == 1) {
                    $balanceCompro = BalanceAjustado::where('user_id',$id)->where('taller_id', $taller_id)->first();
                    $obtener       = BCARegistro::select('cuenta', 'cuenta_id','debe', 'haber')->where('balance_ajustado_id', $balanceCompro->id)->get();
                
                    return response(array(
                        'datos' => true,
                        'nombre' => $balanceCompro->nombre,
                        'fecha' => $balanceCompro->fecha,
                        'bcomprobacionAjustado' => $obtener
                    ),200,[]);

                }else{
                    return response(array(
                        'datos' => false,
                    ),200,[]);

                }
            }
         public function balanceComprobacion(Request $request)
            {
                $id                 = Auth::id();
                $taller_id          = $request->id;
                $balances           = $request->balances;
                $balanceCompro      = BalanceComprobacion::where('user_id',$id)->where('taller_id', $taller_id)->count();
                if ($balanceCompro  == 0) {
                // $contenido          = TallerContabilidad::select('enunciado')->where('taller_id', $taller_id)->firstOrFail();
                $balance            = new BalanceComprobacion;
                $balance->taller_id = $taller_id ;
                $balance->user_id   = $id;
                // $balance->enunciado = $contenido->enunciado;
                $balance->nombre    = $request->nombre;
                $balance->fecha     = $request->fecha;
                $balance->sum_debe  = $request->sum_debe;
                $balance->sum_haber = $request->sum_haber;
                $balance->sal_debe  = $request->sal_debe;
                $balance->sal_haber = $request->sal_haber;
                $balance->save();

                $o = BalanceComprobacion::where('user_id', $id)->get()->last(); 

                foreach ($balances as $key => $balance) {
                        $datos=array(
                            'balance_comprobacion_id' => $o->id,
                            'cuenta_id'               => $balance['cuenta_id'],
                            'cuenta'                  => $balance['cuenta'],
                            'suma_debe'               => $balance['suma_debe'],
                            'suma_haber'              => $balance['suma_haber'],
                            'saldo_debe'              => $balance['saldo_debe'],
                            'saldo_haber'             => $balance['saldo_haber'],
                            'created_at'              => now(),
                            'updated_at'              => now(),
                        );
                        BCRegistro::insert($datos);
                    }
                return response(array(
                        'success' => true,
                        'estado' => 'guardado',
                        'message' => 'Balance de Comprobacion creado correctamente'
                    ),200,[]);
                }elseif($balanceCompro  == 1){
                $ids = [];
                $balanceComprob  = BalanceComprobacion::where('user_id',$id)->where('taller_id', $taller_id)->first();
                $balanceComprob->nombre    = $request->nombre;
                $balanceComprob->fecha     = $request->fecha;
                $balanceComprob->sum_debe  = $request->sum_debe;
                $balanceComprob->sum_haber = $request->sum_haber;
                $balanceComprob->sal_debe  = $request->sal_debe;
                $balanceComprob->sal_haber = $request->sal_haber;
                $balanceComprob->save();


                $registro= BCRegistro::where('balance_comprobacion_id', $balanceComprob->id)->get();
                
                foreach($registro as $regis){
                        $ids[]=$regis->id;
                }
                $deleteRegistros = BCRegistro::destroy($ids);
                $o = BalanceComprobacion::where('user_id', $id)->get()->last(); 
                foreach ($balances as $key => $balance) {
                        $datos=array(
                            'balance_comprobacion_id' => $o->id,
                            'cuenta'                  => $balance['cuenta'],
                            'cuenta_id'               => $balance['cuenta_id'],
                            'suma_debe'               => $balance['suma_debe'],
                            'suma_haber'              => $balance['suma_haber'],
                            'saldo_debe'              => $balance['saldo_debe'],
                            'saldo_haber'             => $balance['saldo_haber'],
                            'created_at'              => now(),
                            'updated_at'              => now(),
                        );
                        BCRegistro::insert($datos);
                    }



                    return response(array(
                        'success' => true,
                        'estado' => 'actualizado',
                        'message' => 'Balance de Comprobacion actualizado correctamente'
                    ),200,[]);

                }

            }
        public function obtenerBalanceCompro(Request $request)
            {
                $id         = Auth::id();
                $taller_id  = $request->id;
                $dioGeneral = BalanceComprobacion::where('user_id',$id)->where('taller_id', $taller_id)->count();
                // $registros  = [];
                if ($dioGeneral  == 1) {
                    $balanceCompro = BalanceComprobacion::where('user_id',$id)->where('taller_id', $taller_id)->first();
                    $obtener       = BCRegistro::select('cuenta','cuenta_id', 'suma_debe', 'suma_haber', 'saldo_debe', 'saldo_haber')->where('balance_comprobacion_id', $balanceCompro->id)->get();
                
                    return response(array(
                        'datos' => true,
                        'bcomprobacion' => $obtener,
                        'nombre' => $balanceCompro->nombre,
                        'fecha' => $balanceCompro->fecha
                    ),200,[]);

                }else{
                    return response(array(
                        'datos' => false,
                    ),200,[]);

                }
            }

        public function hojaTrabajo(Request $request)
            {
                $id                              = Auth::id();
                $taller_id                       = $request->id;
                $registros                       = $request->registros;
                $hojaTra                         = HojaTrabajo::where('user_id',$id)->where('taller_id', $taller_id)->count();
                if ($hojaTra                     == 0) {
                // $contenido                    = TallerContabilidad::select('enunciado')->where('taller_id', $taller_id)->firstOrFail();
                $hojaTrabajo                     = new HojaTrabajo;
                $hojaTrabajo->taller_id          = $taller_id ;
                $hojaTrabajo->user_id            = $id;
                // $hojaTrabajo->enunciado       = $contenido->enunciado;
                $hojaTrabajo->nombre             = $request->nombre;
                // $hojaTrabajo->fecha           = $request->fecha;
                $hojaTrabajo->bc_total_debe      = $request->bc_total_debe;
                $hojaTrabajo->bc_total_haber     = $request->bc_total_haber;
                $hojaTrabajo->ajuste_total_debe  = $request->ajuste_total_debe;
                $hojaTrabajo->ajuste_total_haber = $request->ajuste_total_haber;
                $hojaTrabajo->ba_total_debe      = $request->ba_total_debe;
                $hojaTrabajo->ba_total_haber     = $request->ba_total_haber;
                $hojaTrabajo->er_total_debe      = $request->er_total_debe;
                $hojaTrabajo->er_total_haber     = $request->er_total_haber;
                $hojaTrabajo->bg_total_debe      = $request->bg_total_debe;
                $hojaTrabajo->bg_total_haber     = $request->bg_total_haber;
                $hojaTrabajo->save();

                $o = HojaTrabajo::where('user_id', $id)->get()->last(); 

                foreach ($registros as $key => $balance) {
                        $datos=array(
                            'hoja_trabajo_id' => $o->id,
                            'cuenta_id'               => $balance['cuenta_id'],
                            'cuenta'                  => $balance['cuenta'],
                            'bc_debe'                 => $balance['bc_debe'],
                            'bc_haber'                => $balance['bc_haber'],
                            'ajuste_debe'             => $balance['ajuste_debe'],
                            'ajuste_haber'            => $balance['ajuste_haber'],
                            'ba_debe'                 => $balance['ba_debe'],
                            'ba_haber'                => $balance['ba_haber'],
                            'er_debe'                 => $balance['er_debe'],
                            'er_haber'                => $balance['er_haber'],
                            'bg_debe'                 => $balance['bg_debe'],
                            'bg_haber'                => $balance['bg_haber'],
                            'created_at'              => now(),
                            'updated_at'              => now(),
                        );
                        HTRegistro::insert($datos);
                    }
                return response(array(
                        'success' => true,
                        'estado' => 'guardado',
                        'message' => 'Hoja de Trabajo creada correctamente'
                    ),200,[]);
                }elseif($hojaTra  == 1){
                $ids                                = [];
                $balanceComprob                     = HojaTrabajo::where('user_id',$id)->where('taller_id', $taller_id)->first();
                $balanceComprob->nombre             = $request->nombre;
                $balanceComprob->nombre             = $request->nombre;
                // $balanceComprob->fecha           = $request->fecha;
                $balanceComprob->bc_total_debe      = $request->bc_total_debe;
                $balanceComprob->bc_total_haber     = $request->bc_total_haber;
                $balanceComprob->ajuste_total_debe  = $request->ajuste_total_debe;
                $balanceComprob->ajuste_total_haber = $request->ajuste_total_haber;
                $balanceComprob->ba_total_debe      = $request->ba_total_debe;
                $balanceComprob->ba_total_haber     = $request->ba_total_haber;
                $balanceComprob->er_total_debe      = $request->er_total_debe;
                $balanceComprob->er_total_haber     = $request->er_total_haber;
                $balanceComprob->bg_total_debe      = $request->bg_total_debe;
                $balanceComprob->bg_total_haber     = $request->bg_total_haber;
                $balanceComprob->save();


                $registro= HTRegistro::where('hoja_trabajo_id', $balanceComprob->id)->get();
                
                foreach($registro as $regis){
                        $ids[]=$regis->id;
                }

                $deleteRegistros = HTRegistro::destroy($ids);

                $o = HojaTrabajo::where('user_id', $id)->get()->last(); 
                foreach ($registros as $key => $balance) {
                        $datos=array(
                            'hoja_trabajo_id' => $o->id,
                            'cuenta_id'               => $balance['cuenta_id'],
                            'cuenta'                  => $balance['cuenta'],
                            'bc_debe'                 => $balance['bc_debe'],
                            'bc_haber'                => $balance['bc_haber'],
                            'ajuste_debe'             => $balance['ajuste_debe'],
                            'ajuste_haber'            => $balance['ajuste_haber'],
                            'ba_debe'                 => $balance['ba_debe'],
                            'ba_haber'                => $balance['ba_haber'],
                            'er_debe'                 => $balance['er_debe'],
                            'er_haber'                => $balance['er_haber'],
                            'bg_debe'                 => $balance['bg_debe'],
                            'bg_haber'                => $balance['bg_haber'],
                            'created_at'              => now(),
                            'updated_at'              => now(),
                        );
                        HTRegistro::insert($datos);
                    }
                    return response(array(
                        'success' => true,
                        'estado' => 'actualizado',
                        'message' => 'Hoja de Trabajo actualizada correctamente'
                    ),200,[]);

                }

            }

        public function obtenerHojaTraba(Request $request)
        {
            $id         = Auth::id();
            $taller_id  = $request->id;
            $dioGeneral = HojaTrabajo::where('user_id',$id)->where('taller_id', $taller_id)->count();
            // $registros  = [];
            if ($dioGeneral  == 1) {
                $balanceCompro = HojaTrabajo::where('user_id',$id)->where('taller_id', $taller_id)->first();
                $obtener       = HTRegistro::select('cuenta','cuenta_id', 'bc_debe', 'bc_haber', 'ajuste_debe', 'ajuste_haber' , 'ba_debe', 'ba_haber', 'er_debe', 'er_haber', 'bg_debe', 'bg_haber')->where('hoja_trabajo_id', $balanceCompro->id)->get();
            
                return response(array(
                    'datos' => true,
                    'hojatrabajo' => $obtener,
                    'nombre' => $balanceCompro->nombre,
                ),200,[]);

            }else{
                return response(array(
                    'datos' => false,
                ),200,[]);

            }
        }


        public function balance_inicial(Request $request)
            {
                            $id            = Auth::id();
                            $taller_id     = $request->id;
                            $tipo          = $request->tipo;
                            $balanceInicial    = BalanceInicial::where('user_id',$id)->where('taller_id', $taller_id)->where('tipo', $tipo)->count();

                            if ($balanceInicial == 0) { 

                            $a_corriente   = $request->a_corriente;
                            $a_nocorriente = $request->a_nocorriente;
                            $p_corriente   = $request->p_corriente;
                            $p_nocorriente = $request->p_nocorriente;
                            $patrimonios   = $request->patrimonio;

                            $contenido = TallerModuloContable::select('enunciado')->where('taller_id', $taller_id)->firstOrFail();
                            $binicial                           = new BalanceInicial; 
                            $binicial->taller_id                = $taller_id;
                            $binicial->user_id                  = $id;
                            $binicial->tipo                     = $tipo;
                            $binicial->enunciado                = $contenido->enunciado;
                            $binicial->nombre                   = $request->nombre;
                            $binicial->fecha                    = $request->fecha;
                            $binicial->total_activo_corriente   = $request->totales_totales['t_a_corriente'];
                            $binicial->total_activo_nocorriente = $request->totales_totales['t_a_nocorriente'];
                            $binicial->total_pasivo_corriente   = $request->totales_totales['t_p_corriente'];
                            $binicial->total_pasivo_nocorriente = $request->totales_totales['t_p_no_corriente'];
                            $binicial->total_activo             = $request->totales_iniciales['t_activo'];
                            $binicial->total_pasivo             = $request->totales_iniciales['t_pasivo'];
                            $binicial->total_patrimonio         = $request->totales_totales['t_patrimonio'];
                            $binicial->total_pasivo_patrimonio  = $request->t_patrimonio;

                            $binicial->save();

                        // if ($tipo == 'horizontal') {
                        //     $a = BalanceInicial::where('user_id', $id)->where('tipo', $tipo)->get()->last(); 
                        //     $diariogeneral                     = new DiarioGeneral;
                        //     $diariogeneral->taller_id          = $taller_id;
                        //     $diariogeneral->user_id            = $id;
                        //     $diariogeneral->balance_inicial_id = $a->id;
                        //     $diariogeneral->enunciado          = $contenido->enunciado;
                        //     $diariogeneral->nombre             = $request->nombre;
                        //     $diariogeneral->completado         = false;
                        //     $diariogeneral->save();
                        // }    
                            if ($binicial == true) {
                                $o = BalanceInicial::where('user_id', $id)->get()->last(); 
                                foreach ($a_corriente as $key => $activos) {
                                    $datos=array(
                                        'balance_inicial_id' => $o->id,
                                        'nom_cuenta'         => $activos['nom_cuenta'],
                                        'cuenta_id'          => $activos['cuenta_id'],
                                        'saldo'              => $activos['saldo'],
                                        'tipo'               => 'corriente',
                                        'created_at'         => now(),
                                        'updated_at'         => now(),
                                    );
                                    BIActivo::insert($datos);
                                }
                                if (isset($a_nocorriente)) {
                                foreach ($a_nocorriente as $key => $activo) {
                                    $datos=array(
                                        'balance_inicial_id' => $o->id,
                                        'nom_cuenta'         => $activo['nom_cuenta'],
                                        'cuenta_id'          => $activo['cuenta_id'],
                                        'saldo'              => $activo['saldo'],
                                        'tipo'               => 'nocorriente',
                                        'created_at'         => now(),
                                        'updated_at'         => now(),
                                    );
                                    BIActivo::insert($datos);
                                }
                                    
                                }
                                if (isset($p_corriente)) {
                            
                                    foreach ($p_corriente as $key => $pasivos) {
                                    $datos=array(
                                        'balance_inicial_id' => $o->id,
                                        'nom_cuenta'         => $pasivos['nom_cuenta'],
                                        'cuenta_id'          => $pasivos['cuenta_id'],
                                        'saldo'              => $pasivos['saldo'],
                                        'tipo'               => 'corriente',
                                        'created_at'         => now(),
                                        'updated_at'         => now(),
                                    );
                                    BIPasivo::insert($datos);
                                }
                            }
                            if (isset($p_nocorriente)) {

                                foreach ($p_nocorriente as $key => $pasivo) {
                                    $datos=array(
                                        'balance_inicial_id' => $o->id,
                                        'nom_cuenta'         => $pasivo['nom_cuenta'],
                                        'cuenta_id'          => $pasivo['cuenta_id'],
                                        'saldo'              => $pasivo['saldo'],
                                        'tipo'               => 'nocorriente',
                                        'created_at'         => now(),
                                        'updated_at'         => now(),
                                    );
                                    BIPasivo::insert($datos);
                                }
                            }
                            if (isset($patrimonios)) {

                                    foreach ($patrimonios as $key => $patri) {
                                        $datos               =array(
                                        'balance_inicial_id' => $o->id,
                                        'nom_cuenta'         => $patri['nom_cuenta'],
                                        'cuenta_id'          => $patri['cuenta_id'],
                                        'saldo'              => $patri['saldo'],
                                        'created_at'         => now(),
                                        'updated_at'         => now(),
                                    );
                                    BIPatrimonio::insert($datos);
                                }
                            }

                                return response(array(
                                    'success' => true,
                                    'message' => 'Balance Inicial creado correctamente'
                                ),200,[]);
                                
                            } 
                        }else if($balanceInicial == 1){
                        $ids = [];
                        $ids1 = [];
                        $ids2 = [];
                            $o = BalanceInicial::where('user_id',$id)->where('taller_id', $taller_id)->where('tipo', $tipo)->first();
                                $a_corriente                 = $request->a_corriente;
                                $a_nocorriente               = $request->a_nocorriente;
                                $p_corriente                 = $request->p_corriente;
                                $p_nocorriente               = $request->p_nocorriente;
                                $patrimonios                 = $request->patrimonio;
                                $o->fecha                    = $request->fecha;
                                $o->nombre                   = $request->nombre;
                                $o->total_activo_corriente   = $request->totales_totales['t_a_corriente'];
                                $o->total_activo_nocorriente = $request->totales_totales['t_a_nocorriente'];
                                $o->total_pasivo_corriente   = $request->totales_totales['t_p_corriente'];
                                $o->total_pasivo_nocorriente = $request->totales_totales['t_p_no_corriente'];
                                $o->total_activo             = $request->totales_iniciales['t_activo'];
                                $o->total_pasivo             = $request->totales_iniciales['t_pasivo'];
                                $o->total_patrimonio         = $request->totales_totales['t_patrimonio'];
                                $o->total_pasivo_patrimonio  = $request->t_patrimonio;
                                $o->save();
                                $activ=BIActivo::where('balance_inicial_id', $o->id)->get();

                                foreach($activ as $act){
                                    $ids[]=$act->id;
                                }
                                $activosdelete = BIActivo::destroy($ids);

                                $pasi =  BIPasivo::where('balance_inicial_id', $o->id)->get();
                                foreach($pasi as $pas){
                                    $ids1[]=$pas->id;
                                }

                                $pasivosdelete = BIPasivo::destroy($ids1);

                                $patrim = BIPatrimonio::where('balance_inicial_id', $o->id)->get();
                                foreach($patrim as $pas){
                                    $ids2[]=$pas->id;
                                }
                                $patrimoniodelete  = BIPatrimonio::destroy($ids2);

                                if (isset($a_corriente)) {

                                foreach ($a_corriente as $key => $activos) {
                                    $datos=array(
                                        'balance_inicial_id' => $o->id,
                                        'nom_cuenta'         => $activos['nom_cuenta'],
                                        'cuenta_id'         => $activos['cuenta_id'],
                                        'saldo'              => $activos['saldo'],
                                        'tipo'               => 'corriente',
                                        'created_at'         => now(),
                                        'updated_at'         => now(),
                                    );
                                    BIActivo::insert($datos);
                                }
                            }

                                if (isset($a_nocorriente)) {

                                    foreach ($a_nocorriente as $key => $activo) {
                                    $datos=array(
                                        'balance_inicial_id' => $o->id,
                                        'nom_cuenta'         => $activo['nom_cuenta'],
                                        'cuenta_id'         => $activo['cuenta_id'],

                                        'saldo'              => $activo['saldo'],
                                        'tipo'               => 'nocorriente',
                                        'created_at'         => now(),
                                        'updated_at'         => now(),
                                    );
                                    BIActivo::insert($datos);
                                }
                            }
                                if (isset($p_corriente)) {

                                    foreach ($p_corriente as $key => $pasivos) {
                                    $datos=array(
                                        'balance_inicial_id' => $o->id,
                                        'nom_cuenta'         => $pasivos['nom_cuenta'],
                                        'cuenta_id'         => $pasivos['cuenta_id'],
                                        'saldo'              => $pasivos['saldo'],
                                        'tipo'               => 'corriente',
                                        'created_at'         => now(),
                                        'updated_at'         => now(),
                                    );
                                    BIPasivo::insert($datos);
                                }
                            }

                                if (isset($p_nocorriente)) {

                                foreach ($p_nocorriente as $key => $pasivo) {
                                    $datos=array(
                                        'balance_inicial_id' => $o->id,
                                        'nom_cuenta'         => $pasivo['nom_cuenta'],
                                        'cuenta_id'         => $pasivo['cuenta_id'],
                                        'saldo'              => $pasivo['saldo'],
                                        'tipo'               => 'nocorriente',
                                        'created_at'         => now(),
                                        'updated_at'         => now(),
                                    );
                                    BIPasivo::insert($datos);
                                }
                            }
                                if (isset($patrimonios)) {

                                    foreach ($patrimonios as $key => $patri) {
                                        $datos               =array(
                                        'balance_inicial_id' => $o->id,
                                        'nom_cuenta'         => $patri['nom_cuenta'],
                                        'cuenta_id'         => $patri['cuenta_id'],
                                        'saldo'              => $patri['saldo'],
                                        'created_at'         => now(),
                                        'updated_at'         => now(),
                                    );
                                    BIPatrimonio::insert($datos);
                                }
                            }


                            return response(array(
                                'success'   =>  false,
                                'tipo'      => $tipo,
                                'message'   => 'Datos Actualizados Correctamente',             
                                ),200,[]);
                        }
            }
        public function obtenerbalance(Request $request)
            {
                        $id            = Auth::id();
                        $taller_id     = $request->id;
                        $tipo          = $request->tipo;
                        $balanceInicial = BalanceInicial::where('user_id',$id)->where('taller_id', $taller_id)->count();

                        if ($balanceInicial >= 1 ) { 
                            $datos1 = BalanceInicial::where('user_id',$id)->where('taller_id', $taller_id)->where('tipo', 'horizontal')->count();
                            $datos2 = BalanceInicial::where('user_id',$id)->where('taller_id', $taller_id)->where('tipo', 'vertical')->count();

                            if ($tipo == 'horizontal' && $datos1 == 1) {
                                    $datos = BalanceInicial::where('user_id',$id)->where('taller_id', $taller_id)->where('tipo', $tipo)->first();
                        $a_corrientes      = BIActivo::select('nom_cuenta', 'cuenta_id', 'saldo')->where('balance_inicial_id', $datos->id)->where('tipo', 'corriente')->get();
                        $a_nocorrientes    = BIActivo::select('nom_cuenta', 'cuenta_id', 'saldo')->where('balance_inicial_id', $datos->id)->where('tipo', 'nocorriente')->get();
                        $p_corriente       = BIPasivo::select('nom_cuenta', 'cuenta_id', 'saldo')->where('balance_inicial_id', $datos->id)->where('tipo', 'corriente')->get();
                        $p_nocorriente     = BIPasivo::select('nom_cuenta', 'cuenta_id', 'saldo')->where('balance_inicial_id', $datos->id)->where('tipo', 'nocorriente')->get();
                        $patrimonios       = $datos->bPatrimonios;

                            return response(array(
                                'datos' => true,
                                    'nombre' => $datos->nombre,
                                    'fecha' => $datos->fecha,
                                    'total_pasivo_patrimonio' => $datos->total_pasivo_patrimonio,
                                    'a_corriente' => $a_corrientes,
                                    'a_nocorriente' => $a_nocorrientes,
                                    'p_corriente' => $p_corriente,
                                    'p_nocorriente' => $p_nocorriente,
                                    'patrimonios' => $patrimonios,
                                ),200,[]);
                            }elseif ($tipo == 'vertical' && $datos2 == 1) {
                        $datos = BalanceInicial::where('user_id',$id)->where('taller_id', $taller_id)->where('tipo', $tipo)->first();
                        $a_corrientes      = BIActivo::select('nom_cuenta', 'cuenta_id', 'saldo')->where('balance_inicial_id', $datos->id)->where('tipo', 'corriente')->get();
                        $a_nocorrientes    = BIActivo::select('nom_cuenta', 'cuenta_id', 'saldo')->where('balance_inicial_id', $datos->id)->where('tipo', 'nocorriente')->get();
                        $p_corriente       = BIPasivo::select('nom_cuenta', 'cuenta_id', 'saldo')->where('balance_inicial_id', $datos->id)->where('tipo', 'corriente')->get();
                        $p_nocorriente     = BIPasivo::select('nom_cuenta', 'cuenta_id', 'saldo')->where('balance_inicial_id', $datos->id)->where('tipo', 'nocorriente')->get();
                        $patrimonios       = $datos->bPatrimonios;

                            return response(array(
                                'datos' => true,
                                    'nombre' => $datos->nombre,
                                    'fecha' => $datos->fecha,
                                    'total_pasivo_patrimonio' => $datos->total_pasivo_patrimonio,
                                    'a_corriente' => $a_corrientes,
                                    'a_nocorriente' => $a_nocorrientes,
                                    'p_corriente' => $p_corriente,
                                    'p_nocorriente' => $p_nocorriente,
                                    'patrimonios' => $patrimonios,
                                ),200,[]);
                            }

                        }else{
                            return response(array(
                                'datos' => false,
                                ),200,[]);
                        }
                    }
                        public function b_inicial_diario(Request $request)
                        {
                            $id                = Auth::id();
                            $taller_id         = $request->id;

                            $conteo    = BalanceInicial::where('user_id',$id)->where('taller_id', $taller_id)->where('tipo', 'horizontal')->count();

                            if ($conteo  == 1) {
                            $balanceInicial    = BalanceInicial::where('user_id',$id)->where('taller_id', $taller_id)->where('tipo', 'horizontal')->get()->last();
                            $activos           = $balanceInicial->bActivos;
                            $pasivo            = $balanceInicial->bPasivos;
                            $patrimonios       = $balanceInicial->bPatrimonios;
                            $pasivo_patrimonio = [];

                            foreach ($pasivo as $valu) {
                            $pasivo_patrimonio[]= $valu;       
                            }
                            foreach ($patrimonios as $valu) {
                            $pasivo_patrimonio[]= $valu;       
                            }

                            $inicial = array(
                            'tipo' => 'inicial',
                            'fecha' => $balanceInicial->fecha,
                            'comentario' => 'Para registrar el B.I de '.$balanceInicial->nombre,
                            'debe' => $activos,
                            'haber' => $pasivo_patrimonio
                            );

                            // BIActivo::where('balance_inicial_id', $balanceInicial->id)->get();
                            // return response(array(
                            //    'datos' => true,
                            //        'nombre' => $balanceInicial->nombre,
                            //        'fecha' => $balanceInicial->fecha,
                            //        'tipo' => 'balance_inicial',
                            //        'activos' => $activos,
                            //        'pasivos' => $pasivo_patrimonio
                            //    ),200,[]);

                                return response(array(
                                'datos' => true,
                                    'inicial' => $inicial
                                ),200,[]);
                            }else{
                                return response(array(
                                    'datos' => false,
                                ),200,[]);
                            }
                        
            }
        public function obtenerdiario(Request $request)
            {
                $id                = Auth::id();
                $taller_id         = $request->id;
                $dioGeneral    = DiarioGeneral::where('user_id',$id)->where('taller_id', $taller_id)->count();
                $registros = [];
                $ajustes = [];
                if ($dioGeneral  == 1) {
                $diairioGeneral    = DiarioGeneral::where('user_id',$id)->where('taller_id', $taller_id)->first();
                $normal = DGRegistro::where('diario_general_id', $diairioGeneral->id)->where('tipo', 'normal')->orderBy('fecha')->get();
                    foreach ($normal as $key => $registro) {
                        $regis = array(
                            'debe'       => $registro->dgrDebe,
                            'haber'      =>$registro->dgrHaber,
                            'tipo'       => $registro->tipo,
                            'fecha'      => $registro->fecha,
                            'comentario' => $registro->comentario
                        );
                        $registros[]= $regis;
                    }
                $ajustado = DGRegistro::where('diario_general_id', $diairioGeneral->id)->where('tipo', 'ajustado')->orderBy('fecha')->get();
                    foreach ($ajustado as $key => $registro) {
                        $regis2 = array(
                            'debe'       => $registro->dgrDebe,
                            'haber'      =>$registro->dgrHaber,
                            'tipo'       => $registro->tipo,
                            'fecha'      => $registro->fecha,
                            'comentario' => $registro->comentario
                        );
                        $ajustes[]= $regis2;
                    }
                    $inicial = [];
                    $iniciales = DGRegistro::where('diario_general_id', $diairioGeneral->id)->where('tipo', 'inicial')->orderBy('fecha')->count();
                    if ($iniciales >= 1) {
                        $iniciales = DGRegistro::where('diario_general_id', $diairioGeneral->id)->where('tipo', 'inicial')->orderBy('fecha')->first();
                        $regis3 = array(
                            'debe'       => $iniciales->dgrDebe,
                            'haber'      =>$iniciales->dgrHaber,
                            'tipo'       => $iniciales->tipo,
                            'fecha'      => $iniciales->fecha,
                            'comentario' => $iniciales->comentario
                        );
                        $inicial= $regis3;
                    return response(array(
                        'datos'        => true,
                        'nombre'       => $diairioGeneral->nombre,
                        'registros'    => $registros,
                        'tieneinicial' => true,
                        'inicial'      => $inicial,
                        'ajustes'      => $ajustes,
                    ),200,[]);
                    }else{
                    return response(array(
                        'datos'        => true,
                        'nombre'       => $diairioGeneral->nombre,
                        'registros'    => $registros,
                        'tieneinicial' => false,
                        'inicial'      => $inicial,
                        'ajustes'      => $ajustes,
                    ),200,[]);
                    }
                        
                }else{
                    return response(array(
                        'datos' => false,
                    ),200,[]);

                }
            }

        public function diario(Request $request)
            {
                        $id            = Auth::id();
                        $taller_id     = $request->id;
                        $registro      = $request->registro;
                        $diariogeneral = DiarioGeneral::where('user_id',$id)->where('taller_id', $taller_id)->count();
                    if ($diariogeneral == 1){ 
                        $cu = DiarioGeneral::where('user_id',$id)->where('taller_id', $taller_id)->first();
                        $cuenta = DGRegistro::where('diario_general_id',$cu->id)->count();
                        $cuentacalculo = DiarioGeneral::where('user_id',$id)->where('taller_id', $taller_id)->first();
                        $debe =[];
                        $haber =[];
                        $ids=[];
                        
                        $udcalculo = $cuentacalculo->id;
                        $cuentacalculo->delete();

                        $diariog               = new DiarioGeneral;
                        $diariog->taller_id    = $taller_id;
                        $diariog->user_id      = $id;
                        $diariog->nombre       = $request->nombre;
                        $diariog->completado   = false;
                        $diariog->total_haber  = $request->total_haber;
                        $diariog->total_debe   = $request->total_debe;
                        $diariog->save();

                        foreach ($registro as $key => $value) {                         //RECORRER TODOS LOS REGISTROS EN EL ARRAY
                            $regis=array(
                                    'diario_general_id' => $diariog->id,
                                    'no_registro'       => $key + 1,
                                    'comentario'        => $value['comentario'],
                                    'fecha'             => $value['fecha'],
                                    'tipo'              => $value['tipo'],
                                    'created_at'        => now(),
                                    'updated_at'        => now(),
                                );
                                DGRegistro::insert($regis);                           //GUARDAR CADA REGISTRO EN LA BASE DE DATOS
                        }
                        $register = $diariog->dgRegistro;
                        foreach ($registro as $key => $concatenado) {                         ////RECORRER TODOS LOS REGISTROS EN EL ARRAY
                            foreach ($concatenado['debe'] as $key1 => $value1) {              ////RECORRER TODOS LAS CUENTAS DE DEBE QUE PERTENECEN A UN REGISTRO
                                $regis1=array(
                                    'd_g_registro_id' => $register[$key]->id,
                                    'cuenta_id'       => $value1['cuenta_id'],
                                    'nom_cuenta'      => $value1['nom_cuenta'],
                                    'saldo'           => $value1['saldo'],
                                    'fecha'           => $value1['fecha'],
                                    'created_at'      => now(),
                                    'updated_at'      => now(),
                                );
                                DGRDebe::insert($regis1);                             //GURDAR ESAS CUENTAS EN LA TABLA DEBE CON EL ID DEL REGISTRO AL QUE CORRESPONDEN
                            }
                            foreach ($concatenado['haber'] as $key2 => $value2) {           ////RECORRER TODOS LAS CUENTAS DE HABER QUE PERTENECEN A UN REGISTRO
                                $regis2=array(
                                    'd_g_registro_id' => $register[$key]->id,
                                    'cuenta_id'       => $value2['cuenta_id'],
                                    'nom_cuenta'      => $value2['nom_cuenta'],
                                    'saldo'           => $value2['saldo'],
                                    'created_at'      => now(),
                                    'updated_at'      => now(),
                                );
                                DGRHaber::insert($regis2);                            //GURDAR ESAS CUENTAS EN LA TABLA HABER CON EL ID DEL REGISTRO AL QUE 
                            }
                        }
                        return response(array(
                                'success' => 'act',
                                'message' => 'Datos Actualizados Correctamente'
                            ),200,[]);
                    }else{ 
                        $diariogeneral               = new DiarioGeneral;
                        $diariogeneral->taller_id    = $taller_id;
                        $diariogeneral->user_id      = $id;
                        $diariogeneral->nombre       = $request->nombre;
                        $diariogeneral->completado   = false;
                        $diariogeneral->total_haber  = $request->total_haber;
                        $diariogeneral->total_debe   = $request->total_debe;
                        $diariogeneral->save();
                        $diariog = DiarioGeneral::where('user_id',$id)->where('taller_id', $taller_id)->first();
                        
                        $debe =[];
                        $haber =[];
                        foreach ($registro as $key => $value) {                         //RECORRER TODOS LOS REGISTROS EN EL ARRAY
                            $regis=array(
                                    'diario_general_id' => $diariog->id,
                                    'no_registro'       => $key + 1,
                                    'comentario'        => $value['comentario'],
                                    'fecha'             => $value['fecha'],
                                    'tipo'              => $value['tipo'],
                                    'created_at'        => now(),
                                    'updated_at'        => now(),
                                );
                                DGRegistro::insert($regis);                           //GUARDAR CADA REGISTRO EN LA BASE DE DATOS
                        }
                        $register = $diariog->dgRegistro;
                        foreach ($registro as $key => $diario2con) {                         ////RECORRER TODOS LOS REGISTROS EN EL ARRAY
                            foreach ($diario2con['debe'] as $key1 => $value1) {              ////RECORRER TODOS LAS CUENTAS DE DEBE QUE PERTENECEN A UN REGISTRO
                                $regis1=array(
                                    'd_g_registro_id' => $register[$key]->id,
                                    'cuenta_id'       => $value1['cuenta_id'],
                                    'nom_cuenta'      => $value1['nom_cuenta'],
                                    'saldo'           => $value1['saldo'],
                                    'fecha'           => $value1['fecha'],
                                    'created_at'      => now(),
                                    'updated_at'      => now(),
                                );
                                DGRDebe::insert($regis1);                             //GURDAR ESAS CUENTAS EN LA TABLA DEBE CON EL ID DEL REGISTRO AL QUE CORRESPONDEN
                            }
                            foreach ($diario2con['haber'] as $key2 => $value2) {           ////RECORRER TODOS LAS CUENTAS DE HABER QUE PERTENECEN A UN REGISTRO
                                $regis2=array(
                                    'd_g_registro_id'  => $register[$key]->id,
                                    'cuenta_id'       => $value2['cuenta_id'],
                                    'nom_cuenta'        => $value2['nom_cuenta'],
                                    'saldo'              => $value2['saldo'],
                                    'created_at'         => now(),
                                    'updated_at'         => now(),
                                );
                                DGRHaber::insert($regis2);                            //GURDAR ESAS CUENTAS EN LA TABLA HABER CON EL ID DEL REGISTRO AL QUE CORRESPONDEN
                            }
                        }
                        // $diariog->completado = true;                                    //CAMBIAR EL VALOR DE COMPLETADO A TRUE /// ESTO SIGNIFICA QUE EL TALLER HA SIDO COMPLETADO
                        // $diariog->save();                                             //GUARDAR ESE CAMBIO
                        return response(array(                                         //ENVIO DE RESPUESTA
                                'success' => true,
                                'message' => 'Diario General creado correctamente'
                            ),200,[]);
                                                                            // SI NO TIENE CREADO EL BALANCE INICIAL ANTES DE GUARDAR, LE SALDRA UNA NOTIFICACION INDICANDO DICHO P
                        }
            }

        public function mayorGeneral(Request $request)
            {
                    $id            = Auth::id();
                    $taller_id     = $request->id;
                    $registro      = $request->registro;
                    $nombre = $request->nombre;
                    
                    $mayorgeneral = MayorGeneral::where('user_id',$id)->where('taller_id', $taller_id)->count();

                if ($mayorgeneral == 1){ 
                    $cu = MayorGeneral::where('user_id',$id)->where('taller_id', $taller_id)->first();
                    $cuenta = MGRegistro::where('mayor_general_id',$cu->id)->count();

                    $mayorg = MayorGeneral::where('user_id',$id)->where('taller_id', $taller_id)->first();
                    $debe =[];
                    $haber =[];
                    $ids =[];
                    $mayorg->nombre = $nombre;
                    $mayorg->save();


                    $registros= MGRegistro::where('mayor_general_id', $mayorg->id)->get();
                    
                    foreach($registros as $act){
                            $ids[]=$act->id;
                    }
                    $deleteRegistros = MGRegistro::destroy($ids);

                            foreach ($registro as $key => $value) {                         //RECORRER TODOS LOS REGISTROS EN EL ARRAY
                        $regis=array(
                                'mayor_general_id' => $mayorg->id,
                                'cuenta_id'        => $value['cuenta_id'],
                                'cuenta'           => $value['cuenta'],
                                'no_registro'      => $key + 1,
                                'total_debe'       => $value['total_debe'],
                                'total_haber'      => $value['total_haber'],
                                'total_saldo'      => $value['total_saldo'],
                                'created_at'       => now(),
                                'updated_at'       => now(),
                            );
                            MGRegistro::insert($regis);                           
                    }
                    $register = $mayorg->mgRegistro;

                    foreach ($registro as $key => $value) { 
                        
                        foreach ($value['registros'] as $key1 => $value1) {              
                            $regis1=array(
                                'm_g_registro_id' => $register[$key]->id,
                                'tipo'            => 'normal',
                                'fecha'           => $value1['fecha'],
                                'detalle'         => $value1['detalle'],
                                'debe'            => $value1['debe'],
                                'haber'           => $value1['haber'],
                                'saldo'           => $value1['saldo'],
                                'created_at'      => now(),
                                'updated_at'      => now(),
                            );
                            MGRMovimiento::insert($regis1);                             
                        }
                        foreach ($value['cierres'] as $key2 => $value2) {           
                            $regis2=array(
                                'm_g_registro_id' => $register[$key]->id,
                                'tipo'            => 'cierre',
                                'fecha'           => $value2['fecha'],
                                'detalle'         => $value2['detalle'],
                                'debe'            => $value2['debe'],
                                'haber'           => $value2['haber'],
                                'saldo'           => $value2['saldo'],
                                'created_at'      => now(),
                                'updated_at'      => now(),
                            );
                            MGRMovimiento::insert($regis2);                            
                        }
                    }
                    return response(array(
                            'success' => 'act',
                            'message' => 'Datos Actualizados Correctamente'
                        ),200,[]);
                }else{ 
                    $mayorgeneral               = new MayorGeneral;
                    $mayorgeneral->taller_id    = $taller_id;
                    $mayorgeneral->user_id      = $id;
                    $mayorgeneral->nombre       = $nombre;
                    $mayorgeneral->save();

                    $mayorg = MayorGeneral::where('user_id',$id)->where('taller_id', $taller_id)->first();
                    
                    $debe =[];
                    $haber =[];
                    foreach ($registro as $key => $value) {                         
                        $regis=array(
                                'mayor_general_id' => $mayorg->id,
                                'cuenta_id'        => $value['cuenta_id'],
                                'cuenta'           => $value['cuenta'],
                                'no_registro'      => $key + 1,
                                'total_debe'       => $value['total_debe'],
                                'total_haber'      => $value['total_haber'],
                                'total_saldo'      => $value['total_saldo'],
                                'created_at'       => now(),
                                'updated_at'       => now(),
                            );
                            MGRegistro::insert($regis);                          
                    }
                    $register = $mayorg->mgRegistro;

                    foreach ($registro as $key => $value) { 
                        
                        foreach ($value['registros'] as $key1 => $value1) {              
                            $regis1=array(
                                'm_g_registro_id' => $register[$key]->id,
                                'tipo'            => 'normal',
                                'fecha'           => $value1['fecha'],
                                'detalle'         => $value1['detalle'],
                                'debe'            => $value1['debe'],
                                'haber'           => $value1['haber'],
                                'saldo'           => $value1['saldo'],
                                'created_at'      => now(),
                                'updated_at'      => now(),
                            );
                            MGRMovimiento::insert($regis1);                             
                        }
                        foreach ($value['cierres'] as $key2 => $value2) {           
                            $regis2=array(
                                'm_g_registro_id' => $register[$key]->id,
                                'tipo'            => 'cierre',
                                'fecha'           => $value2['fecha'],
                                'detalle'         => $value2['detalle'],
                                'debe'            => $value2['debe'],
                                'haber'           => $value2['haber'],
                                'saldo'           => $value2['saldo'],
                                'created_at'      => now(),
                                'updated_at'      => now(),
                            );
                            MGRMovimiento::insert($regis2);                            
                        }
                    }
                    // $mayorg->completado = true;                                    //CAMBIAR EL VALOR DE COMPLETADO A TRUE /// ESTO SIGNIFICA QUE EL TALLER HA SIDO COMPLETADO
                    // $mayorg->save();                                             //GUARDAR ESE CAMBIO
                    return response(array(                                         //ENVIO DE RESPUESTA
                            'success' => true,
                            'message' => 'Mayor General creado correctamente'
                        ),200,[]);
                                                                        // SI NO TIENE CREADO EL BALANCE INICIAL ANTES DE GUARDAR, LE SALDRA UNA NOTIFICACION INDICANDO DICHO P
                    }
            }
        public function obtenermayor(Request $request)
            {
                $id         = Auth::id();
                $taller_id  = $request->id;
                $mayorGeneral = MayorGeneral::where('user_id',$id)->where('taller_id', $taller_id)->count();
                $registros  = [];
                $cierres    = [];
                if ($mayorGeneral  == 1) {
                $mgeneral = MayorGeneral::where('user_id',$id)->where('taller_id', $taller_id)->first();


                $normal  = MGRegistro::where('mayor_general_id', $mgeneral->id)->get();
                    foreach ($normal as $key => $registro) {
                        $normales = MGRMovimiento::where('m_g_registro_id', $registro->id)->where('tipo', 'normal')->get();
                        $cierres = MGRMovimiento::where('m_g_registro_id', $registro->id)->where('tipo', 'cierre')->get();
                        $regis = array(
                            'cuenta_id'   => $registro->cuenta_id,
                            'cuenta'      =>$registro->cuenta,
                            'registros'   =>$normales,
                            'cierres'     =>$cierres,
                            'total_debe'  => $registro->total_debe,
                            'total_haber' => $registro->total_haber,
                            'total_saldo' => $registro->total_saldo,
                        );
                        $registros[]= $regis;
                    }
                    
                    return response(array(
                        'datos'     => true,
                        'nombre'    => $mgeneral->nombre,
                        'registros' => $registros,
                    ),200,[]);
                }else{
                    return response(array(
                        'datos' => false,
                    ),200,[]);

                }
            }

        public function estadoResultado(Request $request)
            {
                        $id         = Auth::id();
                        $taller_id  = $request->id;
                        $registro   = $request->registro;
                        $nombre     = $request->nombre;
                        $fecha      = $request->fecha;
                        $ingresos   = $request->ingresos;
                        $gastos     = $request->gastos;
                        $utilidades = $request->utilidades;
                        $totales    = $request->totales;
                        
                        $mayorgeneral = EstadoResultado::where('user_id',$id)->where('taller_id', $taller_id)->count();

                    if ($mayorgeneral == 1){ 
                        $cu = EstadoResultado::where('user_id',$id)->where('taller_id', $taller_id)->first();
                        $estadoResul = EstadoResultado::where('user_id',$id)->where('taller_id', $taller_id)->first();
                        $ids =[];
                        $estadoResul->nombre                = $nombre;
                        $estadoResul->fecha                 = $fecha;
                        $estadoResul->venta                 = $request->venta;
                        $estadoResul->costo_venta           = $request->costo_venta;
                        $estadoResul->utilidad           = $request->utilidad;
                        $estadoResul->utilidad_bruta_ventas = $totales['utilidad_bruta_ventas'];
                        $estadoResul->utilidad_neta_o       = $totales['utilidad_neta_o'];
                        $estadoResul->utilidad_ejercicio    = $totales['utilidad_ejercicio'];
                        $estadoResul->utilidad_liquida      = $totales['utilidad_liquida'];
                        $estadoResul->total_ingresos        = $totales['ingreso'];
                        $estadoResul->total_gastos          = $totales['gastos'];
                        $estadoResul->save();
                        $registros= ERIngreso::where('estado_resultado_id', $estadoResul->id)->get();
                        foreach($registros as $act){
                                $ids[]=$act->id;
                        }

                        $deleteRegistros = ERIngreso::destroy($ids);
                            foreach ($ingresos as $key => $value) {                         
                                $regis=array(
                                    'estado_resultado_id' => $estadoResul->id,
                                    'tipo'                => 'ingresos',
                                    'cuenta_id'           => $value['cuenta_id'],
                                    'cuenta'              => $value['cuenta'],
                                    'saldo'               => $value['saldo'],
                                    'created_at'          => now(),
                                    'updated_at'          => now(),
                                );
                                ERIngreso::insert($regis);                          
                        }
                        // $register = $estadoResul->mgRegistro;
                            
                            foreach ($gastos as $key1 => $value1) {              
                                $regis1=array(
                                    'estado_resultado_id' => $estadoResul->id,
                                    'tipo'                => 'gastos',
                                    'cuenta_id'           => $value1['cuenta_id'],
                                    'cuenta'              => $value1['cuenta'],
                                    'saldo'               => $value1['saldo'],
                                    'created_at'          => now(),
                                    'updated_at'          => now(),
                                );
                                ERIngreso::insert($regis1);                             
                            }
                        if (count($utilidades) > 0) {
                            foreach ($utilidades as $key2 => $value2) {           
                                $regis2=array(
                                    'estado_resultado_id' => $estadoResul->id,
                                    'tipo'                => 'utilidades',
                                    'cuenta_id'           => $value2['cuenta_id'],
                                    'cuenta'              => $value2['cuenta'],
                                    'saldo'               => $value2['saldo'],
                                    'created_at'          => now(),
                                    'updated_at'          => now(),
                                );
                                ERIngreso::insert($regis2);                            
                            }  
                        }
                        return response(array(
                                'success' => 'actualizado',
                                'message' => 'Datos Actualizados Correctamente'
                            ),200,[]);
                    }else{ 
                        $estadoResultado                        = new EstadoResultado;
                        $estadoResultado->taller_id             = $taller_id;
                        $estadoResultado->user_id               = $id;
                        $estadoResultado->nombre                = $nombre;
                        $estadoResultado->fecha                 = $fecha;
                        $estadoResultado->utilidad              = $request->utilidad;
                        $estadoResultado->venta                 = $request->venta;
                        $estadoResultado->costo_venta           = $request->costo_venta;
                        $estadoResultado->utilidad_bruta_ventas = $totales['utilidad_bruta_ventas'];
                        $estadoResultado->utilidad_neta_o       = $totales['utilidad_neta_o'];
                        $estadoResultado->utilidad_ejercicio    = $totales['utilidad_ejercicio'];
                        $estadoResultado->utilidad_liquida      = $totales['utilidad_liquida'];
                        $estadoResultado->total_ingresos        = $totales['ingreso'];
                        $estadoResultado->total_gastos          = $totales['gastos'];
                        $estadoResultado->save();
                        $mayorg = EstadoResultado::where('user_id',$id)->where('taller_id', $taller_id)->first();
                        
                        foreach ($ingresos as $key => $value) {                         
                            $regis=array(
                                    'estado_resultado_id' => $mayorg->id,
                                    'tipo'                => 'ingresos',
                                    'cuenta_id'           => $value['cuenta_id'],
                                    'cuenta'              => $value['cuenta'],
                                    'saldo'               => $value['saldo'],
                                    'created_at'          => now(),
                                    'updated_at'          => now(),
                                );
                                ERIngreso::insert($regis);                          
                        }
                        // $register = $mayorg->mgRegistro;
                            
                            foreach ($gastos as $key1 => $value1) {              
                                $regis1=array(
                                    'estado_resultado_id' => $mayorg->id,
                                    'tipo'                => 'gastos',
                                    'cuenta_id'           => $value1['cuenta_id'],
                                    'cuenta'              => $value1['cuenta'],
                                    'saldo'               => $value1['saldo'],
                                    'created_at'          => now(),
                                    'updated_at'          => now(),
                                );
                                ERIngreso::insert($regis1);                             
                            }
                        if (isset($utilidades)) {
                            foreach ($utilidades as $key2 => $value2) {           
                                $regis2=array(
                                    'estado_resultado_id' => $mayorg->id,
                                    'tipo'                => 'utilidades',
                                    'cuenta_id'           => $value2['cuenta_id'],
                                    'cuenta'              => $value2['cuenta'],
                                    'saldo'               => $value2['saldo'],
                                    'created_at'          => now(),
                                    'updated_at'          => now(),
                                );
                                ERIngreso::insert($regis2);                            
                            }  
                        }
                        return response(array(                                   
                                'success' => true,
                                'message' => 'Estado Resultado creado correctamente'
                            ),200,[]);
                                                                        
                        }
            }

        public function obtenerEstado(Request $request)
            {
                $id         = Auth::id();
                $taller_id  = $request->id;
                $mayorGeneral = EstadoResultado::where('user_id',$id)->where('taller_id', $taller_id)->count();
                $registros  = [];
                $cierres    = [];
                if ($mayorGeneral  == 1) {
                $mgeneral = EstadoResultado::where('user_id',$id)->where('taller_id', $taller_id)->first();


                // $normal  = ERIngreso::where('ESTA', $mgeneral->id)->get();
                
                        $ingresos   = ERIngreso::where('estado_resultado_id', $mgeneral->id)->where('tipo', 'ingresos')->get();
                        $gastos     = ERIngreso::where('estado_resultado_id', $mgeneral->id)->where('tipo', 'gastos')->get();
                        $utilidades = ERIngreso::where('estado_resultado_id', $mgeneral->id)->where('tipo', 'utilidades')->get();
                            
                    return response(array(
                        'datos'           => true,
                        'estadoresultado' => $mgeneral,
                        'ingresos'        => $ingresos,
                        'gastos'          => $gastos,
                        'utilidades'      => $utilidades,
                    ),200,[]);
                }else{
                    return response(array(
                        'datos' => false,
                    ),200,[]);

                }
            }
        public function balanceGeneral(Request $request)
            {
                        $id             = Auth::id();
                        $taller_id      = $request->id;
                        $balanceGeneral = BalanceGeneral::where('user_id',$id)->where('taller_id', $taller_id)->count();

                        if ($balanceGeneral == 0) { 
                        $a_corriente   = $request->a_corriente;
                        $a_nocorriente = $request->a_nocorriente;
                        $p_corriente   = $request->p_corriente;
                        $p_nocorriente = $request->p_nocorriente;
                        $patrimonios   = $request->patrimonio;

                        // $contenido = TallerContabilidad::select('enunciado')->where('taller_id', $taller_id)->firstOrFail();
                        $bgeneral                          = new BalanceGeneral; 
                        $bgeneral->taller_id               = $taller_id;
                        $bgeneral->user_id                 = $id;
                        $bgeneral->nombre                  = $request->nombre;
                        $bgeneral->fecha                   = $request->fecha;
                        $bgeneral->t_activo                = $request->total_balance_inicial['t_activo'];
                        $bgeneral->t_pasivo                = $request->total_balance_inicial['t_pasivo'];
                        $bgeneral->t_a_corriente           = $request->totales['t_a_corriente'];
                        $bgeneral->t_a_nocorriente         = $request->totales['t_a_nocorriente'];
                        $bgeneral->t_p_corriente           = $request->totales['t_p_corriente'];
                        $bgeneral->t_p_no_corriente        = $request->totales['t_p_no_corriente'];
                        $bgeneral->t_patrimonio            = $request->totales['t_patrimonio'];
                        $bgeneral->total_pasivo_patrimonio = $request->t_patrimonio;
                        $bgeneral->save();

                        if ($bgeneral == true) {
                            $o = BalanceGeneral::where('user_id', $id)->get()->last(); 
                            foreach ($a_corriente as $key => $activos) {
                                $datos=array(
                                    'balance_general_id' => $o->id,
                                    'cuenta'         => $activos['cuenta'],
                                    'cuenta2'            => $activos['cuenta2'],
                                    'resta'              => $activos['resta'],
                                    'cuenta_id'          => $activos['cuenta_id'],
                                    'saldo'              => $activos['saldo'],
                                    'total_saldo'        => $activos['total_saldo'],
                                    'cuenta_id2'         => $activos['cuenta_id2'],
                                    'saldo2'             => $activos['saldo2'],
                                    'total_saldo2'       => $activos['total_saldo2'],
                                    'tipo'               => 'corriente',
                                    'created_at'         => now(),
                                    'updated_at'         => now(),
                                );
                                BGActivo::insert($datos);
                            }
                                foreach ($a_nocorriente as $key => $activo) {
                                $datos=array(
                                    'balance_general_id' => $o->id,
                                    'cuenta'             => $activo['cuenta'],
                                    'cuenta2'            => $activo['cuenta2'],
                                    'resta'              => $activo['resta'],
                                    'cuenta_id'          => $activo['cuenta_id'],
                                    'saldo'              => $activo['saldo'],
                                    'total_saldo'        => $activo['total_saldo'],
                                    'cuenta_id2'         => $activo['cuenta_id2'],
                                    'saldo2'             => $activo['saldo2'],
                                    'total_saldo2'       => $activo['total_saldo2'],
                                    'tipo'               => 'nocorriente',
                                    'created_at'         => now(),
                                    'updated_at'         => now(),
                                );
                                BGActivo::insert($datos);
                            }
                                foreach ($p_corriente as $key => $pasivos) {
                                $datos=array(
                                    'balance_general_id' => $o->id,
                                    'cuenta'         => $pasivos['cuenta'],
                                    'cuenta_id'          => $pasivos['cuenta_id'],
                                    'saldo'              => $pasivos['saldo'],
                                    'tipo'               => 'corriente',
                                    'created_at'         => now(),
                                    'updated_at'         => now(),
                                );
                                BGPasivo::insert($datos);
                            }
                            foreach ($p_nocorriente as $key => $pasivo) {
                                $datos=array(
                                    'balance_general_id' => $o->id,
                                    'cuenta'         => $pasivo['cuenta'],
                                    'cuenta_id'          => $pasivo['cuenta_id'],
                                    'saldo'              => $pasivo['saldo'],
                                    'tipo'               => 'nocorriente',
                                    'created_at'         => now(),
                                    'updated_at'         => now(),
                                );
                                BGPasivo::insert($datos);
                            }
                                foreach ($patrimonios as $key => $patri) {
                                    $datos               =array(
                                    'balance_general_id' => $o->id,
                                    'cuenta'         => $patri['cuenta'],
                                    'cuenta_id'          => $patri['cuenta_id'],
                                    'saldo'              => $patri['saldo'],
                                    'created_at'         => now(),
                                    'updated_at'         => now(),
                                );
                                BGPatrimonio::insert($datos);
                            }
                            return response(array(
                                'success' => true,
                                'message' => 'Balance General creado correctamente'
                            ),200,[]);
                            
                        } 
                    }else if($balanceGeneral == 1){
                                $ids                 = [];
                                $ids1                = [];
                                $ids2                = [];
                                $o                   = BalanceGeneral::where('user_id',$id)->where('taller_id', $taller_id)->first();
                                $a_corriente         = $request->a_corriente;
                                $a_nocorriente       = $request->a_nocorriente;
                                $p_corriente         = $request->p_corriente;
                                $p_nocorriente       = $request->p_nocorriente;
                                $patrimonios         = $request->patrimonio;
                                $o->fecha            = $request->fecha;
                                $o->nombre           = $request->nombre;
                                $o->t_activo         = $request->total_balance_inicial['t_activo'];
                                $o->t_pasivo         = $request->total_balance_inicial['t_pasivo'];
                                $o->t_a_corriente    = $request->totales['t_a_corriente'];
                                $o->t_a_nocorriente  = $request->totales['t_a_nocorriente'];
                                $o->t_p_corriente    = $request->totales['t_p_corriente'];
                                $o->t_p_no_corriente = $request->totales['t_p_no_corriente'];
                                $o->t_patrimonio     = $request->totales['t_patrimonio'];
                                $o->total_pasivo_patrimonio = $request->t_patrimonio;
                                $o->save();

                            $activ=BGActivo::where('balance_general_id', $o->id)->get();

                            foreach($activ as $act){
                                $ids[]=$act->id;
                            }
                            $activosdelete = BGActivo::destroy($ids);

                            $pasi =  BGPasivo::where('balance_general_id', $o->id)->get();
                            foreach($pasi as $pas){
                                $ids1[]=$pas->id;
                            }

                            $pasivosdelete = BGPasivo::destroy($ids1);

                            $patrim = BGPatrimonio::where('balance_general_id', $o->id)->get();
                            foreach($patrim as $pas){
                                $ids2[]=$pas->id;
                            }
                            $patrimoniodelete  = BGPatrimonio::destroy($ids2);

                            foreach ($a_corriente as $key => $activos) {
                                $datos=array(
                                    'balance_general_id' => $o->id,
                                    'cuenta'         => $activos['cuenta'],
                                    'cuenta2'            => $activos['cuenta2'],
                                    'resta'              => $activos['resta'],
                                    'cuenta_id'          => $activos['cuenta_id'],
                                    'saldo'              => $activos['saldo'],
                                    'total_saldo'        => $activos['total_saldo'],
                                    'cuenta_id2'         => $activos['cuenta_id2'],
                                    'saldo2'             => $activos['saldo2'],
                                    'total_saldo2'       => $activos['total_saldo2'],
                                    'tipo'               => 'corriente',
                                    'created_at'         => now(),
                                    'updated_at'         => now(),
                                );
                                BGActivo::insert($datos);
                            }
                                foreach ($a_nocorriente as $key => $activo) {
                                $datos=array(
                                    'balance_general_id' => $o->id,
                                    'cuenta'             => $activo['cuenta'],
                                    'cuenta2'            => $activo['cuenta2'],
                                    'resta'              => $activo['resta'],
                                    'cuenta_id'          => $activo['cuenta_id'],
                                    'saldo'              => $activo['saldo'],
                                    'total_saldo'        => $activo['total_saldo'],
                                    'cuenta_id2'         => $activo['cuenta_id2'],
                                    'saldo2'             => $activo['saldo2'],
                                    'total_saldo2'       => $activo['total_saldo2'],
                                    'tipo'               => 'nocorriente',
                                    'created_at'         => now(),
                                    'updated_at'         => now(),
                                );
                                BGActivo::insert($datos);
                            }
                                foreach ($p_corriente as $key => $pasivos) {
                                $datos=array(
                                    'balance_general_id' => $o->id,
                                    'cuenta'         => $pasivos['cuenta'],
                                    'cuenta_id'         => $pasivos['cuenta_id'],
                                    'saldo'              => $pasivos['saldo'],
                                    'tipo'               => 'corriente',
                                    'created_at'         => now(),
                                    'updated_at'         => now(),
                                );
                                BGPasivo::insert($datos);
                            }
                            foreach ($p_nocorriente as $key => $pasivo) {
                                $datos=array(
                                    'balance_general_id' => $o->id,
                                    'cuenta'         => $pasivo['cuenta'],
                                    'cuenta_id'         => $pasivo['cuenta_id'],
                                    'saldo'              => $pasivo['saldo'],
                                    'tipo'               => 'nocorriente',
                                    'created_at'         => now(),
                                    'updated_at'         => now(),
                                );
                                BGPasivo::insert($datos);
                            }
                                foreach ($patrimonios as $key => $patri) {
                                    $datos               =array(
                                    'balance_general_id' => $o->id,
                                    'cuenta'         => $patri['cuenta'],
                                    'cuenta_id'         => $patri['cuenta_id'],
                                    'saldo'              => $patri['saldo'],
                                    'created_at'         => now(),
                                    'updated_at'         => now(),
                                );
                                BGPatrimonio::insert($datos);
                            }


                        return response(array(
                            'success'   =>  false,
                            'message'   => 'Datos Actualizados Correctamente',             
                            ),200,[]);
                }
            }
            public function obtenerbalanceGeneral(Request $request)
            {
                $id            = Auth::id();
                $taller_id     = $request->id;
                $balanceGeneral = BalanceGeneral::where('user_id',$id)->where('taller_id', $taller_id)->count();

                if ($balanceGeneral >= 1 ) { 

                $datos = BalanceGeneral::where('user_id',$id)->where('taller_id', $taller_id)->first();

                $a_corrientes      = BGActivo::select('cuenta', 'cuenta2', 'resta' , 'cuenta_id' , 'saldo' , 'total_saldo' , 'cuenta_id2' , 'saldo2' , 'total_saldo2' , 'tipo')->where('balance_general_id', $datos->id)->where('tipo', 'corriente')->get();

                $a_nocorrientes    = BGActivo::select('cuenta', 'cuenta2', 'resta' , 'cuenta_id' , 'saldo' , 'total_saldo' , 'cuenta_id2' , 'saldo2' , 'total_saldo2' , 'tipo')->where('balance_general_id', $datos->id)->where('tipo', 'nocorriente')->get();

                $p_corriente       = BGPasivo::select('cuenta', 'cuenta_id', 'saldo')->where('balance_general_id', $datos->id)->where('tipo', 'corriente')->get();

                $p_nocorriente     = BGPasivo::select('cuenta', 'cuenta_id', 'saldo')->where('balance_general_id', $datos->id)->where('tipo', 'nocorriente')->get();

                $patrimonios       = $datos->bgPatrimonios;

                    return response(array(
                            'datos' => true,
                            'nombre'                  => $datos->nombre,
                            'fecha'                   => $datos->fecha,
                            'total_pasivo_patrimonio' => $datos->total_pasivo_patrimonio,
                            'a_corriente'             => $a_corrientes,
                            'a_nocorriente'           => $a_nocorrientes,
                            'p_corriente'             => $p_corriente,
                            'p_nocorriente'           => $p_nocorriente,
                            'patrimonios'             => $patrimonios,
                            'bgneral'                 => $datos
                        ),200,[]);
        

                    }else{
                        return response(array(
                            'datos' => false,
                            ),200,[]);
                    }
            }
        public function asientosCierre(Request $request)
            {
                        $id              = Auth::id();
                        $taller_id       = $request->id;
                        $registro        = $request->registro;
                        $asientodecierre = AsientoCierre::where('user_id',$id)->where('taller_id', $taller_id)->count();
                    if ($asientodecierre == 1){ 
                        $cu          = AsientoCierre::where('user_id',$id)->where('taller_id', $taller_id)->first();
                        $cuenta      = ACRegistro::where('asiento_cierre_id',$cu->id)->count();
                        $acierredele = AsientoCierre::where('user_id',$id)->where('taller_id', $taller_id)->first();
                        $debe        =[];
                        $haber       =[];
                        $ids         =[];
                        $udcalculo = $acierredele->id;
                        $acierredele->delete();

                        $acierre              = new AsientoCierre;
                        $acierre->id          = $udcalculo;
                        $acierre->taller_id   = $taller_id;
                        $acierre->user_id     = $id;
                        $acierre->nombre      = $request->nombre;
                        $acierre->total_haber = $request->total_haber;
                        $acierre->total_debe  = $request->total_debe;
                        $acierre->save();
                     

                        // $registros= ACRegistro::where('asiento_cierre_id', $acierre->id)->get();
                        // foreach($registros as $act){
                        //         $ids[]=$act->id;
                        // }
                        // $deleteRegistros = ACRegistro::destroy($ids);

                        foreach ($registro as $key => $value) {                         //RECORRER TODOS LOS REGISTROS EN EL ARRAY
                    $regis=array(
                            'asiento_cierre_id' => $acierre->id,
                            'no_registro'       => $key + 1,
                            'comentario'        => $value['comentario'],
                            'fecha'             => $value['fecha'],
                            // 'tipo'              => $value['tipo'],
                            'created_at'        => now(),
                            'updated_at'        => now(),
                        );
                        ACRegistro::insert($regis);                           //GUARDAR CADA REGISTRO EN LA BASE DE DATOS
                    }
                    $register = $acierre->acRegistro;
                    foreach ($registro as $keya => $vcuentas) {                         ////RECORRER TODOS LOS REGISTROS EN EL ARRAY
                        foreach ($vcuentas['debe'] as $key1 => $value1) {              ////RECORRER TODOS LAS CUENTAS DE DEBE QUE PERTENECEN A UN REGISTRO
                            $regis1=array(
                                'a_c_registro_id' => $register[$keya]->id,
                                'cuenta_id'       => $value1['cuenta_id'],
                                'nom_cuenta'      => $value1['nom_cuenta'],
                                'saldo'           => $value1['saldo'],
                                'fecha'           => $value1['fecha'],
                                'created_at'      => now(),
                                'updated_at'      => now(),
                            );
                            ACRDebe::insert($regis1);                             //GURDAR ESAS CUENTAS EN LA TABLA DEBE CON EL ID DEL REGISTRO AL QUE CORRESPONDEN
                        }
                        foreach ($vcuentas['haber'] as $key2 => $value2) {           ////RECORRER TODOS LAS CUENTAS DE HABER QUE PERTENECEN A UN REGISTRO
                            $regis2=array(
                                'a_c_registro_id' => $register[$keya]->id,
                                'cuenta_id'       => $value2['cuenta_id'],
                                'nom_cuenta'      => $value2['nom_cuenta'],
                                'saldo'           => $value2['saldo'],
                                'created_at'      => now(),
                                'updated_at'      => now(),
                            );
                            ACRHaber::insert($regis2);                            //GURDAR ESAS CUENTAS EN LA TABLA HABER CON EL ID DEL REGISTRO AL QUE CORRESPONDEN
                        }
                    }
                    return response(array(
                            'success' => 'act',
                            'message' => 'Asiento de Cierre  Actualizado Correctamente'
                        ),200,[]);
                    }else{ 
                    $asientodecierre               = new AsientoCierre;
                    $asientodecierre->taller_id    = $taller_id;
                    $asientodecierre->user_id      = $id;
                    $asientodecierre->nombre       = $request->nombre;
                    $asientodecierre->total_haber  = $request->total_haber;
                    $asientodecierre->total_debe   = $request->total_debe;
                    $asientodecierre->save();
                    $acierre = AsientoCierre::where('user_id',$id)->where('taller_id', $taller_id)->first();
                    $debe =[];
                    $haber =[];
                    foreach ($registro as $key => $value) {                         //RECORRER TODOS LOS REGISTROS EN EL ARRAY
                        $regis=array(
                                'asiento_cierre_id' => $acierre->id,
                                'no_registro'       => $key + 1,
                                'comentario'        => $value['comentario'],
                                'fecha'             => $value['fecha'],
                                // 'tipo'              => $value['tipo'],
                                'created_at'        => now(),
                                'updated_at'        => now(),
                            );
                            ACRegistro::insert($regis);                           //GUARDAR CADA REGISTRO EN LA BASE DE DATOS
                    }
                    $register = $acierre->acRegistro;
                    foreach ($registro as $keya => $vcuentas) {                         ////RECORRER TODOS LOS REGISTROS EN EL ARRAY
                        foreach ($vcuentas['debe'] as $key1 => $value1) {              ////RECORRER TODOS LAS CUENTAS DE DEBE QUE PERTENECEN A UN REGISTRO
                            $regis1=array(
                                'a_c_registro_id' => $register[$keya]->id,
                                'cuenta_id'       => $value1['cuenta_id'],
                                'nom_cuenta'      => $value1['nom_cuenta'],
                                'saldo'           => $value1['saldo'],
                                'fecha'           => $value1['fecha'],
                                'created_at'      => now(),
                                'updated_at'      => now(),
                            );
                            ACRDebe::insert($regis1);                             //GURDAR ESAS CUENTAS EN LA TABLA DEBE CON EL ID DEL REGISTRO AL QUE CORRESPONDEN
                        }
                        foreach ($vcuentas['haber'] as $key2 => $value2) {           ////RECORRER TODOS LAS CUENTAS DE HABER QUE PERTENECEN A UN REGISTRO
                            $regis2=array(
                                'a_c_registro_id' => $register[$keya]->id,
                                'cuenta_id'       => $value2['cuenta_id'],
                                'nom_cuenta'      => $value2['nom_cuenta'],
                                'saldo'           => $value2['saldo'],
                                'created_at'      => now(),
                                'updated_at'      => now(),
                            );
                            ACRHaber::insert($regis2);                            //GURDAR ESAS CUENTAS EN LA TABLA HABER CON EL ID DEL REGISTRO AL QUE CORRESPONDEN
                        }
                    }                                           //GUARDAR ESE CAMBIO
                    return response(array(                                         //ENVIO DE RESPUESTA
                            'success' => true,
                            'message' => 'Asiento de Cierre creado correctamente'
                        ),200,[]);
                                                                        // SI NO TIENE CREADO EL BALANCE INICIAL ANTES DE GUARDAR, LE SALDRA UNA NOTIFICACION INDICANDO DICHO P
                    }
            
            }
        public function obtenerAsientoCierre(Request $request)
            {
                $id         = Auth::id();
                $taller_id  = $request->id;
                $dioGeneral = AsientoCierre::where('user_id',$id)->where('taller_id', $taller_id)->count();
                $registros  = [];
                if ($dioGeneral  == 1) {
                $diairioGeneral    = AsientoCierre::where('user_id',$id)->where('taller_id', $taller_id)->first();
                $normal = ACRegistro::where('asiento_cierre_id', $diairioGeneral->id)->orderBy('fecha')->get();
                    foreach ($normal as $key => $registro) {
                        $regis = array(
                            'debe'       => $registro->acrDebe,
                            'haber'      =>$registro->acrHaber,
                            'fecha'      => $registro->fecha,
                            'comentario' => $registro->comentario
                        );
                        $registros[]= $regis;
                    }
                    return response(array(
                        'datos'     => true,
                        'nombre'    => $diairioGeneral->nombre,
                        'registros' => $registros,
                    ),200,[]);
                    
                }else{
                    return response(array(
                        'datos' => false,
                    ),200,[]);

                }
            }





        public function AnexoCaja(Request $request)
        {
            $user_id = Auth::id();
            $taller_id            = $request->id;
            $nombre               =$request->nombre;
            $libros_cajas         =$request->libros_caja;
            $anexocaja            = Anexocaja::where('user_id', $user_id)->where('taller_id',$taller_id)->count();
            if($anexocaja == 0){
                $mc   = new Anexocaja;
                $mc->taller_id = $taller_id;
                $mc->user_id   = $user_id;
                $mc->nombre    = $nombre;
                $mc->totaldebe      = $request->debe;
                $mc->totalhaber     = $request->haber;    
                $mc->save();

                $a = Anexocaja::where('user_id', $user_id)->get()->last();

                foreach($libros_cajas as $key=>$lc){

                    $datos = array(
                    'anexocaja_id'      => $a->id,
                    'fecha'             =>$lc['fecha'],
                    'detalle'           =>$lc['detalle'],
                    'debe'              =>$lc['debe'],
                    'haber'             =>$lc['haber'],
                    'saldo'             =>$lc['saldo'],
                    'created_at'        => now(),
                    'updated_at'        => now(),

                    );
                    Cajadatos::insert($datos);
                }
                return response(array(
                    'success' => true,
                    'estado'  => 'guardado',
                    'message' => 'Anexo Libro Caja creado correctamente'
                ),200,[]);

            } elseif($anexocaja == 1){
                
                $ids                 =[];
            $accanexo             = Anexocaja::where('user_id', $user_id)->where('taller_id', $taller_id)->first();
            $accanexo->nombre     =$request->nombre;
            $accanexo->totaldebe  = $request->debe;
            $accanexo->totalhaber = $request->haber;
            $accanexo->save();

            $registros= Cajadatos::where('anexocaja_id', $accanexo->id)->get();

            foreach($registros as $r){
                $ids[]= $r->id;
            }
                $deleteregistros = Cajadatos::destroy($ids);
                $a = Anexocaja::where('user_id', $user_id)->get()->last();

                foreach($libros_cajas as $key=>$lc){

                $datos = array(
                    'anexocaja_id'  =>$a->id,
                    'fecha'         =>$lc['fecha'],
                    'detalle'       =>$lc['detalle'],
                    'debe'          =>$lc['debe'],
                    'haber'         =>$lc['haber'],
                    'saldo'         =>$lc['saldo'],
                    'created_at'              => now(),
                    'updated_at'              => now(),

                );
                Cajadatos::insert($datos);
                }
                return response(array(
                'success' => true,
                'estado'  => 'actualizado',
                'message' => 'Anexo Libro Caja Actualizado correctamente'
            ),200,[]);
            }
        }

        public function obtenerLibroCaja(Request $request)
        {
        
            $user_id =Auth::id();        
            $taller_id = $request->id;
            $obanexo = Anexocaja::where('user_id', $user_id)->where('taller_id', $taller_id)->count();
                if($obanexo == 1){
            $anexocaja = Anexocaja::where('user_id', $user_id)->where('taller_id', $taller_id)->first();
            $obtenerc  = Cajadatos::select('fecha','detalle','debe','haber','saldo')->where('anexocaja_id',$anexocaja->id)->get();

            return response(array(
                'datos' => true,
                'banexocaja' => $obtenerc,
                'nombre' =>$anexocaja->nombre,
                'totaldebe' =>$anexocaja->totaldebe,
                'totalhaber' =>$anexocaja->totalhaber,

            ),200,[]);
            }else{
                return response(array(
                'datos' => false,
            ),200,[]);

            }

        }



        public function ArqueoCaja(Request $request)
        {
            $uid              = Auth::id();
            $taller_id        = $request->id;
            $t_saldo          = $request->t_saldo;
            $t_exis           = $request->t_exis;
           
            $ar  = Arqueocajas::where('user_id', $uid)->where('taller_id',$taller_id)->count();      
            if($ar == 0){
                $a = new Arqueocajas;
                $a->taller_id         = $taller_id;
                $a->user_id           = $uid;              
                $a->totaldebe         = $request->td;
                $a->totalhaber        = $request->th;
                $a->saldo_ctcaja      = $request->saldo_ctcaja;
                $a->saldo_arqueocaja  = $request->saldo_arqueocaja;
                $a->select_resultado  = $request->select_resultado;
                $a->select_valor      = $request->select_valor;
                $a->cuenta1           = $request->cuenta1;
                $a->cuenta2           = $request->cuenta2;
                $a->valor1            = $request->valor1;
                $a->valor2            = $request->valor2;
                $a->save();

                $e= Arqueocajas::where('user_id', $uid)->get()->last();

                foreach($t_saldo as $key=>$s){

                    $datos = array(
                        'arqueocaja_id' =>$e->id,
                        'detalle'        =>$s['detalle'],
                        's_debe'           =>$s['s_debe'],
                        's_haber'          =>$s['s_haber'],
                        'created_at'        => now(),
                        'updated_at'        => now(),
        
                    );
                    ArqueoSaldo::insert($datos);
                }
                foreach($t_exis as $key=>$ex){

                $datos = array(
                    'arqueocaja_id'  =>$e->id,
                    'detalle'        =>$ex['detalle'],
                    'e_debe'           =>$ex['e_debe'],
                    'e_haber'          =>$ex['e_haber'],
                    'created_at'        => now(),
                    'updated_at'        => now(),
    
                );
                    ArqueoExi::insert($datos);
                }
                return response(array(
                    'success' => true,
                    'estado'  => 'guardado',
                    'message' => 'Anexo Arqueo de Caja creado correctamente'
                ),200,[]);

                } elseif($ar == 1){
                    
                    $ids     =[];
                    $ar      = Arqueocajas::where('user_id', $uid)->where('taller_id',$taller_id)->first();
                    $ar->totaldebe      = $request->td;
                    $ar->totalhaber      = $request->th;
                    $ar->saldo_ctcaja      = $request->saldo_ctcaja;
                    $ar->saldo_arqueocaja  = $request->saldo_arqueocaja;
                    $ar->select_resultado  = $request->select_resultado;
                    $ar->select_valor      = $request->select_valor;
                    $ar->cuenta1           = $request->cuenta1;
                    $ar->cuenta2           = $request->cuenta2;
                    $ar->valor1            = $request->valor1;
                    $ar->valor2            = $request->valor2;
                    $ar->save();

                    $sa = ArqueoSaldo::where('arqueocaja_id', $ar->id)->get();        
                    foreach($sa as $i){
                    $ids[]=$i->id;
                    }
                    $deteletearqueosaldo = ArqueoSaldo::destroy($ids);


                    $ex = ArqueoExi::where('arqueocaja_id', $ar->id)->get(); 
                    foreach($ex as $i){
                    $ids[]=$i->id;
                    }          
                    $deteletearqueoexis = ArqueoExi::destroy($ids);


                    $e = Arqueocajas::where('user_id', $uid)->get()->last();

                    foreach($t_saldo as $key=>$s){

                        $datos = array(
                            'arqueocaja_id' =>$e->id,
                            'detalle'        =>$s['detalle'],
                            's_debe'           =>$s['s_debe'],
                            's_haber'          =>$s['s_haber'],
                            'created_at'        => now(),
                            'updated_at'        => now(),
            
                        );
                        ArqueoSaldo::insert($datos);
                    } 
                    foreach($t_exis as $key=>$ex){

                        $datos = array(
                            'arqueocaja_id' =>$e->id,
                            'detalle'        =>$ex['detalle'],
                            'e_debe'          =>$ex['e_debe'],
                            'e_haber'         =>$ex['e_haber'],
                            'created_at'        => now(),
                            'updated_at'        => now(),
            
                        );
                        ArqueoExi::insert($datos);
                    }
                    return response(array(
                        'success' => true,
                        'estado'  => 'actualizado',
                        'message' => 'Anexo Arqueo de Caja Actualizado correctamente'
                    ),200,[]);
                }
        }

        public function obtenerArqueo (Request $request)
        {
            $user_id    = Auth::id();
            $taller_id  = $request->id;

            $ar  = Arqueocajas::where('user_id', $user_id)->where('taller_id',$taller_id)->count();

            if($ar==1){
                $a = Arqueocajas::where('user_id', $user_id)->where('taller_id',$taller_id)->first();
                $sa = ArqueoSaldo::select('detalle','s_debe','s_haber')->where('arqueocaja_id', $a->id)->get();
                $ex = ArqueoExi::select('detalle','e_debe','e_haber')->where('arqueocaja_id', $a->id)->get();
            
                return response(array(
                    'datos' => true,
                    'saldo_ctcaja'     =>$a->saldo_ctcaja,
                    'saldo_arqueocaja' =>$a->saldo_arqueocaja,
                    'select_resultado' =>$a->select_resultado,
                    'select_valor'     =>$a->select_valor,
                    'cuenta1'          =>$a->cuenta1,
                    'cuenta2'          =>$a->cuenta2,
                    'valor1'           =>$a->valor1,
                    'valor2'           =>$a->valor2,
                    'saldo' => $sa, 
                    'exis' =>  $ex, 
                ),200,[]);
            }else{
                return response(array(
                'datos' => false,
            ),200,[]);

            }

        }


        public function LibroBanco (Request $request)
        {

            $uid = Auth::id();
            $taller_id  = $request->id;
            $nombre     = $request->nombre;
            $n_banco     = $request->n_banco;
            $c_banco     = $request->c_banco;
            $lb_bancos  = $request->lb_banco;
            $lb         =Librobanco::where('user_id', $uid)->where('taller_id', $taller_id)->count();
            if($lb == 0){
                $b = new Librobanco;
                $b->taller_id = $taller_id;
                $b->user_id   = $uid;
                $b->nombre    = $nombre;
                $b->n_banco    = $n_banco;
                $b->c_banco    = $c_banco;
                $b->totaldebe      = $request->debe;
                $b->totalhaber     = $request->haber;    
                $b->save();
                
                $mb = Librobanco::where('user_id', $uid)->get()->last();

                foreach($lb_bancos as $key=>$i){

                    $datos = array (
                        'librobanco_id'  =>$mb->id,
                        'fecha'             =>$i['fecha'],
                        'detalle'           =>$i['detalle'],
                        'cheque'            =>$i['cheque'],
                        'debe'              =>$i['debe'],
                        'haber'             =>$i['haber'],
                        'saldo'             =>$i['saldo'],
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    );
                    Movimientobanco::insert($datos);
                }
                return response(array(
                    'success' => true,
                    'estado'  => 'guardado',
                    'message' => 'Anexo Libro Banco creado correctamente'
                ),200,[]);


            }elseif($lb == 1){

                $ids           =[];
                $lb            =Librobanco::where('user_id', $uid)->where('taller_id', $taller_id)->first();
                $lb->nombre    =$request->nombre;
                $lb->n_banco    =$request->n_banco;
                $lb->c_banco    =$request->c_banco;
                $lb->totaldebe  = $request->debe;
                $lb->totalhaber = $request->haber;
                $lb->save();


                $rgb = Movimientobanco::where('librobanco_id', $lb->id)->get();

                foreach($rgb as $r){
                    $ids[]= $r->id;
                }

                $deletebanco= Movimientobanco::destroy($ids);

                $a = Librobanco::where('user_id', $uid)->get()->last();

                foreach($lb_bancos as $key=>$i){
                    $datos = array (
                        'librobanco_id'  =>$a->id,
                        'fecha'             =>$i['fecha'],
                        'detalle'           =>$i['detalle'],
                        'cheque'            =>$i['cheque'],
                        'debe'              =>$i['debe'],
                        'haber'             =>$i['haber'],
                        'saldo'             =>$i['saldo'],
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    );
                    Movimientobanco::insert($datos);
                }
                return response(array(
                'success' => true,
                'estado'  => 'actualizado',
                'message' => 'Anexo Libro Banco Actualizado correctamente'
            ),200,[]);

            }

        }

        public function obtenerLbanco (Request $request)
        {
            $uid = Auth::id();
            $taller_id = $request->id;
            $lb =Librobanco::where('user_id', $uid)->where('taller_id', $taller_id)->count();

            if($lb == 1){
                $lbs = Librobanco::where('user_id', $uid)->where('taller_id', $taller_id)->first();
                $mb  = Movimientobanco::select('fecha','detalle','cheque','debe','haber','saldo')->where('librobanco_id',$lbs->id)->get();
        
                return response(array(
                    'datos' => true,
                    'mb' => $mb,
                    'nombre' =>$lbs->nombre,
                    'n_banco' =>$lbs->n_banco,
                    'c_banco' =>$lbs->c_banco,
                    'totaldebe'=>$lbs->totaldebe,
                    'totalhaber'=>$lbs->totalhaber,
                ),200,[]);
                }else{
                    return response(array(
                    'datos' => false,
                ),200,[]);
        
                }

        }

 
        public function ConciliacionBancaria(Request $request)
        {
            $id  = Auth::id();
            $taller_id     = $request->id;
            $nombre        =$request->nombre;
            $fecha         =$request->fecha;
            $n_banco       =$request->n_banco;
            $c_saldos      =$request->c_saldos;
            $c_debitos     =$request->c_debitos;
            $c_creditos    =$request->c_creditos;
            $c_cheques     =$request->c_cheques;
            $c_depositos   =$request->c_depositos;
            
            $cb  = Conciliacionbancaria::where('user_id', $id)->where('taller_id',$taller_id)->count();      
            if($cb ==0){
                $b = new Conciliacionbancaria;
                $b->taller_id         = $taller_id;
                $b->user_id           = $id;
                $b->nombre            = $nombre;
                $b->fecha             = $fecha;
                $b->n_banco           = $n_banco;
                $b->saldo_c           = $request->saldo_c;
                $b->saldo_ch          = $request->saldo_ch;
                $b->saldo_d           = $request->saldo_d;
                $b->saldo_depositos    = $request->saldo_depositos;
                $b->total             = $request->total;
                $b->save();
                $cbs= Conciliacionbancaria::where('user_id', $id)->get()->last();
                        foreach($c_saldos as $key=>$s){

                            $datos = array(
                                'conciliacionbancaria_id' =>$cbs->id,
                                'fecha'          =>$s['fecha'],
                                'detalle'        =>$s['detalle'],
                                'saldo'          =>$s['saldo'],
                                'created_at'        => now(),
                                'updated_at'        => now(),
                
                            );
                            Conciliacionsaldo::insert($datos);
                        }
                        foreach($c_debitos as $key=>$s){

                            $datos = array(
                                'conciliacionbancaria_id' =>$cbs->id,
                                'fecha'          =>$s['fecha'],
                                'detalle'        =>$s['detalle'],
                                'saldo'          =>$s['saldo'],
                                'created_at'        => now(),
                                'updated_at'        => now(),
                
                            );
                            Conciliaciondebito::insert($datos);
                        }
                        foreach($c_depositos as $key=>$de){

                            $datos = array(
                                'conciliacionbancaria_id' =>$cbs->id,
                                'fecha'          =>$de['fecha'],
                                'detalle'        =>$de['detalle'],
                                'saldo'          =>$de['saldo'],
                                'created_at'        => now(),
                                'updated_at'        => now(),
                
                            );
                            Conciliaciondeposito::insert($datos);
                        }
                        foreach($c_creditos as $key=>$s){

                            $datos = array(
                                'conciliacionbancaria_id' =>$cbs->id,
                                'fecha'          =>$s['fecha'],
                                'detalle'        =>$s['detalle'],
                                'saldo'          =>$s['saldo'],
                                'created_at'        => now(),
                                'updated_at'        => now(),
                            );
                            Conciliacioncredito::insert($datos);
                        }
                        foreach($c_cheques as $key=>$s){

                            $datos = array(
                                'conciliacionbancaria_id' =>$cbs->id,
                                'fecha'          =>$s['fecha'],
                                'detalle'        =>$s['detalle'],
                                'saldo'          =>$s['saldo'],
                                'created_at'        => now(),
                                'updated_at'        => now(),
                
                            );
                            Conciliacioncheque::insert($datos);
                        }
                        return response(array(
                            'success' => true,
                            'estado'  => 'guardado',
                            'message' => 'Anexo Conciliación Bancaria creado correctamente'
                        ),200,[]);
        

                }elseif ($cb == 1){
                    $ids     =[];
                    $cb  = Conciliacionbancaria::where('user_id', $id)->where('taller_id',$taller_id)->first();     
                    $cb->nombre     = $nombre;
                    $cb->fecha      = $fecha;
                    $cb->n_banco    = $n_banco;
                    $cb->saldo_c    = $request->saldo_c;
                    $cb->saldo_depositos    = $request->saldo_depositos;
                    $cb->saldo_ch   = $request->saldo_ch;
                    $cb->saldo_d    = $request->saldo_d;
                    $cb->total      = $request->total;
                    $cb->save();
                    
                    $cbs = Conciliacionsaldo::where('conciliacionbancaria_id',$cb->id)->get();
                    foreach($cbs as $i){
                        $ids[]=$i->id;
                    }
                    $deteletesaldo = Conciliacionsaldo::destroy($ids);

                    $cbde = Conciliaciondeposito::where('conciliacionbancaria_id',$cb->id)->get();
                    foreach($cbde as $i){
                        $ids[]=$i->id;
                    }
                    $deteletedeposito = Conciliaciondeposito::destroy($ids);

                    $cbd = Conciliaciondebito::where('conciliacionbancaria_id',$cb->id)->get();
                    foreach($cbd as $i){
                        $ids[]=$i->id;
                    }
                    $deteletedebito = Conciliaciondebito::destroy($ids);

                    $cbc = Conciliacioncredito::where('conciliacionbancaria_id',$cb->id)->get();
                    foreach($cbc as $i){
                        $ids[]=$i->id;
                    }
                    $deteletecredito = Conciliacioncredito::destroy($ids);

                    $cbch = Conciliacioncheque::where('conciliacionbancaria_id',$cb->id)->get();
                    foreach($cbch as $i){
                        $ids[]=$i->id;
                    }
                    $deteletecheque = Conciliacioncheque::destroy($ids);

                    
                    $cba= Conciliacionbancaria::where('user_id', $id)->get()->last();

                    foreach($c_saldos as $key=>$s){

                        $datos = array(
                            'conciliacionbancaria_id' =>$cba->id,
                            'fecha'          =>$s['fecha'],
                            'detalle'        =>$s['detalle'],
                            'saldo'          =>$s['saldo'],
                            'created_at'        => now(),
                            'updated_at'        => now(),
            
                        );
                        Conciliacionsaldo::insert($datos);
                    }
                    foreach($c_debitos as $key=>$s){

                        $datos = array(
                            'conciliacionbancaria_id' =>$cba->id,
                            'fecha'          =>$s['fecha'],
                            'detalle'        =>$s['detalle'],
                            'saldo'          =>$s['saldo'],
                            'created_at'        => now(),
                            'updated_at'        => now(),
            
                        );
                        Conciliaciondebito::insert($datos);
                    }
                    foreach($c_creditos as $key=>$s){

                        $datos = array(
                            'conciliacionbancaria_id' =>$cba->id,
                            'fecha'          =>$s['fecha'],
                            'detalle'        =>$s['detalle'],
                            'saldo'          =>$s['saldo'],
                            'created_at'        => now(),
                            'updated_at'        => now(),
            
                        );
                        Conciliacioncredito::insert($datos);
                    }
                    foreach($c_cheques as $key=>$s){

                        $datos = array(
                            'conciliacionbancaria_id' =>$cba->id,
                            'fecha'          =>$s['fecha'],
                            'detalle'        =>$s['detalle'],
                            'saldo'          =>$s['saldo'],
                            'created_at'        => now(),
                            'updated_at'        => now(),
            
                        );
                        Conciliacioncheque::insert($datos);
                    }
                    foreach($c_depositos as $key=>$de){

                        $datos = array(
                            'conciliacionbancaria_id' =>$cba->id,
                            'fecha'          =>$de['fecha'],
                            'detalle'        =>$de['detalle'],
                            'saldo'          =>$de['saldo'],
                            'created_at'        => now(),
                            'updated_at'        => now(),
            
                        );
                        Conciliaciondeposito::insert($datos);
                    }
                    return response(array(
                        'success' => true,
                        'estado'  => 'actualizado',
                        'message' => 'Anexo Conciliación Bancaria Actualizado correctamente'
                    ),200,[]);

                } //end elseif
        }

        public function ObtenerConciliacionB (Request $request)
        {
            $id = Auth::id();
            $taller_id = $request->id;
            $cb  = Conciliacionbancaria::where('user_id', $id)->where('taller_id',$taller_id)->count();

            if($cb==1){
                $a     = Conciliacionbancaria::where('user_id', $id)->where('taller_id',$taller_id)->first();
            $saldo     = Conciliacionsaldo::select('fecha','detalle','saldo')->where('conciliacionbancaria_id',  $a->id)->get();
            $debito    = Conciliaciondebito::select('fecha','detalle','saldo')->where('conciliacionbancaria_id',  $a->id)->get();
            $credito   = Conciliacioncredito::select('fecha','detalle','saldo')->where('conciliacionbancaria_id',  $a->id)->get();
            $cheque    = Conciliacioncheque::select('fecha','detalle','saldo')->where('conciliacionbancaria_id',  $a->id)->get();
            $deposito  = Conciliaciondeposito::select('fecha','detalle','saldo')->where('conciliacionbancaria_id',  $a->id)->get();
        
            return response(array(
                'datos'   => true,
                'saldo'   => $saldo, 
                'debito'  => $debito, 
                'credito' => $credito, 
                'cheque'  => $cheque, 
                'deposito'=> $deposito, 
                'nombre'  => $a->nombre,
                'fecha'   => $a->fecha,
                'n_banco' => $a->n_banco,
            ),200,[]);
            
            }else{
                return response(array(
                'datos' => false,
            ),200,[]);

            } //fin else

        } //fin metodo obtener

        public function RetencionIva (Request $request){

          $id = Auth::id();
          $taller_id  = $request->id;
          $nombre_c  = $request->nombre_c;
          $contribuyente  = $request->contribuyente;
          $fecha     = $request->fecha;
          $ruc       = $request->ruc;
          $t_compras = $request->t_compras;
          $t_ventas  = $request->t_ventas;

          $rt = Retencioniva::where('user_id', $id)->where('taller_id',$taller_id)->count();   
          
          if($rt == 0){
              $r = new Retencioniva;
              $r->taller_id   = $taller_id;
              $r->user_id     = $id;
              $r->nombre      = $nombre_c;
              $r->contribuyente = $contribuyente;
              $r->fecha       = $fecha;
              $r->ruc         = $ruc;
              $r->sumac_base  = $request->sumac_base;
              $r->sumac_reten = $request->sumac_reten;
              $r->sumac_ivac  = $request->sumac_ivac;
              $r->sumac_10    = $request->sumac_10;
              $r->sumac_20    = $request->sumac_20;
              $r->sumac_30    = $request->sumac_30;
              $r->sumac_70    = $request->sumac_70;
              $r->sumac_100    = $request->sumac_100;
              $r->sumav_base  = $request->sumav_base;
              $r->sumav_reten = $request->sumav_reten;
              $r->sumav_ivav  = $request->sumav_ivav;
              $r->sumav_10    = $request->sumav_10;
              $r->sumav_20    = $request->sumav_20;
              $r->sumav_30    = $request->sumav_30;
              $r->sumav_70    = $request->sumav_70;
              $r->sumav_100   = $request->sumav_100;
              $r->t_ivacompra = $request->t_ivacompra;
              $r->t_ivaventa  = $request->t_ivaventa;
              $r->total       = $request->total;
              $r->t_reten     = $request->t_reten;
              $r->result_iva  =$request->result_iva;
              $r->save();

              $rti = Retencioniva::where('user_id', $id)->get()->last();

              foreach($t_compras as $key=>$c){
                    $datos=array(
                        'retencioniva_id' => $rti->id,
                        'fecha_c'         =>$c['fecha_c'],
                        'detalle'         =>$c['detalle'],
                        'proveedor'       =>$c['proveedor'],
                        'base_im'         =>$c['base_im'],
                        'porcentaje'      =>$c['porcentaje'],
                        'v_retenido'      =>$c['v_retenido'],
                        'iva'             =>$c['iva'],
                        'ret_10'          =>$c['ret_10'],
                        'ret_20'          =>$c['ret_20'],
                        'ret_30'          =>$c['ret_30'],
                        'ret_70'          =>$c['ret_70'],
                        'ret_100'         =>$c['ret_100'],
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    );
                    Retencionivacompra::insert($datos);
                }
                foreach($t_ventas as $key=>$v){
                    $datos=array(
                        'retencioniva_id' => $rti->id,
                        'fecha_v'         =>$v['fecha_v'],
                        'detalle'         =>$v['detalle'],
                        'cliente'         =>$v['cliente'],
                        'base_im'         =>$v['base_im'],
                        'porcentaje'      =>$v['porcentaje'],
                        'v_retenido'      =>$v['v_retenido'],
                        'iva'             =>$v['iva'],
                        'ret_10'          =>$v['ret_10'],
                        'ret_20'          =>$v['ret_20'],
                        'ret_30'          =>$v['ret_30'],
                        'ret_70'          =>$v['ret_70'],
                        'ret_100'         =>$v['ret_100'],
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    );
                    Retencionivaventa::insert($datos);
                }
                return response(array(
                    'success' => true,
                    'estado'  => 'guardado',
                    'message' => 'Anexo Retención del Iva creado correctamente'
                ),200,[]);            
          
            }elseif($rt == 1){
              
                $ids =[];
                $r = Retencioniva::where('user_id', $id)->where('taller_id',$taller_id)->first();     
                $r->nombre      = $nombre_c;
                $r->contribuyente = $contribuyente;
                $r->fecha       = $fecha;
                $r->ruc         = $ruc;
                $r->sumac_base  = $request->sumac_base;
                $r->sumac_reten = $request->sumac_reten;
                $r->sumac_ivac  = $request->sumac_ivac;
                $r->sumac_10    = $request->sumac_10;
                $r->sumac_20    = $request->sumac_20;
                $r->sumac_30    = $request->sumac_30;
                $r->sumac_70    = $request->sumac_70;
                $r->sumac_100    = $request->sumac_100;
                $r->sumav_base  = $request->sumav_base;
                $r->sumav_reten = $request->sumav_reten;
                $r->sumav_ivav  = $request->sumav_ivav;
                $r->sumav_10    = $request->sumav_10;
                $r->sumav_20    = $request->sumav_20;
                $r->sumav_30    = $request->sumav_30;
                $r->sumav_70    = $request->sumav_70;
                $r->sumav_100   = $request->sumav_100;
                $r->t_ivacompra = $request->t_ivacompra;
                $r->t_ivaventa  = $request->t_ivaventa;
                $r->total       = $request->total;
                $r->t_reten     = $request->t_reten;
                $r->result_iva  =$request->result_iva;
                $r->save();

                $rtc = Retencionivacompra::where('retencioniva_id',$r->id)->get();
                foreach($rtc as $i){
                    $ids[]=$i->id;
                }
                $deteleretencionivacompra = Retencionivacompra::destroy($ids);
         
                $rtv = Retencionivaventa::where('retencioniva_id',$r->id)->get();
                foreach($rtv as $i){
                    $ids[]=$i->id;
                }
                $deteleretencionivaventa = Retencionivaventa::destroy($ids);
               
                $rti = Retencioniva::where('user_id', $id)->get()->last();

                foreach($t_compras as $key=>$c){
                    $datos = array(
                        'retencioniva_id' => $rti->id,
                        'fecha_c'         =>$c['fecha_c'],
                        'detalle'         =>$c['detalle'],
                        'proveedor'       =>$c['proveedor'],
                        'base_im'         =>$c['base_im'],
                        'porcentaje'      =>$c['porcentaje'],
                        'v_retenido'      =>$c['v_retenido'],
                        'iva'             =>$c['iva'],
                        'ret_10'          =>$c['ret_10'],
                        'ret_20'          =>$c['ret_20'],
                        'ret_30'          =>$c['ret_30'],
                        'ret_70'          =>$c['ret_70'],
                        'ret_100'         =>$c['ret_100'],
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    );
                    Retencionivacompra::insert($datos);
                }
                foreach($t_ventas as $key=>$v){
                    $datos = array(
                        'retencioniva_id' => $rti->id,
                        'fecha_v'         =>$v['fecha_v'],
                        'detalle'         =>$v['detalle'],
                        'cliente'         =>$v['cliente'],
                        'base_im'         =>$v['base_im'],
                        'porcentaje'      =>$v['porcentaje'],
                        'v_retenido'      =>$v['v_retenido'],
                        'iva'             =>$v['iva'],
                        'ret_10'          =>$v['ret_10'],
                        'ret_20'          =>$v['ret_20'],
                        'ret_30'          =>$v['ret_30'],
                        'ret_70'          =>$v['ret_70'],
                        'ret_100'         =>$v['ret_100'],
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    );
                    Retencionivaventa::insert($datos);
                }
                return response(array(
                    'success' => true,
                    'estado'  => 'actualizado',
                    'message' => 'Anexo Retención del Iva Actualizado correctamente'
                ),200,[]);            
         
            } //end elseif
        } //fin guardar retencion del iva

        public function ObtenerRetencionIva(Request $request){
            $id = Auth::id();            
            $taller_id = $request->id;
            $rt = Retencioniva::where('user_id', $id)->where('taller_id',$taller_id)->count();

            if($rt == 1){
            
                    $r = Retencioniva::where('user_id', $id)->where('taller_id',$taller_id)->first();
                $compra = Retencionivacompra::select('fecha_c','detalle','proveedor','base_im','porcentaje', 'v_retenido', 'iva', 'ret_10', 'ret_20', 'ret_30', 'ret_70', 'ret_100'   )->where('retencioniva_id',  $r->id)->get();
                $venta = Retencionivaventa::select('fecha_v','detalle','cliente','base_im','porcentaje', 'v_retenido', 'iva', 'ret_10', 'ret_20', 'ret_30', 'ret_70', 'ret_100'   )->where('retencioniva_id',  $r->id)->get();

                return response(array(
                    'datos'        => true,
                    'compra'       => $compra, 
                    'venta'        => $venta, 
                    'nombre'       => $r->nombre,
                    'contribuyente'=> $r->contribuyente,
                    'fecha'        => $r->fecha,
                    'ruc'          => $r->ruc,
                    't_ivacompra'  => $r->t_ivacompra,
                    't_ivaventa'   => $r->t_ivaventa,
                    't_reten'      => $r->t_reten,
                    'result_iva'   => $r->result_iva,
                    'total'        => $r->total,
                    
                    ),200,[]);
            }else{
                    return response(array(
                    'datos' => false,
                ),200,[]);

            } //fin else
           
            
            

        } //fin metodo obtener retencion del iva

        public function NominaEmpleado(Request $request){
  
            $id = Auth::id();
            $taller_id      = $request->id;
            $nombre         =$request->nombre;
            $fecha          =$request->fecha;
            $t_nomina       =$request->t_nomina;
           $nomina          =Nominaempleado::where('user_id', $id)->where('taller_id',$taller_id)->count();

           if($nomina ==0){
               $n = new Nominaempleado;
               $n->taller_id      = $taller_id;
               $n->user_id        = $id;
               $n->nombre         = $nombre;
               $n->fecha          = $fecha;
               $n->s_sueldo       =$request->s_sueldo;
               $n->s_sobretiempo  =$request->s_sobretiempo;
               $n->s_tingreso     =$request->s_tingreso;
               $n->s_iess         =$request->s_iess;
               $n->s_piess        =$request->s_piess;
               $n->s_pcias        =$request->s_pcias;
               $n->s_anticipo     =$request->s_anticipo;
               $n->s_impr         =$request->s_impr;
               $n->s_tegresos     =$request->s_tegresos;
               $n->s_netopagar    =$request->s_netopagar;
               $n->save();

               $no = Nominaempleado::where('user_id', $id)->get()->last();
               
               foreach($t_nomina as $key=>$d){
                   $datos = array (
                        'nominaempleado_id' =>$no->id,
                        'nombre_e'         =>$d['nombre_e'],
                        'cargo'            =>$d['cargo'],
                        'sueldo'           =>$d['sueldo'],
                        's_tiempo'         =>$d['s_tiempo'],
                        'ingresos'         =>$d['ingresos'],
                        'iees'             =>$d['iees'],
                        'pres_iees'        =>$d['pres_iees'],
                        'pres_cia'         =>$d['pres_cia'],
                        'anticipo'         =>$d['anticipo'],
                        'imp_renta'        =>$d['imp_renta'],
                        'egresos'          =>$d['egresos'],
                        'neto_pagar'       =>$d['neto_pagar'],
                        'created_at'        => now(),
                        'updated_at'        => now(),
                   );
                   Movimientonomina::insert($datos);
               } //end foreach
               return response(array(
                'success' => true,
                'estado'  => 'guardado',
                'message' => 'Anexo Nómina Empleados creado correctamente'
            ),200,[]);    
               
           } elseif($nomina==1){

            $ids=[];
            $n = Nominaempleado::where('user_id', $id)->where('taller_id',$taller_id)->first();     
            $n->nombre         = $nombre;
            $n->fecha          = $fecha;
            $n->s_sueldo       =$request->s_sueldo;
            $n->s_sobretiempo  =$request->s_sobretiempo;
            $n->s_tingreso     =$request->s_tingreso;
            $n->s_iess         =$request->s_iess;
            $n->s_piess        =$request->s_piess;
            $n->s_pcias        =$request->s_pcias;
            $n->s_anticipo     =$request->s_anticipo;
            $n->s_impr         =$request->s_impr;
            $n->s_tegresos     =$request->s_tegresos;
            $n->s_netopagar    =$request->s_netopagar;
            $n->save();

            $o = Movimientonomina::where('nominaempleado_id',$n->id)->get();

            foreach($o as $i){
                $ids[]=$i->id;
            }
            $detelemovimientonomina = Movimientonomina::destroy($ids);

            $new = Nominaempleado::where('user_id', $id)->get()->last();

            foreach($t_nomina as $key=>$d){
                $datos = array (
                     'nominaempleado_id' =>$new->id,
                     'nombre_e'         =>$d['nombre_e'],
                     'cargo'            =>$d['cargo'],
                     'sueldo'           =>$d['sueldo'],
                     's_tiempo'         =>$d['s_tiempo'],
                     'ingresos'         =>$d['ingresos'],
                     'iees'             =>$d['iees'],
                     'pres_iees'        =>$d['pres_iees'],
                     'pres_cia'         =>$d['pres_cia'],
                     'anticipo'         =>$d['anticipo'],
                     'imp_renta'        =>$d['imp_renta'],
                     'egresos'          =>$d['egresos'],
                     'neto_pagar'       =>$d['neto_pagar'],
                     'created_at'        => now(),
                     'updated_at'        => now(),
                );
                Movimientonomina::insert($datos);
            } //end foreach
            return response(array(
                'success' => true,
                'estado'  => 'actualizado',
                'message' => 'Anexo Retención del Iva Actualizado correctamente'
            ),200,[]);            
     
          } //end elseif
        } //end metodo guardar nomina

        public function obtenerNomina(Request $request){
            $id =Auth::id();
            $taller_id     = $request->id;

            $no = Nominaempleado::where('user_id', $id)->where('taller_id',$taller_id)->count();
            
            if($no == 1){
            
                $n = Nominaempleado::where('user_id', $id)->where('taller_id',$taller_id)->first();
                $m =Movimientonomina::select( 'nombre_e','cargo','sueldo','s_tiempo','ingresos','iees','pres_iees','pres_cia', 'anticipo', 'imp_renta','egresos','neto_pagar')->where('nominaempleado_id',  $n->id)->get();
         
                return response(array(
                    'datos'   => true,
                    'nomina'   => $m, 
                    'nombre'  => $n->nombre,
                    'fecha'   => $n->fecha,
                   
                ),200,[]);
            }else{
                return response(array(
                'datos' => false,
            ),200,[]);

            } //fin else

        }//fin metodo obtener


        public function ProvisionB(Request $request){
 
            $id = Auth::id();
            $taller_id      = $request->id;
            $t_pro          = $request->t_pro;

            $pro = Provisionsocial::where('user_id', $id)->where('taller_id',$taller_id)->count();

            if($pro == 0){

                $p = new Provisionsocial;
                $p->taller_id     = $taller_id;
                $p->user_id       = $id;
                $p->s_valor       = $request->s_valor;
                $p->s_tercero     = $request->s_tercero;
                $p->s_cuarto      = $request->s_cuarto;
                $p->s_vacaciones  = $request->s_vacaciones;
                $p->s_res         = $request->s_res;
                $p->save();
                
                $po = Provisionsocial::where('user_id', $id)->get()->last();

                foreach($t_pro as $key=>$m){
                    $datos = array (
                     'provisionsocial_id' =>$po->id,
                     'nombre_em'          =>$m['nombre_em'],
                     'dias'               =>$m['dias'],
                     'v_recibido'         =>$m['v_recibido'],
                     'd_tercero'          =>$m['d_tercero'],
                     'd_cuarto'           =>$m['d_cuarto'],
                     'vacaciones'         =>$m['vacaciones'],
                     'f_reserva'          =>$m['f_reserva'],
                     'created_at'        => now(),
                     'updated_at'        => now(),
              
                
                    );
                    Movimientoprovision::insert($datos);
                } //endforeach
                return response(array(
                    'success' => true,
                    'estado'  => 'guardado',
                    'message' => 'Anexo Provision de Beneficio Social creado correctamente'
                ),200,[]);    
            
            } elseif($pro == 1){
                $ids=[];
                $p = Provisionsocial::where('user_id', $id)->where('taller_id',$taller_id)->first();     
                $p->taller_id     = $taller_id;
                $p->user_id       = $id;
                $p->s_valor       = $request->s_valor;
                $p->s_tercero     = $request->s_tercero;
                $p->s_cuarto      = $request->s_cuarto;
                $p->s_vacaciones  = $request->s_vacaciones;
                $p->s_res         = $request->s_res;
                $p->save();

                $mp = Movimientoprovision::where('provisionsocial_id',$p->id)->get();
                foreach($mp as $i){
                    $ids[]=$i->id;
                }
                $detelemovimientoprovision = Movimientoprovision::destroy($ids);

                $new = Provisionsocial::where('user_id', $id)->get()->last();

                foreach($t_pro as $key=>$m){
                    $datos = array (
                     'provisionsocial_id' =>$new->id,
                     'nombre_em'          =>$m['nombre_em'],
                     'dias'               =>$m['dias'],
                     'v_recibido'         =>$m['v_recibido'],
                     'd_tercero'          =>$m['d_tercero'],
                     'd_cuarto'           =>$m['d_cuarto'],
                     'vacaciones'         =>$m['vacaciones'],
                     'f_reserva'          =>$m['f_reserva'],
                     'created_at'        => now(),
                     'updated_at'        => now(),
                    
                    );
                    Movimientoprovision::insert($datos);
                } //endforeach
                return response(array(
                    'success' => true,
                    'estado'  => 'actualizado',
                    'message' => 'Anexo Provision de Beneficio Social Actualizado correctamente'
                ),200,[]);  
            }//endelseif           
        }//fin metodo provision


        public function ObtenerProvison(Request $request){

            $id =Auth::id();
            $taller_id     = $request->id;
            $no = Provisionsocial::where('user_id', $id)->where('taller_id',$taller_id)->count();

            if($no == 1){

                $n = Provisionsocial::where('user_id', $id)->where('taller_id',$taller_id)->first();
                $m = Movimientoprovision::select( 'nombre_em','dias','v_recibido','d_tercero','d_cuarto','vacaciones','f_reserva')->where('provisionsocial_id',  $n->id)->get();
          
                return response(array(
                    'datos'   => true,
                    'pro'   => $m, 
                  
                   
                ),200,[]);         
            }else{
                return response(array(
                'datos' => false,
            ),200,[]);

            } //fin else

        }//end provision obtener

}