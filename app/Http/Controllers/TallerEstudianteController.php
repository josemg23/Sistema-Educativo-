<?php

namespace App\Http\Controllers;

use App\Admin\PlanCuenta;
use App\Admin\PlanCuentaRespuesta;
use App\Admin\Respuesta\Abreviatura;
use App\Admin\Respuesta\AbreviaturaCarta;
use App\Admin\Respuesta\AbreviaturaEconomica;
use App\Admin\Respuesta\AbreviaturaEditorial;
use App\Admin\Respuesta\AbreviaturaRe;
use App\Admin\Respuesta\Activo4;
use App\Admin\Respuesta\AlternativaCorrecta;
use App\Admin\Respuesta\AlternativaCorrectaRes;
use App\Admin\Respuesta\AnalizarPregunta;
use App\Admin\Respuesta\AnalizarPreguntaDato;
use App\Admin\Respuesta\Celda;
use App\Admin\Respuesta\CeldaClasificado;
use App\Admin\Respuesta\CertificadoDeposito;
use App\Admin\Respuesta\Cheque;
use App\Admin\Respuesta\ChequeEndoso;
use App\Admin\Respuesta\Circulo;
use App\Admin\Respuesta\Collage;
use App\Admin\Respuesta\CollageImg;
use App\Admin\Respuesta\Completar;
use App\Admin\Respuesta\CompletarEnunciado;
use App\Admin\Respuesta\CompletarEnunciadoRes;
use App\Admin\Respuesta\ConvertirCheque;
use App\Admin\Respuesta\DefinirEnunciado;
use App\Admin\Respuesta\DefinirEnunciadoRe;
use App\Admin\Respuesta\Diferencia;
use App\Admin\Respuesta\EscribirCuenta;
use App\Admin\Respuesta\Factura;
use App\Admin\Respuesta\FacturaDato;
use App\Admin\Respuesta\FormulasContable;
use App\Admin\Respuesta\Gusanillo;
use App\Admin\Respuesta\IdenTrasa;
use App\Admin\Respuesta\IdenTrasaDato;
use App\Admin\Respuesta\Identificar;
use App\Admin\Respuesta\IdentificarAbreviatura;
use App\Admin\Respuesta\IdentificarImgRes;
use App\Admin\Respuesta\IdentificarPersona;
use App\Admin\Respuesta\Lectura;
use App\Admin\Respuesta\LecturaDato;
use App\Admin\Respuesta\LetraCambio;
use App\Admin\Respuesta\MapaConceptual2;
use App\Admin\Respuesta\MapaConceptual;
use App\Admin\Respuesta\NotaPedido;
use App\Admin\Respuesta\NotaPedidoRe;
use App\Admin\Respuesta\NotaVenta;
use App\Admin\Respuesta\NotaVentaDato;
use App\Admin\Respuesta\OrdenIdea;
use App\Admin\Respuesta\OrdenIdeasDato;
use App\Admin\Respuesta\OrdenPago;
use App\Admin\Respuesta\PDDebe;
use App\Admin\Respuesta\PDHaber;
use App\Admin\Respuesta\Pagare;
use App\Admin\Respuesta\Palabra;
use App\Admin\Respuesta\PartidaDoble;
use App\Admin\Respuesta\PartidaDobleRegis;
use App\Admin\Respuesta\Pasivo4;
use App\Admin\Respuesta\Patrimonio4;
use App\Admin\Respuesta\Pregunta;
use App\Admin\Respuesta\RAlternativa;
use App\Admin\Respuesta\Recibo;
use App\Admin\Respuesta\Relacionar2;
use App\Admin\Respuesta\Relacionar2Re;
use App\Admin\Respuesta\Relacionar;
use App\Admin\Respuesta\RelacionarRe;
use App\Admin\Respuesta\RuedaLogica;
use App\Admin\Respuesta\Subrayar;
use App\Admin\Respuesta\SubrayarRes;
use App\Admin\Respuesta\TipoSaldo;
use App\Admin\Respuesta\TipoSaldoDato;
use App\Admin\Respuesta\ValeCaja;
use App\Admin\Respuesta\VerdaderoFalso;
use App\Admin\Respuesta\VerdaderoFalsoRe;
use App\Admin\Taller2Relacionar;
use App\Admin\TallerALectura;
use App\Admin\TallerAbreviatura;
use App\Admin\TallerAnalizar;
use App\Admin\TallerCelda;
use App\Admin\TallerCertificadoDeposito;
use App\Admin\TallerCheque;
use App\Admin\TallerChequeEndoso;
use App\Admin\TallerCirculo;
use App\Admin\TallerCollage;
use App\Admin\TallerCompletar;
use App\Admin\TallerCompletarEnunciado;
use App\Admin\TallerContabilidad;
use App\Admin\TallerContabilidadOp;
use App\Admin\TallerConvertirCheque;
use App\Admin\TallerDefinirEnunciado;
use App\Admin\TallerDiferencia;
use App\Admin\TallerEscribirCuenta;
use App\Admin\TallerFactura;
use App\Admin\TallerGusanillo;
use App\Admin\TallerIdenTransa;
use App\Admin\TallerIdentificarImagen;
use App\Admin\TallerIdentificarPersona;
use App\Admin\TallerLetraCambio;
use App\Admin\TallerMConceptual;
use App\Admin\TallerNotaPedido;
use App\Admin\TallerNotaVenta;
use App\Admin\TallerOrdenIdea;
use App\Admin\TallerOrdenPago;
use App\Admin\TallerPagare;
use App\Admin\TallerPalabra;
use App\Admin\TallerPregunta;
use App\Admin\TallerRAlternativa;
use App\Admin\TallerRecibo;
use App\Admin\TallerRelacionar;
use App\Admin\TallerRelacionarOpcion;
use App\Admin\TallerSenalar;
use App\Admin\TallerSopaLetra;
use App\Admin\TallerSubrayar;
use App\Admin\TallerTipoSaldo;
use App\Admin\TallerValeCaja;
use App\Admin\TallerVerdaderoFalso;
use App\Contenido;
use App\Materia;
use App\PartidaDobleEstado;
use App\RArchivo;
use App\RespuestaArchivo;
use App\Taller;
use App\TallerArchivo;
use App\TallerChequeRe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JavaScript;

class TallerEstudianteController extends Controller
{
     public function taller($plant, $id){
        $d = $id;
        $resp= auth()->user()->tallers->where('id', $id)->count();
     if ($resp >= 1) {
        return abort(404); 
     }else{
        if ($plant == 1) {
            $consul = Taller::findorfail($id);    
            $datos = Completar::where('taller_id', $consul->id)->firstOrfail();
            return view('talleres.taller1', compact('datos', 'd'));
        }elseif ($plant == 2) {

            $consul = Taller::findorfail($id);
             $datos = TallerClasificar::where('taller_id', $consul->id)->firstOrfail();
            return view('talleres.taller2', compact('datos', 'd'));

        }elseif ($plant == 3) {
            $consul = Taller::findorfail($id);
             $datos = TallerCompletarEnunciado::where('taller_id', $consul->id)->firstOrfail();  
               if ($consul->plantilla_id == $plant && $consul->id == $id) {
                // return $datos->completarEnlist;
                 return view('talleres.taller3', compact('datos', 'd', 'consul'));
             }else {
            return abort(404);   
             }

        }elseif ($plant == 4) {
            $consul = Taller::findorfail($id);
             $datos = TallerDiferencia::where('taller_id', $consul->id)->firstOrfail();
            return view('talleres.taller4', compact('datos', 'd'));



        }elseif ($plant == 5) {
            $consul = Taller::findorfail($id);
             $datos = TallerSenalar::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller5', compact('datos', 'd' ));


        }elseif ($plant == 6) {
            $i= 0;
            $consul = Taller::findorfail($id);
             $datos = TallerIdentificarImagen::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller6', compact('datos', 'd', 'i'));

        }elseif ($plant == 7) {

            $consul = Taller::findorfail($id);
             $datos = TallerGusanillo::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller7', compact('datos', 'd'));

        }elseif ($plant == 8) {
            $consul = Taller::findorfail($id);
             $datos = TallerCirculo::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller8', compact('datos', 'd'));


        }elseif ($plant == 9) {
            $consul = Taller::findorfail($id);
             $datos = TallerSubrayar::where('taller_id', $consul->id)->firstOrFail(); 

            return view('talleres.taller9', compact('datos', 'd'));

        }elseif ($plant == 10) {
            // $d= 0;
            $i= 0;

            $consul = Taller::findorfail($id);
             $datos = TallerRelacionar::where('taller_id', $consul->id)->firstOrfail();
            return view('talleres.taller10', compact('datos', 'd', 'i'));


        }elseif ($plant == 11) {
            // $d= 0;
            $i= 0;
            $consul = Taller::findorfail($id);
             $datos = Taller2Relacionar::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller11', compact('datos', 'd'));


        }elseif ($plant == 12) {

            $consul = Taller::findorfail($id);
            $datos = TallerVerdaderoFalso::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller12', compact('datos', 'd'));

        }elseif ($plant == 13) {

            $consul = Taller::findorfail($id);
            $datos = TallerDefinirEnunciado::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller13', compact('datos', 'd'));

        }elseif ($plant == 14) {
            $consul = Taller::findorfail($id);
            $datos = TallerIdentificarPersona::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller14', compact('datos', 'd'));

        }elseif ($plant == 15) {
            $consul = Taller::findorfail($id);
             $datos = TallerCheque::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller15', compact('datos', 'd'));

        }elseif ($plant == 16) {
            $consul = Taller::findorfail($id);
             $datos = TallerChequeEndoso::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller16', compact('datos', 'd'));
        }elseif ($plant == 17) {
            $consul = Taller::findorfail($id);
             $datos = TallerConvertirCheque::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller17', compact('datos', 'd'));

        }elseif ($plant == 18) {

            $consul = Taller::findorfail($id);
            $datos = TallerLetraCambio::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller18', compact('datos', 'd'));
        }elseif ($plant == 19) {
            $consul = Taller::findorfail($id);

             $datos = TallerCertificadoDeposito::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller19', compact('datos', 'd'));

        }elseif ($plant == 20) {

            $consul = Taller::findorfail($id);
             $datos = TallerPagare::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller20', compact('datos', 'd'));
        }elseif ($plant == 21) {

            $consul = Taller::findorfail($id);
             $datos = TallerValeCaja::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller21', compact('datos', 'd'));


        }elseif ($plant == 22) {
            $consul = Taller::findorfail($id);
             $datos = TallerNotaPedido::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller22', compact('datos', 'd'));


        }elseif ($plant == 23) {
            $consul = Taller::findorfail($id);
             $datos = TallerRecibo::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller23', compact('datos', 'd'));

        }elseif ($plant == 24) {

            $consul = Taller::findorfail($id);
             $datos = TallerOrdenPago::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller24', compact('datos', 'd'));

        }elseif ($plant == 25) {
            $i= 0;
            $consul = Taller::findorfail($id);
             $datos = TallerFactura::where('taller_id', $consul->id)->firstOrfail();
            return view('talleres.taller25', compact('datos', 'd', 'i'));

        }elseif ($plant == 26) {
             $i= 0;
            $consul = Taller::findorfail($id);
             $datos = TallerNotaVenta::where('taller_id', $consul->id)->firstOrfail();
            return view('talleres.taller26', compact('datos', 'd', 'i'));

        }elseif ($plant == 27) {

            $consul = Taller::findorfail($id);
             $datos = TallerAbreviatura::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller27', compact('datos', 'd'));

        }elseif ($plant == 28) {

            if ($resp >= 1) {
                return abort(404); 
            }else{
              $datos = Taller::findorfail($id);
            
            if ($datos->plantilla_id == $plant && $datos->id = $id) {
                return view('talleres.taller28', compact('datos', 'd'));  
             }else {
                
            return abort(404);   
             }
         }
        }elseif ($plant == 29) {
            $datos = Taller::findorfail($id);
            if ($datos->plantilla_id == $plant && $datos->id = $id) {
                return view('talleres.taller29', compact('datos', 'd'));  
             }else { 
            return abort(404);   
             }

        }elseif ($plant == 30){
            $datos = Taller::findorfail($id);
            if ($datos->plantilla_id == $plant && $datos->id = $id) {
            return view('talleres.taller30', compact('datos', 'd'));  
             }else {
            return abort(404);   
             }
            }elseif ($plant == 31) {

            $consul = Taller::findorfail($id);
             $datos = TallerCollage::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller31', compact('datos', 'd'));

        }elseif ($plant == 32) {
        if ($resp >= 1) {
                return abort(404); 
        }else{
          $datos = Taller::findorfail($id);
            if ($datos->plantilla_id == $plant && $datos->id = $id) {
            return view('talleres.taller32', compact('datos', 'd'));  
             }else {
            return abort(404);   
             }
         }
        }elseif ($plant == 33) {
            $consul = Taller::findorfail($id);
             $datos = TallerCelda::where('taller_id', $consul->id)->firstOrFail();
             $clasificados = TallerCeldaClasificar::where('taller_celda_id', $datos->id)->get();
             $clasificaciones = TallerCeldaClasificacion::where('taller_celda_id', $datos->id)->get();

             // return $clasificaciones;
            return view('talleres.taller33', compact('datos', 'd', 'clasificados', 'clasificaciones'));
        }elseif ($plant == 34) {
            $datos = Taller::findorfail($id);
            if ($datos->plantilla_id == $plant && $datos->id = $id) {
            return view('talleres.taller34', compact('datos', 'd'));  
             }else {
            return abort(404);   
             }
        }elseif ($plant == 35) {
            $datos = Taller::findorfail($id);
            if ($datos->plantilla_id == $plant && $datos->id = $id) {
            return view('talleres.taller35', compact('datos', 'd'));  
             }else {
            return abort(404);   
             }
        }elseif ($plant == 36) {
            $a = 0;
            $consul = Taller::findorfail($id);
            $datos = TallerAnalizar::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller36', compact('datos', 'd', 'a'));

        }elseif ($plant == 37) {
                JavaScript::put([
                 'taller' => $d,
                ]);
            $consul = Taller::findorfail($id);
             $datos = TallerContabilidad::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller37', compact('datos', 'd'));

        }elseif ($plant == 38) {
            $consul = Taller::findorfail($id);
             $datos = TallerALectura::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller38', compact('datos', 'd'));

        }elseif ($plant == 39) {

            $consul = Taller::findorfail($id);
             $datos = TallerPalabra::where('taller_id', $consul->id)->firstOrFail();
             $str = "VUEDRAGGABLES";

            $arr1 = str_split($datos->letra);
            $claves = array_keys($arr1);
            $letra= [];
            shuffle($arr1);
            foreach($claves as $contenido){
                $letra[$contenido] = $arr1[$contenido];
            }
            return view('talleres.taller39', compact('datos', 'd', 'letra'));
        }elseif ($plant == 40) {
            $a = 0;
            $consul = Taller::findorfail($id);
             $datos = TallerIdenTransa::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller40', compact('datos', 'd', 'a'));

        }elseif ($plant == 41) {
            $datos = Taller::findorfail($id);
            if ($datos->plantilla_id == $plant && $datos->id = $id) {
                return view('talleres.taller41', compact('datos', 'd'));  
             }else {
            return abort(404);   
             }
        }elseif ($plant == 42) {
            $datos = Taller::findorfail($id);
            $ideas = TallerOrdenIdea::select('id','idea')->where('taller_id',$id)->get();
            // $ideas = $datos->tallerOrdenIdea;

            if ($datos->plantilla_id == $plant && $datos->id = $id) {
            return view('talleres.taller42', compact('datos', 'd', 'ideas'));  
             }else {
            return abort(404);   
             }
        }elseif ($plant == 43) {
            $consul = Taller::findorfail($id);
             $datos = TallerMConceptual::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller43', compact('datos', 'd'));
        }elseif ($plant == 44) {

            $consul = Taller::findorfail($id);
             $datos = TallerEscribirCuenta::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller44', compact('datos', 'd'));
        }elseif ($plant == 45) {

            $consul = Taller::findorfail($id);
             $datos = TallerSopaLetra::where('taller_id', $consul->id)->firstOrFail();
            $palabras = explode(',', $datos->palabras);
                
            return view('talleres.taller45', compact('datos', 'd', 'palabras'));
        }elseif ($plant == 46) {
              $datos = Taller::findorfail($id);
             // $datos = TallerClasificar::where('taller_id', $consul->id)->firstOrFail();
             if ($datos->plantilla_id == $plant && $datos->id = $id) {
                return view('talleres.taller46', compact('datos', 'd'));  
             }else {
            return abort(404);   
             }
        }elseif ($plant == 47) {
            $consul = Taller::findorfail($id);
             $datos = TallerClasificar::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller47', compact('datos', 'd'));
        }elseif ($plant == 48) {
            $consul = Taller::findorfail($id);
             $datos = TallerClasificar::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller48', compact('datos', 'd'));
        }elseif ($plant == 49) {
            $consul = Taller::findorfail($id);
             $datos = TallerClasificar::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller49', compact('datos', 'd'));
        }elseif ($plant == 50) {
            $consul = Taller::findorfail($id);
             $datos = TallerClasificar::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller50', compact('datos', 'd'));
        }elseif ($plant == 51) {
            $consul = Taller::findorfail($id);
             $datos = TallerClasificar::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller51', compact('datos', 'd'));
        }elseif ($plant == 52) {
            $consul = Taller::findorfail($id);
             $datos = TallerClasificar::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller52', compact('datos', 'd'));
        }elseif ($plant == 53) {
            $consul = Taller::findorfail($id);
             $datos = TallerClasificar::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller53', compact('datos', 'd'));
        }elseif ($plant == 54) {
            $consul = Taller::findorfail($id);
             $datos = TallerClasificar::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller54', compact('datos', 'd'));
        }elseif ($plant == 55) {
            $consul = Taller::findorfail($id);
             $datos = TallerClasificar::where('taller_id', $consul->id)->firstOrFail();
            return view('talleres.taller55', compact('datos', 'd'));
        
        }elseif ($plant == 57) {
            
     
        }
        }
    }
    public function store1(Request $request, $idtaller){
    $id                 =   Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $taller1            =   new Completar; 
    $taller1->taller_id =   $idtaller;
    $taller1->user_id   =   $id;           
    $taller1->enunciado =   $taller->enunciado;           
    $taller1->respuesta =   $request->input('respuesta');   
    $taller1->save();

        $user= User::find($id);

        $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now(), 'fecha_entregado' => now()]);

        foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
     public function store2(Request $request){

        // return $request->datos;
    $id                 =   Auth::id();
    $taller             =   Taller::where('id', $request->id)->firstOrfail();
    $taller2            =   new PartidaDoble; 
    $taller2->taller_id =   $request->id;
    $taller2->user_id   =   $id;           
    $taller2->enunciado =   $taller->enunciado;           
    // $taller2->respuesta =   $request->input('respuesta');   
    $taller2->save();

    $com = PartidaDoble::where('user_id', $id)->get()->last();
    
      foreach ($request->datos as $key=>$v) {
                  $datos=array(
                     'partida_doble_id' => $com->id,
                     'cuenta'           => $v['cuenta'],
                     'total_debe'       => $v['total_debe'],
                     'total_haber'      => $v['total_haber'],
                     'created_at'       => now(),
                     'updated_at'       => now(),
                  );
                  PartidaDobleRegis::insert($datos);
               }
           $registros = $com->pdregistro;
               
          foreach ($request->datos as $key1 =>$debe) {
           
                foreach ($debe['debe'] as $k=>$valores) {
                  $datos=array(
                     'partida_doble_regi_id' => $registros[$key1]->id,
                     'valor'            => $valores['valor'],
                     'created_at'       => now(),
                     'updated_at'       => now(),
                  );
                  PDDebe::insert($datos);
               }

            
                foreach ($debe['haber'] as $s=>$valores2) {
                  $datos2=array(
                     'partida_doble_regi_id' => $registros[$key1]->id,
                     'valor'            => $valores2['valor'],
                     'created_at'       => now(),
                     'updated_at'       => now(),
                  );
                  PDHaber::insert($datos2);
               }
            
           }

           if (isset($request->estado_resultado)) {
                foreach ($request->estado_resultado as $key3=>$estado) {
                  $datos3=array(
                     'partida_doble_id' => $com->id,
                     'descripcion'      => $estado['descripcion'],
                     'saldo1'           => $estado['saldo1'],
                     'saldo2'           => $estado['saldo2'],
                     'created_at'       => now(),
                     'updated_at'       => now(),
                  );
                  PartidaDobleEstado::insert($datos3);
               }
           }
            // $caja                   =   new PartidaDobleRegis; 
            // $caja->partida_doble_id =   $com->id;
            // $caja->cuenta           =   'Caja';           
            // $caja->total_debe       =   $request->caja['total_debe'];           
            // $caja->total_haber      =   $request->caja['total_haber'];           
            // $caja->save();
            // if (count($request->caja['valor_debe']) > 0) {
            //     foreach ($request->caja['valor_debe'] as $k=>$valores) {
            //       $datos=array(
            //          'partida_doble_regi_id' => $caja->id,
            //          'valor'            => $valores,
            //          'created_at'       => now(),
            //          'updated_at'       => now(),
            //       );
            //       PDDebe::insert($datos);
            //    }
            // }
            // if (count($request->caja['valor_haber']) > 0) {
            //     foreach ($request->caja['valor_haber'] as $s=>$valores) {
            //       $datos=array(
            //          'partida_doble_regi_id' => $caja->id,
            //          'valor'            => $valores,
            //          'created_at'       => now(),
            //          'updated_at'       => now(),
            //       );
            //       PDHaber::insert($datos);
            //    }
            // } 
           
        $user= User::find($id);
        $user->tallers()->attach($request->id,['status'=> 'completado' , 'fecha_entregado' => now()]);
        // return redirect()->route('estudiante')->with('datos', 'Datos Enviados Correctamente');
             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
      
        if ($rol == 'estudiante') {
            return response(array(
                'success' => true,
                'rol'     => 'estudiante',
                'id'      => $contenido->materia_id,
            ),200,[]);

        }elseif($rol == 'docente'){
            

            // return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        // return $request->caja['valor_debe'];
        
              return response(array(
                'success' => true,
                'rol'     => 'docente',
                'id'      => $contenido->materia_id,
            ),200,[]);

        }

    }


     public function store3(Request $request, $idtaller){
    $id                 =   Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $taller3 = new CompletarEnunciado; 
    $taller3->taller_id  = $idtaller;
    $taller3->user_id    =    $id;           
    $taller3->enunciado =   $taller->enunciado;                       
    $taller3->save();

    $com = CompletarEnunciado::where('user_id', $id)->get()->last();
           foreach ($request->respuesta as $key=>$v) {
                  $datos=array(
                     'completar_enunciado_id'=> $com->id,
                     'respuesta' => $request->respuesta[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  CompletarEnunciadoRes::insert($datos);
               }
        $user= User::find($id);
        $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

    public function store4(Request $request, $idtaller){
    $id                     =   Auth::id();
    $taller                 =   Taller::where('id', $idtaller)->firstOrfail();
    $taller4                = new Diferencia; 
    $taller4->taller_id     = $idtaller;
    $taller4->user_id       =    $id;           
    $taller4->enunciado     =  $taller->enunciado; 
    $taller4->diferencia_1a =   $request->input('diferencia_1a');   
    $taller4->diferencia_2a =   $request->input('diferencia_2a');   
    $taller4->diferencia_3a =   $request->input('diferencia_3a');   
    $taller4->diferencia_1b =   $request->input('diferencia_1b');   
    $taller4->diferencia_2b =   $request->input('diferencia_2b');   
    $taller4->diferencia_3b =   $request->input('diferencia_3b');   
    $taller4->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
    public function store5(Request $request, $idtaller)
    {
    $id                 =   Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $taller5            = new AlternativaCorrecta; 
    $taller5->taller_id = $idtaller;
    $taller5->user_id   =    $id;           
    $taller5->enunciado =   $taller->enunciado;                       
    $taller5->save();

    $alter =TallerSenalar::where('taller_id', $idtaller)->firstOrfail();
    $com = AlternativaCorrecta::where('user_id', $id)->get()->last();
    $enun = $alter->options;
    $datos = [];

        foreach ($enun as $key => $value) {
                    $datos= array(
                        'alternativa_correcta_id' => $com->id,
                        'concepto' => $value->concepto,
                        'respuesta' => $request->respuesta[$key],
                        'created_at'=> now(),
                        'updated_at'=> now(),
                    );
                    AlternativaCorrectaRes::insert($datos);
                   }    
        $user= User::find($id);
        $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

        public function store6(Request $request, $idtaller)
    {
    $id                 =   Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $taller6            = new Identificar; 
    $taller6->taller_id = $idtaller;
    $taller6->user_id   =    $id;           
    $taller6->enunciado =   $taller->enunciado;                       
    $taller6->save();
    
    $com   = Identificar::where('user_id', $id)->get()->last();

        foreach ($request->imgs as $key => $value) {
                    $datos= array(
                        'identificar_id' => $com->id,
                        'img' => $request->imgs[$key],
                        'created_at'=> now(),
                        'updated_at'=> now(),
                    );
                    IdentificarImgRes::insert($datos);
                   }    
        $user= User::find($id);
        $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

    public function store7(Request $request, $idtaller)
    {
    $id                  = Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $contenido           = TallerGusanillo::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
    $taller7             = new Gusanillo; 
    $taller7->taller_id  = $idtaller;
    $taller7->user_id    =    $id;           
    $taller7->enunciado  =  $contenido->enunciado;                       
    $taller7->respuesta1 =   $request->input('respuesta1');   
    $taller7->respuesta2 =   $request->input('respuesta2');   
    $taller7->respuesta3 =   $request->input('respuesta3');    
    $taller7->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }

    }

    public function store8(Request $request, $idtaller)
    {
    $id                  = Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $contenido           = TallerCirculo::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
    $taller8             = new Circulo; 
    $taller8->taller_id  = $idtaller;
    $taller8->user_id    =   $id;           
    $taller8->enunciado  =  $contenido->enunciado;                       
    $taller8->respuesta1 =   $request->input('respuesta1');   
    $taller8->respuesta2 =   $request->input('respuesta2');   
    $taller8->respuesta3 =   $request->input('respuesta3');    
    $taller8->respuesta4 =   $request->input('respuesta4');    
    $taller8->respuesta5 =   $request->input('respuesta5');    
    $taller8->respuesta6 =   $request->input('respuesta6');    
    $taller8->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

    public function store9(Request $request, $idtaller)
    {
    $id                 =   Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $taller5            = new Subrayar; 
    $taller5->taller_id = $idtaller;
    $taller5->user_id   =    $id;           
    $taller5->enunciado =   $taller->enunciado;                       
    $taller5->save();

    $alter =TallerSubrayar::where('taller_id', $idtaller)->firstOrfail();
    $com = Subrayar::where('user_id', $id)->get()->last();
    $enun = $alter->TallerSubraOps;
    $datos = [];

        foreach ($enun as $key => $value) {
                    $datos= array(
                        'subrayar_id' => $com->id,
                        'concepto' => $value->concepto,
                        'respuesta' => $request->respuesta[$key],
                        'created_at'=> now(),
                        'updated_at'=> now(),
                    );
                    SubrayarRes::insert($datos);
                   }    

        $user= User::find($id);
        $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
        public function store10(Request $request, $idtaller)
    {
           $conteo =count($request->order);
    // foreach ($request->order as  $cd) {
    //     if ($cd > $conteo ) {
    //        return back()->with('datos', 'Los valores no coinciden con los registros');
    //     }
    // }
    $id                  =   Auth::id();
    $taller              =   Taller::where('id', $idtaller)->firstOrfail();
    $taller10            = new Relacionar; 
    $taller10->taller_id = $idtaller;
    $taller10->user_id   =    $id;           
    $taller10->enunciado =   $taller->enunciado;                       
    $taller10->save();
    $alter =TallerRelacionar::where('taller_id', $idtaller)->firstOrfail();
    $com = Relacionar::where('user_id', $id)->get()->last();
    $enun = $alter->relacionarOptions;
    $alter2 = TallerRelacionarOpcion::select('definicion_aleatoria')->where('taller_relacionar_id', $alter->id)->get();
    $datos = [];

      foreach ($request->order as $key2 => $cd) {
        if ($cd > $conteo or null ) {
          $datos[] =  null;
        }else{
           $datos[]= $alter2[$cd - 1]->definicion_aleatoria;
        }
    }
    // return $datos;
        foreach ($datos as $key => $value) {
                    $datos= array(
                        'relacionar_id' => $com->id,
                        'enunciado' => $enun[$key]->enunciado,
                        'definicion' => $enun[$key]->definicion,
                        'img' => $enun[$key]->img,
                        'definicion_aleatoria' => $value,
                        'created_at'=> now(),
                        'updated_at'=> now(),
                    );
                    RelacionarRe::insert($datos);
                   }    
                   
        $user= User::find($id);
        $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
   }

public function store11(Request $request, $idtaller)
    {
    $id                  =   Auth::id();
    $taller              =   Taller::where('id', $idtaller)->firstOrfail();
    $taller11            = new Relacionar2; 
    $taller11->taller_id = $idtaller;
    $taller11->user_id   =    $id;           
    $taller11->enunciado =   $taller->enunciado;                       
    $taller11->save();
    $alter =Taller2Relacionar::where('taller_id', $idtaller)->firstOrfail();
    $com = Relacionar2::where('user_id', $id)->get()->last();
    $enun = $alter->relacionar2Options;
        foreach ($request->letra as $key => $value) {
                        $datos           = array(
                        'relacionar2_id' => $com->id,
                        'letra'          => $value,
                        'definicion'     => $enun[$key]->definicion,
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    );
                    Relacionar2Re::insert($datos);
                   }    
                   
        $user= User::find($id);
        $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
   }

   public function store12(Request $request, $idtaller)
    {

    $id                  =   Auth::id();
    $taller              =   Taller::where('id', $idtaller)->firstOrfail();
    $taller12            = new VerdaderoFalso; 
    $taller12->taller_id = $idtaller;
    $taller12->user_id   =    $id;           
    $taller12->enunciado =   $taller->enunciado;                       
    $taller12->save();
    $alter =TallerVerdaderoFalso::where('taller_id', $idtaller)->firstOrfail();
    $com = VerdaderoFalso::where('user_id', $id)->get()->last();
    $enun = $alter->tallerVerFalOp;
        foreach ($request->respuestas as $key => $value) {
                        $datos               = array(
                        'verdadero_falso_id' => $com->id,
                        'enunciado'          => $enun[$key]->descripcion,
                        'respuesta'          => $value,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    );
                    VerdaderoFalsoRe::insert($datos);
                   }    
                   
        $user= User::find($id);
        $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
   }
    public function store13(Request $request, $idtaller)
    {

    $id                  =   Auth::id();
    $taller              =   Taller::where('id', $idtaller)->firstOrfail();
    $taller13            = new DefinirEnunciado; 
    $taller13->taller_id = $idtaller;
    $taller13->user_id   =    $id;           
    $taller13->enunciado =   $taller->enunciado;                       
    $taller13->save();
    $alter =TallerDefinirEnunciado::where('taller_id', $idtaller)->firstOrfail();
    $com = DefinirEnunciado::where('user_id', $id)->get()->last();
    $enun = $alter->tallerDefinirEnunOp;
        foreach ($request->respuestas as $key => $value) {
                        $datos               = array(
                        'definir_enunciado_id' => $com->id,
                        'concepto'          => $enun[$key]->concepto,
                        'respuesta'          => $value,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    );
                    DefinirEnunciadoRe::insert($datos);
                   }    
                   
        $user= User::find($id);
        $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
   }

      public function store14(Request $request, $idtaller)
    {
        // return $request->personas;
    $id                     = Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $contenido              = TallerIdentificarPersona::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 


    $taller14               = new IdentificarPersona; 
    $taller14->taller_id    =  $idtaller;
    $taller14->user_id      =  $id;           
    $taller14->enunciado    =  $contenido->enunciado;                       
    $taller14->personas     =  json_encode($request->personas);      
    $taller14->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

       public function store15(Request $request, $idtaller)
    {
    $id                  = Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $contenido           = TallerCheque::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
    $taller15            = new Cheque; 
    $taller15->taller_id = $idtaller;
    $taller15->user_id   =   $id;           
    $taller15->enunciado =  $contenido->enunciado;                       
    $taller15->girador   =   $request->input('girador');
    $taller15->girado    =   $request->input('girado');
    $taller15->cantidad  =   $request->input('cantidad');
    $taller15->suma  =   $request->input('suma');
    $taller15->lugar     =   $request->input('lugar');
    $taller15->fecha     =   $request->input('fecha'); 
    $taller15->firma     =   $request->input('firma'); 
    $taller15->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
         public function store16(Request $request, $idtaller)
    {
        $id                  = Auth::id();
        $taller             =   Taller::where('id', $idtaller)->firstOrfail();
        $contenido           = TallerChequeEndoso::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
        $taller16            = new ChequeEndoso; 
        $taller16->taller_id = $idtaller;
        $taller16->user_id   =   $id;           
        $taller16->enunciado =  $contenido->enunciado;                       
        $taller16->endoso        =   $request->input('endoso');
        $taller16->firma        =   $request->input('firma');
        $taller16->firma2        =   $request->input('firma2');
        $taller16->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
         public function store17(Request $request, $idtaller)
    {
        $id                  = Auth::id();
        $taller             =   Taller::where('id', $idtaller)->firstOrfail();
        $contenido           = TallerConvertirCheque::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
        $taller17            = new ConvertirCheque; 
        $taller17->taller_id = $idtaller;
        $taller17->user_id   =   $id;           
        $taller17->enunciado =  $contenido->enunciado;                       
        $taller17->endoso    =   $request->input('endoso');
        $taller17->firma     =   $request->input('firma');
        $taller17->firma2    =   $request->input('firma2');
        $taller17->espacio1  =   $request->input('espacio1');
        $taller17->espacio2  =   $request->input('espacio2');
        $taller17->tipo_cheque  =   $request->input('tipo_cheque');

        $taller17->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
          public function store18(Request $request, $idtaller)
    {
         $id                    = Auth::id();
         $taller             =   Taller::where('id', $idtaller)->firstOrfail();
         $contenido             = TallerLetraCambio::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
         $taller18              = new LetraCambio; 
         $taller18->taller_id   = $idtaller;
         $taller18->user_id     =   $id;           
         $taller18->enunciado   =  $contenido->enunciado;                       
         $taller18->vencimiento =   $request->input('vencimiento');
         $taller18->numero      =   $request->input('numero');
         $taller18->por         =   $request->input('por');
         $taller18->interes     =   $request->input('interes');
         $taller18->desde     =   $request->input('desde');
         $taller18->ciudad      =   $request->input('ciudad');
         $taller18->fecha       =   $request->input('fecha');
         $taller18->orden_de    =   $request->input('orden_de');
         $taller18->cantidad    =   $request->input('cantidad');
         $taller18->direccion   =   $request->input('direccion');
         $taller18->ciudad2     =   $request->input('ciudad2');
         $taller18->atentamente =   $request->input('atentamente');
        $taller18->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
     public function store19(Request $request, $idtaller)
    {
         $id                             = Auth::id();
         $taller             =   Taller::where('id', $idtaller)->firstOrfail();
         $contenido                      = TallerCertificadoDeposito::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
         $taller19                       = new CertificadoDeposito; 
         $taller19->taller_id            = $idtaller;
         $taller19->user_id              =   $id;           
         $taller19->enunciado            =   $contenido->enunciado;                       
         $taller19->valor_inicial        =   $request->input('valor_inicial');
         $taller19->caracter             =   $request->input('caracter');
         $taller19->beneficiario         =   $request->input('beneficiario');
         $taller19->cantidad             =   $request->input('cantidad');
         $taller19->plazo                =   $request->input('plazo');
         $taller19->fecha_de_emision     =   $request->input('fecha_de_emision');
         $taller19->fecha_de_vencimiento =   $request->input('fecha_de_vencimiento');
         $taller19->interes_anual        =   $request->input('interes_anual');
         $taller19->plazo_de_vencimiento =   $request->input('plazo_de_vencimiento');
         $taller19->lugar_fecha_emision  =   $request->input('lugar_fecha_emision');
         // $taller19->firma_uno            =   $request->input('firma_uno');
         // $taller19->firma_dos            =   $request->input('firma_dos');
         $taller19->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

      public function store20(Request $request, $idtaller)
    {
         $id                  = Auth::id();
         $taller             =   Taller::where('id', $idtaller)->firstOrfail();
         $contenido           = TallerPagare::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
         $taller20            = new Pagare; 
         $taller20->taller_id = $idtaller;
         $taller20->user_id   =   $id;           
         $taller20->enunciado =   $contenido->enunciado; 
         $taller20->cantidad        =   $request->input('cantidad');                      
         $taller20->resp1     =   $request->input('resp1');
         $taller20->resp2     =   $request->input('resp2');
         $taller20->resp3     =   $request->input('resp3');
         $taller20->resp4     =   $request->input('resp4');
         $taller20->resp5     =   $request->input('resp5');
         $taller20->resp6     =   $request->input('resp6');
         $taller20->resp7     =   $request->input('resp7');
         $taller20->resp8     =   $request->input('resp8');
         $taller20->resp9     =   $request->input('resp9');
         $taller20->resp10    =   $request->input('resp10');
         $taller20->resp11    =   $request->input('resp11');
         $taller20->resp12    =   $request->input('resp12');
         $taller20->resp13    =   $request->input('resp13');
         $taller20->resp14    =   $request->input('resp14');
         $taller20->resp15    =   $request->input('resp15');
         $taller20->resp16    =   $request->input('resp16');
         $taller20->resp17    =   $request->input('resp17');
         $taller20->resp18    =   $request->input('resp18');
         $taller20->resp19    =   $request->input('resp19');  
         $taller20->resp20    =   $request->input('resp20');  
         $taller20->resp21    =   $request->input('resp21');  
         $taller20->resp22    =   $request->input('resp22');  
         $taller20->resp23    =   $request->input('resp23');  
         $taller20->resp24    =   $request->input('resp24');  
         $taller20->resp25    =   $request->input('resp25');  
         $taller20->resp26    =   $request->input('resp26');  
         $taller20->resp27    =   $request->input('resp27');  
         $taller20->resp28    =   $request->input('resp28');  
         $taller20->resp29    =   $request->input('resp29');  
         $taller20->resp30    =   $request->input('resp30');  
         $taller20->resp31    =   $request->input('resp31');  
         $taller20->resp32    =   $request->input('resp32');  
         $taller20->resp33    =   $request->input('resp33');  
         $taller20->resp34    =   $request->input('resp34');  
         $taller20->resp35    =   $request->input('resp35');  
         $taller20->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

       public function store21(Request $request, $idtaller)
    {
         $id                  = Auth::id();
         $taller             =   Taller::where('id', $idtaller)->firstOrfail();
         $contenido           = TallerValeCaja::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
         $taller21            = new ValeCaja; 
         $taller21->taller_id = $idtaller;
         $taller21->user_id   =   $id;           
         $taller21->enunciado =   $contenido->enunciado; 
         $taller21->por       =   $request->input('por');
         $taller21->deudor    =   $request->input('deudor');
         $taller21->cantidad  =   $request->input('cantidad');
         $taller21->concepto  =   $request->input('concepto');
         $taller21->fecha     =   $request->input('fecha');
         $taller21->vto_bueno =   $request->input('vto_bueno');
         $taller21->conforme  =   $request->input('conforme');
         $taller21->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

    public function store22(Request $request, $idtaller)
    {
    $id                      =   Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $taller                  =   Taller::where('id', $idtaller)->firstOrfail();
    $taller22                = new NotaPedido; 
    $taller22->taller_id     = $idtaller;
    $taller22->user_id       =    $id;           
    $taller22->enunciado     =   $taller->enunciado;                       
    $taller22->pedido        =   $request->pedido;                       
    $taller22->fecha         =   $request->fecha;                       
    $taller22->dependencia   =   $request->dependencia;                       
    $taller22->destino       =   $request->destino;                       
    $taller22->plazo_entrega =   $request->plazo_entrega;                       
    $taller22->observaciones =   $request->observaciones;                       
    $taller22->fabrica       =   $request->fabrica;                       
    $taller22->recibido      =   $request->recibido;                       
    $taller22->save();
            $com = NotaPedido::where('user_id', $id)->get()->last();              
               foreach ($request->cantidad as $key=>$v) {
                  $datos=array(
                     'nota_pedido_id' => $com->id,
                     'cantidad'       => $request->cantidad[$key],
                     'codigo'         => $request->codigo[$key],
                     'descripcion'    => $request->descripcion[$key],
                     'precio_unit'    => $request->precio_unit[$key],
                     'total'          => $request->total[$key],
                     'created_at'     => now(),
                     'updated_at'     => now(),
                  );
                  NotaPedidoRe::insert($datos);
               }        

        $user= User::find($id);
        $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
   }
    public function store23(Request $request, $idtaller)
          {
          $id                  = Auth::id();
          $taller             =   Taller::where('id', $idtaller)->firstOrfail();
          $contenido           = TallerRecibo::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
          $taller23            = new Recibo; 
          $taller23->taller_id = $idtaller;
          $taller23->user_id   =   $id;           
          $taller23->enunciado =   $contenido->enunciado; 
          $taller23->no        =   $request->input('no');
          $taller23->por       =   $request->input('por');
          $taller23->recibi    =   $request->input('recibi');
          $taller23->cantidad  =   $request->input('cantidad');
          $taller23->arriendo  =   $request->input('arriendo');
          $taller23->propiedad =   $request->input('propiedad');
          $taller23->situado   =   $request->input('situado');
          $taller23->hasta     =   $request->input('hasta');
          $taller23->cubierto  =   $request->input('cubierto');
          $taller23->espacio   =   $request->input('espacio');
          $taller23->firma     =   $request->input('firma');
          $taller23->ocupa     =   $request->input('ocupa');
            $taller23->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

     public function store24(Request $request, $idtaller)
          {
            $id                   = Auth::id();
            $taller             =   Taller::where('id', $idtaller)->firstOrfail();
            $contenido            = TallerOrdenPago::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
            $taller24             = new OrdenPago; 
            $taller24->taller_id  = $idtaller;
            $taller24->user_id    =   $id;           
            $taller24->enunciado  =   $contenido->enunciado; 
            $taller24->señor      =  $request->input('señor');
            $taller24->fecha      =  $request->input('fecha');
            $taller24->fecha_c    =  $request->input('fecha_c');
            $taller24->numero     =  $request->input('numero');
            $taller24->tipo       =  $request->input('tipo');
            $taller24->debe       =  $request->input('debe');
            $taller24->haber      =  $request->input('haber');
            $taller24->saldo      =  $request->input('saldo');
            $taller24->revisado   =  $request->input('revisado');
            $taller24->autorizado =  $request->input('autorizado');
            $taller24->vto_bueno  =  $request->input('vto_bueno');
            $taller24->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
       public function store25(Request $request, $idtaller)
          {
               $id                         = Auth::id();
               $taller             =   Taller::where('id', $idtaller)->firstOrfail();
               $contenido                  = TallerFactura::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
               $taller25                   = new Factura; 
               $taller25->taller_id        = $idtaller;
               $taller25->user_id          =   $id;           
               $taller25->enunciado        =   $contenido->enunciado; 
               $taller25->nombre           =  $request->input('nombre');
               $taller25->fecha_emision    =  $request->input('fecha_emision');
               $taller25->ruc              =  $request->input('ruc');
               $taller25->direccion        =  $request->input('direccion');
               $taller25->telefono         =  $request->input('telefono');
               $taller25->email            =  $request->input('email');
               $taller25->subtotal_12      =  $request->input('subtotal_12');
               $taller25->subtotal_0       =  $request->input('subtotal_0');
               $taller25->subtotal_iva     =  $request->input('subtotal_iva');
               $taller25->subtotal_siniva  =  $request->input('subtotal_siniva');
               $taller25->subtotal_sin_imp =  $request->input('subtotal_sin_imp');
               $taller25->descuento_total  =  $request->input('descuento_total');
               $taller25->ice              =  $request->input('ice');
               $taller25->emision              =  $request->input('emision');
               $taller25->iva12            =  $request->input('iva12');
               $taller25->irbpnr           =  $request->input('irbpnr');
               $taller25->propina          =  $request->input('propina');
               $taller25->valor_total      =  $request->input('valor_total');
               $taller25->save();

               if ($taller25 = true) {

               $o = Factura::where('user_id', $id)->get()->last();              
              foreach ($request->codigo as $key=>$v) {
                     $datos                 =array(
                     'factura_id' => $o->id,
                     'codigo'               => $request->codigo[$key],
                     'cod_aux'              => $request->cod_aux[$key],
                     'cantidad'             => $request->cantidad[$key],
                     'precio'               => $request->precio[$key],
                     'descripcion'           => $request->descripcion[$key],
                     'descuento'            => $request->descuento[$key],
                     'valor'                => $request->valor[$key],
                     'created_at'           => now(),
                     'updated_at'           => now(),
                     );
                  FacturaDato::insert($datos);
               }
        }

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

        public function store26(Request $request, $idtaller)
          {
                   $id                  = Auth::id();
                   $taller             =   Taller::where('id', $idtaller)->firstOrfail();
                   $contenido           = TallerNotaVenta::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
                   $taller26            = new NotaVenta; 
                   $taller26->taller_id = $idtaller;
                   $taller26->user_id   =   $id;           
                   $taller26->enunciado =   $contenido->enunciado; 
                   $taller26->nombre    =  $request->input('nombre');
                   $taller26->ruc       =  $request->input('ruc');
                   $taller26->fecha     =  $request->input('fecha');
                   $taller26->total     =  $request->input('total');
                    $taller26->save();



               if ($taller26 = true) {

               $o = NotaVenta::where('user_id', $id)->get()->last();              
              foreach ($request->cantidad as $key=>$v) {
                     $datos                 =array(
                     'nota_venta_id'=> $o->id,
                     'cantidad' => $request->cantidad[$key],
                     'descripcion' => $request->descripcion[$key],
                     'precio' => $request->precio[$key],
                     'valor_venta' => $request->valor_venta[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                     );
                  NotaVentaDato::insert($datos);
               }
        }


    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

     public function store27(Request $request, $idtaller)
          {
                   $id                  = Auth::id();
                   $taller             =   Taller::where('id', $idtaller)->firstOrfail();
                   $contenido           = TallerAbreviatura::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
                   $taller27            = new Abreviatura; 
                   $taller27->taller_id = $idtaller;
                   $taller27->user_id   =   $id;           
                   $taller27->enunciado =   $contenido->enunciado; 
                    $taller27->save();
                $alter =TallerAbreviatura::where('taller_id', $idtaller)->firstOrfail();
                $enun = $alter->abreviaturaImg;
               if ($taller27 = true) {
               $o = Abreviatura::where('user_id', $id)->get()->last();              
              foreach ($enun as $key=>$v) {
                     $datos                 =array(
                     'abreviatura_id' => $o->id,
                     'col_a'                    => $v->col_a,
                     'col_a_res'                => $request->col_a[$key],
                     'col_b'                    => $v->col_b,
                     'col_b_res'                => $request->col_b[$key],
                     'created_at'               => now(),
                     'updated_at'               => now(),
                     );
                  AbreviaturaRe::insert($datos);
               }
        }
    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }


    public function store28(Request $request, $idtaller){
    $id                     =   Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $taller28               =   new IdentificarAbreviatura; 
    $taller28->taller_id    =   $idtaller;
    $taller28->user_id      =   $id;           
    $taller28->enunciado    =  'EN EL PRESENTE TEXTO IDENTIFIQUE LAS ABREVIATURAS COMERCIALES Y ESCRÍBALAS EN LA SIGUIENTE CARTA, EFICAZMENTE.'; 
    $taller28->abreviatura1 =   $request->input('abreviatura1');   
    $taller28->abreviatura2 =   $request->input('abreviatura2');   
    $taller28->abreviatura3 =   $request->input('abreviatura3');   
    $taller28->abreviatura4 =   $request->input('abreviatura4');   
    $taller28->abreviatura5 =   $request->input('abreviatura5');   
    $taller28->abreviatura6 =   $request->input('abreviatura6');   
    $taller28->abreviatura7 =   $request->input('abreviatura7');   
    $taller28->abreviatura8 =   $request->input('abreviatura8');   
    $taller28->save();

    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);

         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

    public function store29(Request $request, $idtaller){
    $id                      = Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $taller29                =   new AbreviaturaCarta; 
    $taller29->taller_id     =   $idtaller;
    $taller29->user_id       =   $id;           
    $taller29->enunciado     =  'UTILIZA LAS ABREVIATURAS COMERCIALES EN LA CARTA, CORRECTAMENTE'; 
    $taller29->abreviatura1  =   $request->input('abreviatura1');   
    $taller29->abreviatura2  =   $request->input('abreviatura2');   
    $taller29->abreviatura3  =   $request->input('abreviatura3');   
    $taller29->abreviatura4  =   $request->input('abreviatura4');   
    $taller29->abreviatura5  =   $request->input('abreviatura5');   
    $taller29->abreviatura6  =   $request->input('abreviatura6');   
    $taller29->abreviatura7  =   $request->input('abreviatura7');   
    $taller29->abreviatura8  =   $request->input('abreviatura8');   
    $taller29->abreviatura9  =   $request->input('abreviatura9');   
    $taller29->abreviatura10 =   $request->input('abreviatura10');   
    $taller29->abreviatura11 =   $request->input('abreviatura11');   
    $taller29->abreviatura12 =   $request->input('abreviatura12');   
    $taller29->abreviatura13 =   $request->input('abreviatura13');   
    $taller29->abreviatura14 =   $request->input('abreviatura14');   
    $taller29->save();

    $user= User::find($id);

    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);

         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
    public function store30(Request $request, $idtaller){
    $id                      = Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $taller30                =   new AbreviaturaEditorial; 
    $taller30->taller_id     =   $idtaller;
    $taller30->user_id       =   $id;           
    $taller30->enunciado     =  'LOCALIZA LAS ABREVIATURAS EN EL EDITORIAL Y ESCRIBE EL SIGNIFICADO EN EL SIGUIENTE PÁRRAFO, CORRECTAMENTE.'; 
    $taller30->abreviatura1  =   $request->input('abreviatura1');   
    $taller30->abreviatura2  =   $request->input('abreviatura2');   
    $taller30->abreviatura3  =   $request->input('abreviatura3');   
    $taller30->abreviatura4  =   $request->input('abreviatura4');   
    $taller30->abreviatura5  =   $request->input('abreviatura5');   
    $taller30->abreviatura6  =   $request->input('abreviatura6');   
    $taller30->abreviatura7  =   $request->input('abreviatura7');   
    $taller30->abreviatura8  =   $request->input('abreviatura8');   
    $taller30->abreviatura9  =   $request->input('abreviatura9');   
    $taller30->abreviatura10 =   $request->input('abreviatura10');   
    $taller30->abreviatura11 =   $request->input('abreviatura11');   
    $taller30->save();

    $user= User::find($id);

    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);

         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

        public function store31(Request $request, $idtaller)
          {
            $id                   = Auth::id();
            $contenido            = TallerCollage::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
            $count = Collage::where('user_id', $id)->where('taller_id', $idtaller)->count(); 
            if ($count == 0) {
                $taller31                                    = new Collage; 
                $taller31->taller_id                         = $idtaller;
                $taller31->user_id                           = $id;           
                $taller31->enunciado                         = $contenido->enunciado; 
                $taller31->save();
                $user                                        = User::find($id);
                $user->tallers()->attach($idtaller,['status' => 'completado' , 'fecha_entregado' => now()]);

                $id                                          = Collage::where('user_id', $id)->where('taller_id', $idtaller)->first();
                $imagen = $request->file('file');
                $nombre                                      = time().'_'.$imagen->getClientOriginalName();
                $ruta                                        = public_path().'/img/talleres';
                $imagen->move($ruta, $nombre);
                $urlimagen                                   = '/img/talleres/'.$nombre;
                $taller_31                                   = new CollageImg; 
                $taller_31->collage_id                       =  $id->id;
                $taller_31->url_img                          =  $urlimagen; 
                $taller_31->save();
                return $taller_31;
            }else {
                $id                                          = Collage::where('user_id', $id)->where('taller_id', $idtaller)->first();
                $imagen = $request->file('file');
                $nombre                                      = time().'_'.$imagen->getClientOriginalName();
                $ruta                                        = public_path().'/img/talleres';
                $imagen->move($ruta, $nombre);
                $urlimagen                                   = '/img/talleres/'.$nombre;

                $taller_31                                   = new CollageImg; 
                $taller_31->collage_id                       =  $id->id;
                $taller_31->url_img                          =  $urlimagen; 
                $taller_31->save();
                return $taller_31;
            }
    }

     public function store32(Request $request, $idtaller){
    $id                      = Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $taller32                =   new AbreviaturaEconomica; 
    $taller32->taller_id     =   $idtaller;
    $taller32->user_id       =   $id;           
    $taller32->enunciado     =  'ESCRIBA EN EL GUSANILLO ABREVIATURAS ECONÓMICAS SEGÚN EL ORDEN QUE SE INDICA EN FORMA CORRECTA.'; 
    $taller32->abreviaturaI1 =   $request->input('abreviaturaI1');   
    $taller32->abreviaturaI2 =   $request->input('abreviaturaI2');   
    $taller32->abreviaturaI3 =   $request->input('abreviaturaI3');   
    $taller32->abreviaturaI4 =   $request->input('abreviaturaI4');   
    $taller32->abreviaturaI5 =   $request->input('abreviaturaI5');   
    $taller32->abreviaturaC1 =   $request->input('abreviaturaC1');   
    $taller32->abreviaturaC2 =   $request->input('abreviaturaC2');   
    $taller32->abreviaturaC3 =   $request->input('abreviaturaC3');   
    $taller32->abreviaturaC4 =   $request->input('abreviaturaC4');   
    $taller32->abreviaturaC5 =   $request->input('abreviaturaC5');   
    $taller32->abreviaturaR1 =   $request->input('abreviaturaR1');   
    $taller32->abreviaturaR2 =   $request->input('abreviaturaR2');   
    $taller32->abreviaturaR3 =   $request->input('abreviaturaR3');   
    $taller32->abreviaturaR4 =   $request->input('abreviaturaR4');   
    $taller32->abreviaturaR5 =   $request->input('abreviaturaR5');   
    $taller32->save();

    $user= User::find($id);

    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);

         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

    public function store35(Request $request, $idtaller){

    // return $request->respuesta;
    $id                    = Auth::id();
    $taller                =   Taller::where('id', $idtaller)->firstOrfail();
    $taller35              =   new FormulasContable; 
    $taller35->taller_id   =   $idtaller;
    $taller35->user_id     =   $id;           
    $taller35->enunciado   =  'DESARROLLE FÓRMULAS DE LA ECUACIÓN CONTABLE, CON EXACTITUD'; 
    $taller35->respuestas  =   json_encode($request->respuesta);   
    // $taller35->formula2 =   $request->input('formula2');   
    // $taller35->formula3 =   $request->input('formula3');   
    // $taller35->formula4 =   $request->input('formula4');   
    // $taller35->formula5 =   $request->input('formula5');   
    // $taller35->formula6 =   $request->input('formula6');   
    // $taller35->formula7 =   $request->input('formula7');   
    // $taller35->formula8 =   $request->input('formula8');   
    // $taller35->formula9 =   $request->input('formula9');   
    $taller35->save();

    $user= User::find($id);

    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);

         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
        public function store33(Request $request, $idtaller)
          {
            // return $request->all();
            $id                   = Auth::id();
            $taller             =   Taller::where('id', $idtaller)->firstOrfail();
            $contenido            = TallerCelda::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
            $taller33             = new Celda; 
            $taller33->taller_id  = $idtaller;
            $taller33->user_id    =   $id;           
            $taller33->enunciado  =   $contenido->enunciado; 
            $taller33->save();

            if ($taller33 = true) {
                $celda = TallerCelda::where('taller_id', $idtaller)->firstOrFail();
                $c = Celda::where('user_id', $id)->get()->last();  
                $clasificaciones = $celda->celdaClasificados;

                foreach ($clasificaciones as $key => $value) {                         //RECORRER TODOS LOS REGISTROS EN EL ARRAY
                   $regis=array(
                     'celda_id'  => $c->id,
                     'taller_celda_clasificacion_id'  => $request->clasificacion[$key],
                     'nombre'  => $clasificaciones[$key]->clasificados,
                     'created_at' => now(),
                     'updated_at' => now(),
                    );
            CeldaClasificado::insert($regis);                           //GUARDAR CADA REGISTRO EN LA BASE DE DATOS
        }

            }
        $user= User::find($id);
        $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
        public function store34(Request $request, $idtaller)
          {
        $id                  = Auth::id();
        $taller              = Taller::where('id', $idtaller)->firstOrfail();
        $contenido           = TallerTipoSaldo::where('taller_id', $idtaller)->get();
        $taller33            = new TipoSaldo;
        $taller33->taller_id = $idtaller;
        $taller33->user_id   =   $id;           
        $taller33->enunciado =   $taller->enunciado;
        $taller33->save(); 
        $a = TipoSaldo::where('user_id', $id)->get()->last();              

        foreach ($contenido as $key => $value) {                         //RECORRER TODOS LOS REGISTROS EN EL ARRAY
            $regis=array(
                     'tipo_saldo_id' => $a->id,
                     'pregunta'      => $contenido[$key]->id,
                     'respuesta'     => $request->saldo[$key],
                     'total_debe'    => $request->total_debe[$key],
                     'total_haber'   => $request->total_haber[$key],
                     'created_at'    => now(),
                     'updated_at'    => now(),
                  );
            TipoSaldoDato::insert($regis);                           //GUARDAR CADA REGISTRO EN LA BASE DE DATOS
        }
        $user= User::find($id);
        $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
     public function store36(Request $request, $idtaller)
          {
               $id                  = Auth::id();
               $taller             =   Taller::where('id', $idtaller)->firstOrfail();
               $contenido           = TallerAnalizar::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
               $taller36            = new AnalizarPregunta; 
               $taller36->taller_id = $idtaller;
               $taller36->user_id   =   $id;           
               $taller36->enunciado =   $contenido->enunciado; 
                $taller36->save();
                $alter =TallerAnalizar::where('taller_id', $idtaller)->firstOrfail();
                $enun = $alter->tallerAnalizarOp;
               if ($taller36 = true) {
               $o = AnalizarPregunta::where('user_id', $id)->get()->last();              
              foreach ($enun as $key=>$v) {
                     $datos                 =array(
                     'analizar_pregunta_id' => $o->id,
                     'enunciado'             => $v->enunciado,
                     'respuesta'            => $request->analisis[$key],
                     'created_at'           => now(),
                     'updated_at'           => now(),
                     );
                  AnalizarPreguntaDato::insert($datos);
               }
        }
    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
    public function store37(Request $request, $idtaller)
        {
            $id   = Auth::id();
            $taller = Taller::where('id', $idtaller)->firstOrfail();

            $user = User::find($id);
            $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
            
        foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        

        if ($rol == 'estudiante') {
            return response(array(
                'success' => true,
                'rol'     => 'estudiante',
                'id'      => $contenido->materia_id,
            ),200,[]);

        }elseif($rol == 'docente'){
            

            // return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        // return $request->caja['valor_debe'];
        
              return response(array(
                'success' => true,
                'rol'     => 'docente',
                'id'      => $contenido->materia_id,
            ),200,[]);

        }
             // return response(array(
             //            'success' => true,
             //            'estado'  => 'guardado',
             //        ),200,[]);
        }
        public function store38(Request $request, $idtaller)
          {
               $id                  = Auth::id();
               $taller             =   Taller::where('id', $idtaller)->firstOrfail();
               $contenido           = TallerALectura::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
               $taller38            = new Lectura; 
               $taller38->taller_id = $idtaller;
               $taller38->user_id   =   $id;           
               $taller38->enunciado =   $contenido->enunciado; 
                $taller38->save();
                $alter =TallerALectura::where('taller_id', $idtaller)->firstOrfail();
                $enun = $alter->tallerLecturaOp;
               if ($taller38 = true) {
               $o = Lectura::where('user_id', $id)->get()->last();              
              foreach ($enun as $key=>$v) {
                     $datos                 =array(
                     'lectura_id' => $o->id,
                     'pregunta'   => $v->enunciado,
                     'respuesta'  => $request->respuestas[$key],
                     'created_at' => now(),
                     'updated_at' => now(),
                     );
                  LecturaDato::insert($datos);
               }
        }
    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

         $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
    public function store39(Request $request)
        {
            $array               =  $request->respuesta;
            $idtaller = $request->id;
            $taller             =   Taller::where('id', $idtaller)->firstOrfail();

            $palabra             = implode($array);
            $id                  = Auth::id();
            $contenido           = TallerPalabra::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
            $taller39            = new Palabra; 
            $taller39->taller_id = $idtaller;
            $taller39->user_id   =   $id;           
            $taller39->enunciado =   $contenido->enunciado;
            $taller39->palabra   =   $palabra;
            $taller39->save();

            $user= User::find($id);
            $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);

             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

  $contenido = Contenido::find($taller->contenido_id);
    
        if ($rol == 'estudiante') {
            return response(array(
                'success' => true,
                'rol'     => 'estudiante',
                'id'      =>  $contenido->materia_id,
            ),200,[]);

        }elseif($rol == 'docente'){
            

            // return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        // return $request->caja['valor_debe'];
        
              return response(array(
                'success' => true,
                'rol'     => 'docente',
                'id'      => $contenido->materia_id,
            ),200,[]);

        }
            // return $taller39;
        }
            public function store40(Request $request, $idtaller)
          {
               $id                  = Auth::id();
               $taller             =   Taller::where('id', $idtaller)->firstOrfail();
               $contenido           = TallerIdenTransa::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
               $taller40            = new IdenTrasa; 
               $taller40->taller_id = $idtaller;
               $taller40->user_id   =   $id;           
               $taller40->enunciado =   $contenido->enunciado; 
                $taller40->save();
                $alter =TallerIdenTransa::where('taller_id', $idtaller)->firstOrfail();
                $enun = $alter->tallerIdenTranOp;
               if ($taller40 = true) {
               $o = IdenTrasa::where('user_id', $id)->get()->last();              
              foreach ($enun as $key=>$v) {
                     $datos                 =array(
                     'iden_trasa_id' => $o->id,
                     'pregunta'   => $v->enunciado,
                     'respuesta'  => $request->respuestas[$key],
                     'created_at' => now(),
                     'updated_at' => now(),
                     );
                  IdenTrasaDato::insert($datos);
               }
        }
    $user= User::find($id);
    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }


    public function store41(Request $request, $idtaller)
    {
    $id                  = Auth::id();
    $taller             =   Taller::where('id', $idtaller)->firstOrfail();
    $taller41            =   new MapaConceptual; 
    $taller41->taller_id =   $idtaller;
    $taller41->user_id   =   $id;           
    $taller41->enunciado =  'DESARROLLE EL MAPA CONCEPTUAL, CON AGILIDAD.'; 
    $taller41->vender    =   $request->input('vender');   
    $taller41->comprar   =   $request->input('comprar');   
    $taller41->seccion1a =   $request->input('seccion1a');   
    $taller41->seccion1b =   $request->input('seccion1b');   
    $taller41->seccion2a =   $request->input('seccion2a');   
    $taller41->seccion2b =   $request->input('seccion2b');   
    $taller41->seccion3a =   $request->input('seccion3a');   
    $taller41->seccion3b =   $request->input('seccion3b');   
    $taller41->save();

    $user= User::find($id);

    $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);

         foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
        public function store42(Request $request)
        {
            $ideas               =  $request->respuesta;
            $idtaller = $request->id;
            $taller             =   Taller::where('id', $idtaller)->firstOrfail();

            $id                  = Auth::id();
            $contenido           = Taller::select('enunciado')->where('id', $idtaller)->firstOrFail(); 
            $taller42            = new OrdenIdea; 
            $taller42->taller_id = $idtaller;
            $taller42->user_id   =   $id;           
            $taller42->enunciado =   $contenido->enunciado;
            $taller42->save();
            $o = OrdenIdea::where('user_id', $id)->get()->last();              
            foreach ($ideas as $key=>$v) {
                     $datos          =array(
                     'orden_idea_id' => $o->id,
                     'ideas'         => $v['idea'],
                     'created_at'    => now(),
                     'updated_at'    => now(),
                     );
                  OrdenIdeasDato::insert($datos);
               }

            $user= User::find($id);
            $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);

              foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return response(array(
                'success' => true,
                'rol'     => 'estudiante',
                'id'      => $contenido->materia_id
            ),200,[]);

        }elseif($rol == 'docente'){
            

            // return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        // return $request->caja['valor_debe'];
        
              return response(array(
                'success' => true,
                'rol'     => 'docente',
                'id'      => $contenido->materia_id,
            ),200,[]);

        }
            // return $taller42;
        }

             public function store43(Request $request, $idtaller)
          {
            $id                   = Auth::id();
            $taller             =   Taller::where('id', $idtaller)->firstOrfail();
            $contenido            = TallerMConceptual::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
            $taller43             = new MapaConceptual2; 
            $taller43->taller_id  = $idtaller;
            $taller43->user_id    =   $id;           
            $taller43->enunciado  =   $contenido->enunciado; 
            $taller43->respuesta =  $request->input('respuesta');
            $taller43->enunciado1 =  $request->input('enunciado1');
            $taller43->enunciado2 =  $request->input('enunciado2');
            $taller43->enunciado3 =  $request->input('enunciado3');
            $taller43->enunciado4 =  $request->input('enunciado4');
            $taller43->enunciado5 =  $request->input('enunciado5');
            $taller43->enunciado6 =  $request->input('enunciado6');
            $taller43->respuesta1 =  $request->input('respuesta1');
            $taller43->respuesta2 =  $request->input('respuesta2');
            $taller43->respuesta3 =  $request->input('respuesta3');
            $taller43->respuesta4 =  $request->input('respuesta4');
            $taller43->respuesta5 =  $request->input('respuesta5');
            $taller43->respuesta6 =  $request->input('respuesta6');
            $taller43->save();

            $user= User::find($id);
            $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
                 foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

      $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }
         public function store44(Request $request, $idtaller)
           {
            $id                   = Auth::id();
            $taller             =   Taller::where('id', $idtaller)->firstOrfail();
            $contenido            = TallerEscribirCuenta::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
            $taller44             = new EscribirCuenta; 
            $taller44->taller_id  = $idtaller;
            $taller44->user_id    = $id;           
            $taller44->enunciado  = $contenido->enunciado; 
            $taller44->save();
            $o = EscribirCuenta::where('user_id', $id)->get()->last();              

            if ($request->cuenta == 'activo') {
                foreach ($request->activos as $key=>$v) {
                     $datos               =array(
                     'escribir_cuenta_id' => $o->id,
                     'cuenta'             => $v,
                     'created_at'         => now(),
                     'updated_at'         => now(),
                     );
                  Activo4::insert($datos);
               }
            }elseif ($request->cuenta == 'pasivo') {
                foreach ($request->pasivos as $key=>$v) {
                     $datos               =array(
                     'escribir_cuenta_id' => $o->id,
                     'cuenta'             => $v,
                     'created_at'         => now(),
                     'updated_at'         => now(),
                     );
                  Pasivo4::insert($datos);
               }

            }elseif ($request->cuenta == 'patrimonio') {
                foreach ($request->patrimonio as $key=>$v) {
                     $datos          =array(
                     'escribir_cuenta_id' => $o->id,
                     'cuenta'             => $v,
                     'created_at'         => now(),
                     'updated_at'         => now(),
                     );
                  Patrimonio4::insert($datos);
               }
            }

            $user= User::find($id);
            $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
                 foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

       $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
    }

    public function store45(Request $request, $idtaller)
        {
            $id   = Auth::id();
            $taller             =   Taller::where('id', $idtaller)->firstOrfail();
            $user = User::find($id);
            $user->tallers()->attach($idtaller,['status'=> 'calificado', 'calificacion' => 10, 'retroalimentacion' => 'Bien Hecho']);
                 foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

       $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }
        }
        public function store46(Request $request, $idtaller)
        {
            $id                         = Auth::id();
            $taller             =   Taller::where('id', $idtaller)->firstOrfail();
            $taller46                   =   new RuedaLogica; 
            $taller46->taller_id        =   $idtaller;
            $taller46->user_id          =   $id;           
            $taller46->enunciado        =  'RELATA  LOS  ENUNCIADOS  EN  LA  SIGUIENTE  RUEDA  LÓGICA, ADECUADAMENTE..'; 
            $taller46->persona_juridica =   $request->input('persona_juridica');   
            $taller46->objetivo         =   $request->input('objetivo');   
            $taller46->importancia      =   $request->input('importancia');   
            $taller46->persona_natural  =   $request->input('persona_natural');   
            $taller46->save();
            $user= User::find($id);
            $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
                 foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

        $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }


        }
             public function store47(Request $request, $idtaller)
        {
            $contenido            = TallerRAlternativa::select('enunciado', 'alternativa_correcta')->where('taller_id', $idtaller)->firstOrFail(); 
            $id                         = Auth::id();
            $taller             =   Taller::where('id', $idtaller)->firstOrfail();
            $taller47                   =   new RAlternativa; 
            $taller47->taller_id        =   $idtaller;
            $taller47->user_id          =   $id;           
            $taller47->enunciado        =  $contenido->enunciado; 
            $taller47->respuesta        =  $request->respuesta;
            $taller47->alternativa_correcta  =  $contenido->alternativa_correcta;
            $taller47->save();
            $user= User::find($id);
            $user->tallers()->attach($idtaller,['status'=> 'completado' , 'fecha_entregado' => now()]);
                 foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

       $contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return redirect()->route('Unidades', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
            
        }elseif($rol == 'docente'){
            

            return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        }


        }

        
        public function store48(Request $request, $idtaller)
        {
          $id                   = Auth::id();
          $contenido            = TallerArchivo::select('enunciado')->where('taller_id', $idtaller)->firstOrFail(); 
          $count = RespuestaArchivo::where('user_id', $id)->where('taller_id', $idtaller)->count(); 
          if ($count == 0) {
              $taller48                                    = new RespuestaArchivo; 
              $taller48->taller_id                         = $idtaller;
              $taller48->user_id                           = $id;           
              $taller48->enunciado                         = $contenido->enunciado; 
              $taller48->save();
              $user                                        = User::find($id);
              $user->tallers()->attach($idtaller,['status' => 'completado' , 'fecha_entregado' => now()]);


              $o                                          = RespuestaArchivo::where('user_id', $id)->where('taller_id', $idtaller)->first();
              $archivo = $request->file('file');
              $nombre                                      = time().'_'.$archivo->getClientOriginalName();
              $ruta                                        = public_path().'/archivos/talleres';
              $archivo->move($ruta, $nombre);
              $urlarchivo                                   = '/archivos/talleres/'.$nombre;
              $extension = pathinfo($urlarchivo, PATHINFO_EXTENSION);
              $nombre = basename($archivo->getClientOriginalName(),  '.'.$extension); 

              $user                                        = User::find($id);
              $taller_48                                   = new RArchivo; 
              $taller_48->respuesta_archivo_id             =  $o->id;
              $taller_48->urlarchivo                       =  $urlarchivo; 
              $taller_48->extension                       =  $extension;
              $taller_48->nombre                          =  $nombre;
              $taller_48->save();
              return $taller_48;
          }else {
              $o                                          = RespuestaArchivo::where('user_id', $id)->where('taller_id', $idtaller)->first();
              $archivo = $request->file('file');
              $nombre                                      = time().'_'.$archivo->getClientOriginalName();
              $ruta                                        = public_path().'/archivos/talleres';
              $archivo->move($ruta, $nombre);
              $urlarchivo                                  = '/archivos/talleres/'.$nombre;
              $extension = pathinfo($urlarchivo, PATHINFO_EXTENSION);
              $nombre = basename($archivo->getClientOriginalName(),  '.'.$extension); 

              $user                                        = User::find($id);
              $taller_48                                   = new RArchivo; 
              $taller_48->respuesta_archivo_id             =  $o->id;
              $taller_48->urlarchivo                       =  $urlarchivo; 
              $taller_48->extension                       =  $extension;
              $taller_48->nombre                          =  $nombre;
              $taller_48->save();
              return $taller_48;
          }
  }
           public function store49(Request $request)
        {
            $tallerid            = $request->id;
            $taller             =   Taller::where('id', $tallerid)->firstOrfail();

            $contenido           = PlanCuenta::select('enunciado')->where('taller_id', $tallerid)->firstOrFail(); 
            $id                  = Auth::id();
            $taller47            =   new PlanCuentaRespuesta; 
            $taller47->taller_id =   $tallerid;
            $taller47->user_id   =   $id;           
            $taller47->enunciado =  $contenido->enunciado; 
            $taller47->activos   =  json_encode($request->activos);
            $taller47->pasivos   =   json_encode($request->pasivos);
            $taller47->save();

            $user= User::find($id);
            $user->tallers()->attach($tallerid,['status'=> 'completado' , 'fecha_entregado' => now()]);

             foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }

$contenido = Contenido::find($taller->contenido_id);
        if ($rol == 'estudiante') {
            return response(array(
                'success' => true,
                'rol'     => 'estudiante',
                'id'      => $contenido->materia_id,
                'mensaje' => 'Taller Completado Correctamente'
                
            ),200,[]);

        }elseif($rol == 'docente'){
            

            // return redirect()->route('contenido.resueltos', ['id' => $contenido->materia_id])->with('datos', 'Datos Enviados Correctamente');
        // return $request->caja['valor_debe'];
        
              return response(array(
                'success' => true,
                'rol'     => 'docente',
                'id'      => $contenido->materia_id,
                'mensaje' => 'Taller Completado Correctamente'
                
            ),200,[]);

        }
            //    return response(array(                                         //ENVIO DE RESPUESTA
            //     'success' => true,
            //     'estado' => 'completado',
            //     'mensaje' => 'Taller Completado Correctamente'
            // ),200,[]);


        }



}