<?php

namespace App\Http\Controllers;
use App\Admin\Leccion\Leccion;
use App\Admin\Leccion\LeccionAlternativa;
use App\Admin\Leccion\LeccionCompletar;
use App\Admin\Leccion\LeccionOpcion;
use App\Admin\Leccion\LeccionVerdaderFalso;
use App\Admin\PlanCuenta;
use App\Admin\RAAlternativa;
use App\Admin\RADefinicion;
use App\Admin\RAEnunciado;
use App\Admin\Taller2Relacionar;
use App\Admin\Taller2RelacionarOpcion;
use App\Admin\TallerALectura;
use App\Admin\TallerALecturaOp;
use App\Admin\TallerAbreviatura;
use App\Admin\TallerAbreviaturaImg;
use App\Admin\TallerAnalizar;
use App\Admin\TallerAnalizarOp;
use App\Admin\TallerBalanceInicial;
use App\Admin\TallerCelda;
use App\Admin\TallerCeldaClasificacion;
use App\Admin\TallerCeldaClasificar;
use App\Admin\TallerCertificadoDeposito;
use App\Admin\TallerCheque;
use App\Admin\TallerChequeEndoso;
use App\Admin\TallerCirculo;
use App\Admin\TallerClasificar;
use App\Admin\TallerCollage;
use App\Admin\TallerCompletar;
use App\Admin\TallerCompletarEnunciado;
use App\Admin\TallerContabilidad;
use App\Admin\TallerContabilidadOp;
use App\Admin\TallerConvertirCheque;
use App\Admin\TallerDefinirEnunOp;
use App\Admin\TallerDefinirEnunciado;
use App\Admin\TallerDiarioGeneral;
use App\Admin\TallerDiferencia;
use App\Admin\TallerEscribirCuenta;
use App\Admin\TallerFactura;
use App\Admin\TallerFacturaDato;
use App\Admin\TallerGusanillo;
use App\Admin\TallerIdenTransa;
use App\Admin\TallerIdenTransaOp;
use App\Admin\TallerIdentificarImagen;
use App\Admin\TallerIdentificarImagenOpcion;
use App\Admin\TallerIdentificarPersona;
use App\Admin\TallerKardex;
use App\Admin\TallerLetraCambio;
use App\Admin\TallerMConceptual;
use App\Admin\TallerModuloContable;
use App\Admin\TallerModuloTransaccion;
use App\Admin\TallerNPedidoDatos;
use App\Admin\TallerNotaPedido;
use App\Admin\TallerNotaVenta;
use App\Admin\TallerNotaVentaDato;
use App\Admin\TallerOrdenIdea;
use App\Admin\TallerOrdenPago;
use App\Admin\TallerPagare;
use App\Admin\TallerPalabra;
use App\Admin\TallerPartidaDoble;
use App\Admin\TallerPartidaDobleEnun;
use App\Admin\TallerPregunta;
use App\Admin\TallerRAlternativa;
use App\Admin\TallerRecibo;
use App\Admin\TallerRelacionar;
use App\Admin\TallerRelacionarOpcion;
use App\Admin\TallerSenalar;
use App\Admin\TallerSenalarOpcion;
use App\Admin\TallerSopaLetra;
use App\Admin\TallerSubrayar;
use App\Admin\TallerSubrayarOp;
use App\Admin\TallerTipoSaldo;
use App\Admin\TallerValeCaja;
use App\Admin\TallerVerdaFalsoOp;
use App\Admin\TallerVerdaderoFalso;
use App\Admin\TipoSaldoDebe;
use App\Admin\TipoSaldoHaber;
use App\Http\Controllers\Controller;
use App\Plantilla;
use App\Taller;
use App\TallerArchivo;
use App\TallerCompletarEnunRe;
use App\Talleres\TallerEcuacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('estudiante');
        $this->middleware('docente');
    }
     public function index (){

        $alumnos = DB::table('users')
        ->join('role_user', 'role_user.user_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->where('users.estado', 'on')
        ->where('descripcion', 'estudiante')
        ->count();

        $docente = DB::table('users')
        ->join('role_user', 'role_user.user_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->where('users.estado', 'on')
        ->where('descripcion', 'docente')
        ->count();
        
    return view('welcome',compact('alumnos','docente'));
       
    }
    public function status(Request $request)
    {
       $taller = Taller::find($request->id);
       $estado = $taller->estado;
       // return $estado;
       if ($estado === 1) {
         $taller->estado = 0; 
         $taller->save(); 
          return response(array(
                'success' => true,
                'message' => 'Taller desactivado correctamente'
            ),200,[]);  
       }elseif ($estado == 0) {
          $taller->estado = 1; 
         $taller->save();  
          return response(array(
                'success' => true,
                'message' => 'Taller activado correctamente'
            ),200,[]);   
       }

    }
    public function tallercontable()
    {
      return view('contabilidad.modulocontable');
      
    }
   public function admin()
   {
         $g = 0;
         // $users = DB::table('tallers')->select('enunciado','nombre', 'status as taller_user')->get();
         $users = DB::table('tallers')
            ->join('taller_user', 'tallers.id', '=', 'taller_user.taller_id')
            ->join('users', 'users.id', '=', 'taller_user.user_id')
            ->where('taller_user.status', 'completado')
            ->paginate(10);
      return view('admin.admin', compact('g', 'users'));
   }
   function leccion()
   {
      return view('admin.lecciones');
     
   }
   // public function index (){

   //      return view('welcome');
   //  }
    public function delete(Request $request)
    {
      $taller = Taller::find($request->id);
      $taller->delete();

      return response(array(
                'success' => true,
                'message' => 'Taller elimimnado exitosamente'
            ),200,[]);  
    }
   public function plantilla(Request $request)
   {

    $i = Plantilla::where('plantilla', 'si')->get()->count();
      $plantilla = new Plantilla;
      $plantilla->nombre = 'PLANTILLA '.++$i.' - '.$request->input('nombre');
        $plantilla->descripcion = $request->input('descripcion');
      $plantilla->plantilla = $request->input('plantilla');
      $plantilla->save();

       return redirect()->route('admin.create')->with('datos', 'Plantilla creada correctamente!'); 
   }
   function crear_leccion(Request $request)
   {
      $i = Leccion::where('contenido_id', $request->input('contenido_id'))->count();//cambios
    //return $request->all();
      $leccion                  = new Leccion;
      $leccion->nombre          = 'Leccion '.++$i;
      $leccion->enunciado       = $request->enunciado;
      $leccion->plantilla_id    = $request->plantilla_id;
      $leccion->contenido_id    = $request->contenido_id; //cambios 
      $leccion->option_titulo   = $request->option_titulo; //cambios 
      $leccion->option_correcta = $request->option_correcta; //cambios 
      $leccion->fecha_entrega   = $request->fecha_entrega; //cambios 
      $leccion->estado          = 0;
      $leccion->save();
      $a = Leccion::get()->last();

      if (isset($request->completars )) {
         foreach ($request->completars as $key1=>$enunciado1) {
                  $datos1=array(
                     'leccion_id' => $a->id,
                     'enunciado'  => $request->enunciado,
                     'enunciados' => $enunciado1['enunciado'],
                     'created_at' => now(),
                     'updated_at' => now(),
                  );
                  LeccionCompletar::insert($datos1);
               }
    }
      if (isset($request->selecionars )) {
         foreach ($request->selecionars as $key2=>$enunciado2) {
                  $datos2=array(
                     'leccion_id' => $a->id,
                     'enunciado'  => $request->enunciado,
                     'enunciados' => $enunciado2['enunciado'],
                     'created_at' => now(),
                     'updated_at' => now(),
                  );
                  LeccionOpcion::insert($datos2);
               }
    }
       if (isset($request->alternativas )) {
         foreach ($request->alternativas as $key3=>$enunciado3) {
                  $datos3=array(
                     'leccion_id' => $a->id,
                     'enunciado'  => $request->enunciado,
                     'titulo' => $enunciado3['titulo'],
                     'respuesta' => $enunciado3['r_correcta'],
                     'alternativa1' => $enunciado3['primera'],
                     'alternativa2' => $enunciado3['segunda'],
                     'created_at' => now(),
                     'updated_at' => now(),
                  );
                  LeccionAlternativa::insert($datos3);
               }
        }
        if (isset($request->verdader_falso )) {
         foreach ($request->verdader_falso as $key4=>$enunciado4) {
                  $datos4=array(
                     'leccion_id' => $a->id,
                     'enunciado'  => $request->enunciado,
                     'titulo'     => $enunciado4['enunciado'],
                     'respuesta'  => $enunciado4['r_correcta'],
                     'created_at' => now(),
                     'updated_at' => now(),
                  );
                  LeccionVerdaderFalso::insert($datos4);
               }
        }
    return response(array(                                         //ENVIO DE RESPUESTA
                        'success' => true,
                        'estado' => 'guardado',
                        'message' => 'Taller Creado'
                    ),200,[]);
   }
   public function taller1(Request $request)
   {
    $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
    //return $request->all();
      $taller1               = new Taller;
      $taller1->nombre       = 'Taller '.++$valor[1];
      $taller1->enunciado    = $request->input('enunciado');
      $taller1->plantilla_id = $request->input('id_plantilla');
      $taller1->contenido_id = $request->input('contenido_id'); //cambios 
      $taller1->estado       = 0;
      $taller1->save();

    if ($taller1 = true) {
      $a = Taller::get()->last();

         $taller_1 = new TallerCompletar;
         $taller_1->taller_id = $a->id;
         $taller_1->enunciado = $request->input('enunciado');
         $taller_1->leyenda = $request->input('leyenda');
      if ($request->hasFile('imagen')) {
            $imagen        = $request->file('imagen');
            $nombre        = time().'_'.$imagen->getClientOriginalName();
            $ruta          = public_path().'/img/talleres';
            $imagen->move($ruta, $nombre);
            $urlimagen     = '/img/talleres/'.$nombre;
            $taller_1->img = $urlimagen;
          }
      $taller_1->save();

    }
    return redirect()->route('admin.create')->with('datos', 'Taller creado correctamente!'); 
   }

     public function taller2(Request $request)
   {
    $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
      $taller2               = new Taller;
      $taller2->nombre       = 'Taller '.++$valor[1];
      $taller2->enunciado    = $request->input('enunciado');
      $taller2->plantilla_id = $request->input('id_plantilla');
      $taller2->contenido_id = $request->input('contenido_id');
      $taller2->estado       = 0;
      $taller2->save();


   if ($taller2 = true) {
      $a                          = Taller::get()->last();
      $taller_2                   = new TallerPartidaDoble;
      $taller_2->taller_id        = $a->id;
      $taller_2->enunciado        = $request->input('enunciado');
      $taller_2->transacciones    = $request->input('transacciones');
      $taller_2->n_t              = $request->input('n_t');
      $taller_2->estado_resultado = $request->input('estado_resultado');
      $taller_2->save();
    //   $o = TallerPartidaDoble::get()->last();

    //      foreach ($request->enun as $key=>$v) {
    //               $datos=array(
    //                  'taller_partida_doble_id'=> $o->id,
    //                  'enunciados' => $request->enun[$key],
    //                  'created_at'=> now(),
    //                  'updated_at'=> now(),
    //               );
    //               TallerPartidaDobleEnun::insert($datos);
    //            }
    }
    return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
   }

    public function taller3(Request $request)
   {
    $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
    $taller3 = new Taller;
    $taller3->nombre = 'Taller '.++$valor[1];
    $taller3->enunciado = $request->input('enunciado');
    $taller3->plantilla_id = $request->input('id_plantilla');
    $taller3->contenido_id = $request->input('contenido_id');
    $taller3->estado = 0;
    $taller3->save();

    if ($taller3 = true) {
      $a = Taller::get()->last();
      $taller_3 = new TallerCompletarEnunciado;
      $taller_3->taller_id = $a->id;
      $taller_3->enunciado = $request->input('enunciado');
      $taller_3->save();
      $o = TallerCompletarEnunciado::get()->last();

         foreach ($request->enun as $key=>$v) {
                  $datos=array(
                     'taller_completar_enunciado_id'=> $o->id,
                     'enunciados' => $request->enun[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  TallerCompletarEnunRe::insert($datos);
               }
    }
    return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
   }

   public function taller4(Request $request)
   {
      $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
      $taller4 = new Taller;
      $taller4->nombre = 'Taller '.++$valor[1];
      $taller4->enunciado = $request->input('enunciado');
      $taller4->plantilla_id = $request->input('id_plantilla');
      $taller4->contenido_id = $request->input('contenido_id');
      $taller4->estado = 0;
      $taller4->save();

      if ($taller4 = true) {
         $a                      = Taller::get()->last();
         $taller_4               = new TallerDiferencia;
         $taller_4->taller_id    = $a->id;
         $taller_4->enunciado    = $request->input('enunciado');
         $taller_4->descripcion1 = $request->input('desc1');
         $taller_4->descripcion2 = $request->input('desc2');
        if ($request->hasFile('img1')) {
            $imagen1        = $request->file('img1');
            $nombre1        = time().'_'.$imagen1->getClientOriginalName();
            $ruta1          = public_path().'/img/talleres';
            $imagen1->move($ruta1, $nombre1);
            $urlimagen1     = '/img/talleres/'.$nombre1;
            $taller_4->img1 = $urlimagen1;
        }
         if ($request->hasFile('img2')) {
            $imagen2        = $request->file('img2');
            $nombre2        = time().'_'.$imagen2->getClientOriginalName();
            $ruta2          = public_path().'/img/talleres';
            $imagen2->move($ruta2, $nombre2);
            $urlimagen2     = '/img/talleres/'.$nombre2;
            $taller_4->img2 = $urlimagen2;
        }
        
         $taller_4->save();
      }
    return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
   }
     public function taller5(Request $request)
   {
      $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
      $taller5 = new Taller;
      $taller5->nombre = 'Taller '.++$valor[1];
      $taller5->enunciado   = $request->input('enunciado');
      $taller5->plantilla_id = $request->input('id_plantilla');
      $taller5->contenido_id   = $request->input('contenido_id');
      $taller5->estado       = 0;
      $taller5->save();

       if ($taller5 = true) {
         $b = Taller::get()->last();
         $taller_5 = new TallerSenalar;
         $taller_5->taller_id = $b->id;
         $taller_5->enunciado = $request->input('enunciado');
         $taller_5->save();


         if ($taller_5 = true) {

      $a = TallerSenalar::get()->last();

          foreach ($request->concepto as $key=>$v) {
                  $datos=array(
                     'taller_senalar_id'=> $a->id,
                     'concepto'=> $request->concepto[$key],
                     'respuesta'=> $request->respuesta[$key],
                     'alternativa1'=> $request->alternativa1[$key],
                     'alternativa2' => $request->alternativa2[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  TallerSenalarOpcion::insert($datos);
               }
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
   }

   }

   }
   public function taller6(Request $request)
   {
      $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
      $taller6 = new Taller;
      $taller6->nombre = 'Taller '.++$valor[1];
      $taller6->enunciado = $request->input('enunciado');
      $taller6->plantilla_id = $request->input('id_plantilla');
      $taller6->contenido_id = $request->input('contenido_id');
      $taller6->estado = 0;
      $taller6->save();
      if ($taller6 = true) {
         $a = Taller::get()->last();
         $taller_6 = new TallerIdentificarImagen;
         $taller_6->taller_id = $a->id;
         $taller_6->enunciado = $request->input('enunciado');
         $taller_6->save();
}
      if ($taller_6 = true) {
         $o = TallerIdentificarImagen::get()->last(); 
         $urlimagen1 = [];
         $urlimagen2 = [];
         $files_a = $request->file('col_a');
         $files_b = $request->file('col_b');
 
         foreach ($files_a as $file_a) {
            $nombre = time().'_'.$file_a->getClientOriginalName();
            $ruta = public_path().'/img/talleres';
            $file_a->move($ruta, $nombre);

            $urlimagen1[]= '/img/talleres/'.$nombre;           
         }
         foreach ($files_b as $file_b) {
            $nombre = time().'_'.$file_b->getClientOriginalName();
            $ruta = public_path().'/img/talleres';
            $file_b->move($ruta, $nombre);

            $urlimagen2[]= '/img/talleres/'.$nombre;           
         }
            foreach ($urlimagen1 as  $key=>$v) {
                  $datos=array(
                     'taller_img_id' => $o->id,
                     'col_a' => $urlimagen1[$key],
                     'col_b'=> $urlimagen2[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  TallerIdentificarImagenOpcion::insert($datos);
               }
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');  
 }
   }
     public function taller7(Request $request)
     {
      $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
      $taller7 = new Taller;
      $taller7->nombre = 'Taller '.++$valor[1];
      $taller7->enunciado = $request->input('enunciado');
      $taller7->plantilla_id = $request->input('id_plantilla');
      $taller7->contenido_id = $request->input('contenido_id');
      $taller7->estado = 0;
      $taller7->save();

      if ($taller7 = true) {
         $a = Taller::get()->last();
         $taller_7 = new TallerGusanillo;
         $taller_7->taller_id = $a->id;
         $taller_7->enunciado = $request->input('enunciado');
         $taller_7->save();
         return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
     }
      public function taller8(Request $request)
      {
      $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
      $taller8 = new Taller;
      $taller8->nombre = 'Taller '.++$valor[1];
      $taller8->enunciado = $request->input('enunciado');
      $taller8->plantilla_id = $request->input('id_plantilla');
      $taller8->contenido_id = $request->input('contenido_id');
      $taller8->estado = 0;
      $taller8->save();

      if ($taller8 = true) {
    
        $a = Taller::get()->last();
        $taller_8 = new TallerCirculo;
        $taller_8->taller_id = $a->id;
        $taller_8->enunciado = $request->input('enunciado');
        if ($request->hasFile('img')) {
            $imagen = $request->file('img');
            $nombre = time().'_'.$imagen->getClientOriginalName();
            $ruta = public_path().'/img/talleres';
            $imagen->move($ruta, $nombre);
            $urlimagen = '/img/talleres/'.$nombre;
         $taller_8->img = $urlimagen;
         }
         $taller_8->cantidad = $request->input('cantidad');
         $taller_8->save();
         return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
      }
      public function taller9(Request $request)
      {
      $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
      $taller9 = new Taller;
      $taller9->nombre = 'Taller '.++$valor[1];
      $taller9->enunciado = $request->input('enunciado');
      $taller9->plantilla_id = $request->input('id_plantilla');
      $taller9->contenido_id = $request->input('contenido_id');
      $taller9->estado = 0;
      $taller9->save();

      if ($taller9 = true) {
         $a = Taller::get()->last();
         $taller_9 = new TallerSubrayar;
         $taller_9->taller_id = $a->id;
         $taller_9->enunciado = $request->input('enunciado');
         $taller_9->save();

      }
      if ($taller_9 = true) {
         $o = TallerSubrayar::get()->last();              
            foreach ($request->concep as $key=>$v) {
               $datos=array(
                  'taller_subrayars_id'=> $o->id,
                  'concepto'=> $request->concep[$key],
                  'respuesta'=> $request->respuesta[$key],
                  'alternativas'=> $request->alter[$key],
                  'created_at'=> now(),
                  'updated_at'=> now(),
               );
                  TallerSubrayarOp::insert($datos);
               }
             }
         return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      
      

      }
      public function taller10(Request $request)
      {
if ($request->input('id_plantilla') == 10 ) {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
         $valor = explode(" ", $i->nombre);
         $taller10 = new Taller;
         $taller10->nombre = 'Taller '.++$valor[1];
         $taller10->enunciado = $request->input('enunciado');
         $taller10->plantilla_id = $request->input('id_plantilla');
         $taller10->contenido_id   = $request->input('contenido_id');
         $taller10->estado = 0;
         $taller10->save();

      if ($taller10 == true) {
         $a = Taller::get()->last();
         $taller_10 = new TallerRelacionar;
         $taller_10->taller_id = $a->id;
         $taller_10->enunciado = $request->input('enunciado');
         $taller_10->save();

         if ($taller_10 == true) {
         $o = TallerRelacionar::get()->last();
         $q= 0;
         $files_a = $request->file('img');
         $urlimagen = [];
         $arr1 = $request->definicion;
            shuffle($arr1);
            // foreach($claves as $contenido){
            //     $letra[$contenido] = $arr1[$contenido];
            // }
        
         foreach ($files_a as $file_a) {
            $nombre       = time().'_'.$file_a->getClientOriginalName();
            $ruta         = public_path().'/img/talleres';
            $file_a->move($ruta, $nombre);
            $urlimagen[] = '/img/talleres/'.$nombre;           
         }
         foreach ($urlimagen as $key=>$v) {
                  $datos=array(
                     'taller_relacionar_id' => $o->id,
                     'orden'                => ++$q,
                     'enunciado'            => $request->enunciados[$key],
                     'definicion'           => $request->definicion[$key],
                     'definicion_aleatoria' => $arr1[$key],
                     'img'                  => $urlimagen[$key],
                     'created_at'           => now(),
                     'updated_at'           => now(),
                     );
                  TallerRelacionarOpcion::insert($datos);
               }
            }
return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 

      
         }

}elseif($request->input('id_plantilla') == 11 ) {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller11 = new Taller;
         $taller11->nombre = 'Taller '.++$valor[1];
         $taller11->enunciado = $request->input('enunciado');
         $taller11->plantilla_id = $request->input('id_plantilla');
         $taller11->contenido_id = $request->input('contenido_id');
         $taller11->estado = 0;
         $taller11->save();

      if ($taller11 = true) {
            $a = Taller::get()->last();
            $taller_11 = new Taller2Relacionar;
            $taller_11->taller_id = $a->id;
            $taller_11->enunciado = $request->input('enunciado');
            $taller_11->enunciado1 = $request->input('enunciado1');

         if($request->hasFile('img1')) {
            $imagen1 = $request->file('img1');
            $nombre1 = time().'_'.$imagen1->getClientOriginalName();
            $ruta1 = public_path().'/img/talleres';
            $imagen1->move($ruta1, $nombre1);
            $urlimagen1 = '/img/talleres/'.$nombre1;
         }
            $taller_11->img1 = $urlimagen1;
            $taller_11->enunciado2 = $request->input('enunciado2');
            if($request->hasFile('img2')) {
            $imagen2 = $request->file('img2');
            $nombre2 = time().'_'.$imagen2->getClientOriginalName();
            $ruta2 = public_path().'/img/talleres';
            $imagen2->move($ruta2, $nombre2);
            $urlimagen2 = '/img/talleres/'.$nombre2;
         }
            $taller_11->img2 = $urlimagen2;
            $taller_11->save();
         if ($taller_11 = true) {
            $o = Taller2Relacionar::get()->last();
            $q = 0;
            foreach ($request->definicion as $key=>$v) {
                  $datos=array(
                     'taller2_relacionar_id' => $o->id,
                     'orden'                 => ++$q,
                     'definicion'            => $v,
                     'created_at'            => now(),
                     'updated_at'            => now(),
                     );
                  Taller2RelacionarOpcion::insert($datos);
               }
return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      
}
         }
}
      }
       public function taller12(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
          $valor = explode(" ", $i->nombre);
         $taller12 = new Taller;
         $taller12->nombre = 'Taller '.++$valor[1];
         $taller12->enunciado = $request->input('enunciado');
         $taller12->plantilla_id = $request->input('id_plantilla');
         $taller12->contenido_id = $request->input('contenido_id');
         $taller12->estado = 0;
         $taller12->save();

           if ($taller12 = true) {
            $a = Taller::get()->last();
            $taller_12 = new TallerVerdaderoFalso;
            $taller_12->taller_id = $a->id;
            $taller_12->enunciado = $request->input('enunciado');
            $taller_12->save();
         }
         if ($taller_12 = true) {

         $o = TallerVerdaderoFalso::get()->last();              
            foreach ($request->descripcion as $key=>$v) {
               $datos=array(
                  'taller_verdadero_falso_id'=> $o->id,
                  'descripcion'=> $v,
                  'respuesta'=> $request->respuesta[$key],
                  'created_at'=> now(),
                  'updated_at'=> now(),
               );
                  TallerVerdaFalsoOp::insert($datos);
               }
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 

             }

           

      }
      public function taller13(Request $request)
      {
        $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller13 = new Taller;
         $taller13->nombre = 'Taller '.++$valor[1];
         $taller13->enunciado = $request->input('enunciado');
         $taller13->plantilla_id = $request->input('id_plantilla');
         $taller13->contenido_id = $request->input('contenido_id');
         $taller13->estado = 0;
         $taller13->save();

           if ($taller13 = true) {
            $a = Taller::get()->last();
            $taller_13 = new TallerDefinirEnunciado;
            $taller_13->taller_id = $a->id;
            $taller_13->enunciado = $request->input('enunciado');
            $taller_13->save();
         }
         if ($taller_12 = true) {

         $o = TallerDefinirEnunciado::get()->last();              
            foreach ($request->concepto as $key=>$v) {
               $datos=array(
                  'taller_definir_enunciado_id'=> $o->id,
                  'concepto'=> $request->concepto[$key],
                  'created_at'=> now(),
                  'updated_at'=> now(),
               );
                  TallerDefinirEnunOp::insert($datos);
               }
               return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
               
             }


      }
       public function taller14(Request $request)
      {
        $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller14 = new Taller;
         $taller14->nombre = 'Taller '.++$valor[1];
         $taller14->enunciado = $request->input('enunciado');
         $taller14->plantilla_id = $request->input('id_plantilla');
         $taller14->contenido_id = $request->input('contenido_id');
         $taller14->estado = 0;
         $taller14->save();

           if ($taller14 = true) {
            $a = Taller::get()->last();

            $taller_14 = new TallerIdentificarPersona;
            $taller_14->taller_id = $a->id;
            $taller_14->enunciado = $request->input('enunciado');
            $taller_14->descripcion = $request->input('descripcion');
            $taller_14->intermediarios = json_encode( $request->intermediarios);
            $taller_14->save();
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 

           }
      }
      public function taller15(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $taller15 = new Taller;
         $taller15->nombre = 'Taller '.++$valor[1];
         $taller15->enunciado = $request->input('enunciado');
         $taller15->plantilla_id = $request->input('id_plantilla');
         $taller15->contenido_id = $request->input('contenido_id');
         $taller15->estado = 0;
         $taller15->save();

           if ($taller15 = true) {
            $a = Taller::get()->last();

            $taller_15 = new TallerCheque;
            $taller_15->taller_id = $a->id;
            $taller_15->enunciado = $request->input('enunciado');
            $taller_15->girador = $request->input('girador');
            $taller_15->girado = $request->input('girado');
            $taller_15->beneficiario = $request->input('beneficiario');
            $taller_15->cantidad = $request->input('cantidad');
            $taller_15->lugar = $request->input('lugar');
            $taller_15->fecha = $request->input('fecha');
            $taller_15->save();
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
   }
   public function taller16(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $taller16 = new Taller;
         $taller16->nombre = 'Taller '.++$valor[1];
         $taller16->enunciado = $request->input('enunciado');
         $taller16->plantilla_id = $request->input('id_plantilla');
         $taller16->contenido_id = $request->input('contenido_id');
         $taller16->estado = 0;
         $taller16->save();

           if ($taller16 = true) {
            $a = Taller::get()->last();

            $taller_16 = new TallerChequeEndoso;
            $taller_16->taller_id = $a->id;
            $taller_16->enunciado = $request->input('enunciado');
            $taller_16->endoso = $request->input('endoso');
            $taller_16->save();
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
      }
       public function taller17(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $taller17 = new Taller;
         $taller17->nombre = 'Taller '.++$valor[1];
         $taller17->enunciado = $request->input('enunciado');
         $taller17->plantilla_id = $request->input('id_plantilla');
         $taller17->contenido_id = $request->input('contenido_id');
         $taller17->estado = 0;
         $taller17->save();

           if ($taller17 = true) {
            $a = Taller::get()->last();

            $taller_17 = new TallerConvertirCheque;
            $taller_17->taller_id = $a->id;
            $taller_17->enunciado = $request->input('enunciado');
            $taller_17->nombre = $request->input('nombre');
            $taller_17->cantidad = $request->input('cantidad');
            $taller_17->numero = $request->input('numero');
            $taller_17->lugar = $request->input('lugar');
            $taller_17->fecha = $request->input('fecha');
            $taller_17->n_banco = $request->input('n_banco');
            // $taller_17->tipo_cheque = $request->input('tipo_cheque');
            $taller_17->save();
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
      }

      public function taller18(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
          $valor = explode(" ", $i->nombre);
         $taller18 = new Taller;
         $taller18->nombre = 'Taller '.++$valor[1];
         $taller18->enunciado = $request->input('enunciado');
         $taller18->plantilla_id = $request->input('id_plantilla');
         $taller18->contenido_id = $request->input('contenido_id');
         $taller18->estado = 0;
         $taller18->save();

           if ($taller18 = true) {
            $a = Taller::get()->last();
            $taller_18 = new TallerLetraCambio;
            $taller_18->taller_id = $a->id;
            $taller_18->enunciado = $request->input('enunciado');
            $taller_18->valor = $request->input('valor');
            $taller_18->acreedor = $request->input('acreedor');
            $taller_18->deudor = $request->input('deudor');
            $taller_18->tasa_de_interes = $request->input('tasa_de_interes');
            $taller_18->fecha_de_vencimiento = $request->input('fecha_de_vencimiento');
            $taller_18->lugar = $request->input('lugar');
            $taller_18->fecha_de_emision = $request->input('fecha_de_emision');
            $taller_18->save();
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
      }


      public function taller19(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller19 = new Taller;
         $taller19->nombre = 'Taller '.++$valor[1];
         $taller19->enunciado = $request->input('enunciado');
         $taller19->plantilla_id = $request->input('id_plantilla');
         $taller19->contenido_id = $request->input('contenido_id');
         $taller19->estado = 0;
         $taller19->save();

           if ($taller19 = true) {
            $a = Taller::get()->last();
            $taller_19 = new TallerCertificadoDeposito;
            $taller_19->taller_id = $a->id;
            $taller_19->enunciado = $request->input('enunciado');
            $taller_19->valor = $request->input('valor');
            $taller_19->beneficiario = $request->input('beneficiario');
            $taller_19->interes_anual = $request->input('interes_anual');
            $taller_19->lugar = $request->input('lugar');
            $taller_19->fecha_de_emision = $request->input('fecha_de_emision');
            $taller_19->plazo_de_vencimiento = $request->input('plazo_de_vencimiento');
            $taller_19->fecha_de_vencimiento = $request->input('fecha_de_vencimiento');
            $taller_19->save();
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
      }

        public function taller20(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller20 = new Taller;
         $taller20->nombre = 'Taller '.++$valor[1];
         $taller20->enunciado            = $request->input('enunciado');
         $taller20->plantilla_id = $request->input('id_plantilla');
         $taller20->contenido_id = $request->input('contenido_id');
         $taller20->estado = 0;
         $taller20->save();

           if ($taller20 = true) {
            $a                               = Taller::get()->last();
            $taller_20                       = new TallerPagare;
            $taller_20->taller_id            = $a->id;
            $taller_20->enunciado            = $request->input('enunciado');
            $taller_20->beneficiario         = $request->input('beneficiario');
            $taller_20->deudor               = $request->input('deudor');
            $taller_20->garante              = $request->input('garante');
            $taller_20->valor                = $request->input('valor');
            $taller_20->plazo_pago           = $request->input('plazo_pago');
            $taller_20->tasa_interes         = $request->input('tasa_interes');
            $taller_20->lugar                = $request->input('lugar');
            $taller_20->fecha_emision        = $request->input('fecha_emision');
            $taller_20->fecha_de_vencimiento = $request->input('fecha_de_vencimiento');
            $taller_20->save();
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
      }

       public function taller21(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller21 = new Taller;
         $taller21->nombre = 'Taller '.++$valor[1];
         $taller21->enunciado            = $request->input('enunciado');
         $taller21->plantilla_id = $request->input('id_plantilla');
         $taller21->contenido_id = $request->input('contenido_id');
         $taller21->estado = 0;
         $taller21->save();

           if ($taller21 = true) {
            $a                               = Taller::get()->last();
            $taller_21                       = new TallerValeCaja;
            $taller_21->taller_id            = $a->id;
            $taller_21->enunciado            = $request->input('enunciado');
            $taller_21->valor                = $request->input('valor');
            $taller_21->deudor               = $request->input('deudor');
            $taller_21->detalle              = $request->input('detalle');
            $taller_21->lugar                = $request->input('lugar');
            $taller_21->fecha                = $request->input('fecha');
            $taller_21->save();
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
      }

        public function taller22(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $taller22 = new Taller;
         $taller22->nombre = 'Taller '.++$valor[1];
         $taller22->enunciado            = $request->input('enunciado');
         $taller22->plantilla_id = $request->input('id_plantilla');
         $taller22->contenido_id = $request->input('contenido_id');
         $taller22->estado = 0;
         $taller22->save();

           if ($taller22 = true) {
            $a                               = Taller::get()->last();
            $taller_22                       = new TallerNotaPedido;
            $taller_22->taller_id            = $a->id;
            $taller_22->enunciado            = $request->input('enunciado');
            $taller_22->pedido               = $request->input('pedido');
            $taller_22->lugar                = $request->input('lugar');
            $taller_22->fecha                = $request->input('fecha');
            $taller_22->firma                = $request->input('firma');
            $taller_22->plazo_entrega        = $request->input('plazo_entrega');
            $taller_22->save();


             if ($taller_22 = true) {
               $o = TallerNotaPedido::get()->last();              
               foreach ($request->cantidad as $key=>$v) {
                  $datos=array(
                     'taller_nota_pedido_id'=> $o->id,
                     'cantidad'=> $request->cantidad[$key],
                     'codigo'=> $request->codigo[$key],
                     'descripcion'=> $request->descripcion[$key],
                     'precio_unit'=> $request->precio_unit[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  TallerNPedidoDatos::insert($datos);
               }
             }

            
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
      }
       public function taller23(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $taller23 = new Taller;
         $taller23->nombre = 'Taller '.++$valor[1];
         $taller23->enunciado            = $request->input('enunciado');
         $taller23->plantilla_id = $request->input('id_plantilla');
         $taller23->contenido_id = $request->input('contenido_id');
         $taller23->estado = 0;
         $taller23->save();

           if ($taller23 = true) {
            $a                               = Taller::get()->last();
            $taller_23                       = new TallerRecibo;
            $taller_23->taller_id            = $a->id;
            $taller_23->enunciado            = $request->input('enunciado');
            $taller_23->valor               = $request->input('valor');
            $taller_23->acreedor               = $request->input('acreedor');
            $taller_23->deudor             = $request->input('deudor');
            $taller_23->descripcion               = $request->input('descripcion');
            $taller_23->direccion              = $request->input('direccion');
            $taller_23->lugar                = $request->input('lugar');
            $taller_23->fecha                = $request->input('fecha');
            $taller_23->save();
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
      }

       public function taller24(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $taller24               = new Taller;
         $taller24->nombre       = 'Taller '.++$valor[1];
         $taller24->enunciado   = $request->input('enunciado');
         $taller24->plantilla_id = $request->input('id_plantilla');
         $taller24->contenido_id = $request->input('contenido_id');
         $taller24->estado       = 0;
         $taller24->save();

           if ($taller24 = true) {
            $a                               = Taller::get()->last();
            $taller_24                       = new TallerOrdenPago;
            $taller_24->taller_id            = $a->id;
            $taller_24->enunciado            = $request->input('enunciado');
            $taller_24->beneficiario               = $request->input('beneficiario');
            $taller_24->comprobante               = $request->input('comprobante');
            $taller_24->cantidad             = $request->input('cantidad');
            $taller_24->firmas               = $request->input('firmas');
            $taller_24->lugar                = $request->input('lugar');
            $taller_24->fecha                = $request->input('fecha');
            $taller_24->save();
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
      }
        public function taller25(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $taller25 = new Taller;
         $taller25->nombre = 'Taller '.++$valor[1];
         $taller25->enunciado            = $request->input('enunciado');
         $taller25->plantilla_id = $request->input('id_plantilla');
         $taller25->contenido_id = $request->input('contenido_id');
         $taller25->estado = 0;
         $taller25->save();

           if ($taller25 = true) {
            $a                               = Taller::get()->last();
            $taller_25                       = new TallerFactura;
            $taller_25->taller_id            = $a->id;
            $taller_25->enunciado            = $request->input('enunciado');
            $taller_25->cliente              = $request->input('cliente');
            $taller_25->ruc                  = $request->input('ruc');
            $taller_25->iva                  = $request->input('iva');
            $taller_25->descuento            = $request->input('descuento');
            $taller_25->remision             = $request->input('remision');
            $taller_25->fecha_emision        = $request->input('fecha_emision');
            $taller_25->save();

             if ($taller_25 = true) {
               $o = TallerFactura::get()->last();              
               foreach ($request->cant as $key=>$v) {
                  $datos=array(
                     'taller_factura_id'=> $o->id,
                     'codigo'=> $request->cod[$key],
                     'cod_auxiliar'=> $request->cod_aux[$key],
                     'cantidad'=> $request->cant[$key],
                     'descripcion'=> $request->desc[$key],
                     'precio' => $request->precio[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  TallerFacturaDato::insert($datos);
               }
             }

      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
      }

       public function taller26(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller26 = new Taller;
         $taller26->nombre = 'Taller '.++$valor[1];
         $taller26->enunciado            = $request->input('enunciado');
         $taller26->plantilla_id = $request->input('id_plantilla');
         $taller26->contenido_id = $request->input('contenido_id');
         $taller26->estado = 0;
         $taller26->save();

           if ($taller26 = true) {
            $a                               = Taller::get()->last();
            $taller_26                       = new TallerNotaVenta;
            $taller_26->taller_id            = $a->id;
            $taller_26->enunciado            = $request->input('enunciado');
            $taller_26->nombre               = $request->input('nombre');
            $taller_26->ruc                  = $request->input('ruc');
            $taller_26->fecha                = $request->input('fecha');
            $taller_26->save();

             if ($taller_26 = true) {
               $o = TallerNotaVenta::get()->last();              
               foreach ($request->cant as $key=>$v) {
                  $datos=array(
                     'taller_nota_venta_id'=> $o->id,
                     'cantidad'=> $request->cant[$key],
                     'descripcion'=> $request->desc[$key],
                     'precio' => $request->precio[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  TallerNotaVentaDato::insert($datos);
               }
             }

      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      }
      }
         public function taller27(Request $request)
      {
        $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $taller27 = new Taller;
         $taller27->nombre = 'Taller '.++$valor[1];
         $taller27->enunciado  = $request->input('enunciado');
         $taller27->plantilla_id = $request->input('id_plantilla');
         $taller27->contenido_id = $request->input('contenido_id');
         $taller27->estado = 0;
         $taller27->save();
      if ($taller27 = true) {
           
            $a                     = Taller::get()->last();
            $taller_27             = new TallerAbreviatura;
            $taller_27->taller_id  = $a->id;
            $taller_27->enunciado  = $request->input('enunciado');
            $taller_27->save();


      if ($taller_27 = true) {
         $o = TallerAbreviatura::get()->last(); 
         $urlimagen1 = [];
         $urlimagen2 = [];
         $files_a = $request->file('col_a');
         $files_b = $request->file('col_b');
 
         foreach ($files_a as $file_a) {
            $nombre = time().'_'.$file_a->getClientOriginalName();
            $ruta = public_path().'/img/talleres';
            $file_a->move($ruta, $nombre);

            $urlimagen1[]= '/img/talleres/'.$nombre;           
         }
         foreach ($files_b as $file_b) {
            $nombre = time().'_'.$file_b->getClientOriginalName();
            $ruta = public_path().'/img/talleres';
            $file_b->move($ruta, $nombre);

            $urlimagen2[]= '/img/talleres/'.$nombre;           
         }

            foreach ($urlimagen1 as  $key=>$v) {
                  $datos=array(
                     'taller_abreviatura_id' => $o->id,
                     'col_a' => $urlimagen1[$key],
                     'col_b'=> $urlimagen2[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  TallerAbreviaturaImg::insert($datos);
               }
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');  
}

}
}

   public function taller31(Request $request)
      {
          $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller31 = new Taller;
         $taller31->nombre = 'Taller '.++$valor[1];
         $taller31->enunciado            = $request->input('enunciado');
         $taller31->plantilla_id = $request->input('id_plantilla');
         $taller31->contenido_id = $request->input('contenido_id');
         $taller31->estado = 0;
         $taller31->save();
          if ($taller31 = true) {
            $a                               = Taller::get()->last();
            $taller_31                       = new TallerCollage;
            $taller_31->taller_id            = $a->id;
            $taller_31->enunciado            = $request->input('enunciado');
            $taller_31->img_num            = $request->input('img_num');
            $taller_31->save();
         }
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');  
         

      }

      public function taller33(Request $request)
      {

         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller33               = new Taller;
         $taller33->nombre       = 'Taller '.++$valor[1];
         $taller33->enunciado    = $request->input('enunciado');
         $taller33->plantilla_id = $request->input('id_plantilla');
         $taller33->contenido_id   = $request->input('contenido_id');
         $taller33->estado       = 0;
         $taller33->save();

          if ($taller33 = true) {
            $a                     = Taller::get()->last();
            $taller_33             = new TallerCelda;
            $taller_33->taller_id  = $a->id;
            $taller_33->enunciado  = $request->input('enunciado');
            $taller_33->palabra_clasificar  = $request->input('palabra_clasificar');
            $taller_33->save();
         }
          if ($taller_33 = true) {
            $c = TallerCelda::get()->last();
               foreach ($request->clasificaciones as $key => $value) {                         //RECORRER TODOS LOS REGISTROS EN EL ARRAY
                   $regis=array(
                     'taller_celda_id'  => $c->id,
                     'clasificaciones'  => $request->clasificaciones[$key],
                     'created_at' => now(),
                     'updated_at' => now(),
                    );
            TallerCeldaClasificacion::insert($regis);                           //GUARDAR CADA REGISTRO EN LA BASE DE DATOS
        }
              foreach ($request->clasificados as $key => $value) {                         //RECORRER TODOS LOS REGISTROS EN EL ARRAY
                   $regis=array(
                     'taller_celda_id'  => $c->id,
                     'clasificados'  => $request->clasificados[$key],
                     'created_at' => now(),
                     'updated_at' => now(),
                    );
            TallerCeldaClasificar::insert($regis);                           //GUARDAR CADA REGISTRO EN LA BASE DE DATOS
        }
          }
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');  
      }


   public function taller34(Request $request)
      {
         $registro               = $request->registro;
         $contenido              = $request->unidad;
         $plantilla              = $request->plantilla;
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $taller34               = new Taller;
         $taller34->nombre       = 'Taller '.++$valor[1];
         $taller34->plantilla_id = $plantilla;
         $taller34->enunciado    = $request->enunciado;
         $taller34->contenido_id = $contenido;
         $taller34->estado       = 0;
         $taller34->save();

          if ($taller34 = true) {
         $a  = Taller::get()->last();
         $debe =[];
         $haber =[];
        foreach ($registro as $key => $value) {                         //RECORRER TODOS LOS REGISTROS EN EL ARRAY
            $regis=array(
                     'taller_id'  => $a->id,
                     'enunciado'  => $key + 1,
                     'created_at' => now(),
                     'updated_at' => now(),
                  );
            TallerTipoSaldo::insert($regis);                           //GUARDAR CADA REGISTRO EN LA BASE DE DATOS
        }
        $register = $a->tallerTipoSaldo;
        foreach ($registro as $key => $value) {                         ////RECORRER TODOS LOS REGISTROS EN EL ARRAY
            foreach ($value['debe'] as $key1 => $value1) {              ////RECORRER TODOS LAS CUENTAS DE DEBE QUE PERTENECEN A UN REGISTRO
                $regis1=array(
                     'taller_tipo_saldo_id'  => $register[$key]->id,
                     'nom_cuenta'        => $value1['nom_cuenta'],
                     'saldo'              => $value1['saldo'],
                     'created_at'         => now(),
                     'updated_at'         => now(),
                  );
                  TipoSaldoDebe::insert($regis1);                             //GURDAR ESAS CUENTAS EN LA TABLA DEBE CON EL ID DEL REGISTRO AL QUE CORRESPONDEN
            }
              foreach ($value['haber'] as $key2 => $value2) {           ////RECORRER TODOS LAS CUENTAS DE HABER QUE PERTENECEN A UN REGISTRO
                $regis2=array(
                     'taller_tipo_saldo_id'  => $register[$key]->id,
                     'nom_cuenta'        => $value2['nom_cuenta'],
                     'saldo'              => $value2['saldo'],
                     'created_at'         => now(),
                     'updated_at'         => now(),
                  );
                  TipoSaldoHaber::insert($regis2);                            //GURDAR ESAS CUENTAS EN LA TABLA HABER CON EL ID DEL REGISTRO AL QUE CORRESPONDEN
            }
        }
         return response(array(                                         //ENVIO DE RESPUESTA
                'success' => true,
                'message' => 'Diario General creado correctamente'
            ),200,[]);
         }
      }
           public function taller35(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
          $valor = explode(" ", $i->nombre);
         $taller35 = new Taller;
         $taller35->nombre = 'Taller '.++$valor[1];
         $taller35->enunciado            = $request->input('enunciado');
         $taller35->plantilla_id = $request->input('id_plantilla');
         $taller35->contenido_id = $request->input('contenido_id');
         $taller35->estado = 0;
         $taller35->save();

           if ($taller35 = true) {
              $datos = [];             
               foreach ($request->activo as $key=>$v) {
                  $datos[]=array(
                     'activo'              => $request->activo[$key],
                     'pasivo'               => $request->pasivo[$key],
                     'patrimonio'           => $request->patrimonio[$key],
                    
                  );
                }

            $a                               = Taller::get()->last();
            $taller_35                       = new TallerEcuacion;
            $taller_35->taller_id            = $a->id;
            $taller_35->enunciado            = $request->input('enunciado');
            $taller_35->datos            = json_encode($datos);
            $taller_35->save();


          
        }

            
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!'); 
      
      }
       public function taller36(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $taller36               = new Taller;
         $taller36->nombre       = 'Taller '.++$valor[1];
         $taller36->enunciado    = $request->input('enunciado');
         $taller36->plantilla_id = $request->input('id_plantilla');
         $taller36->contenido_id   = $request->input('contenido_id');
         $taller36->estado       = 0;
         $taller36->save();

          if ($taller36 = true) {
            $a                    = Taller::get()->last();
            $taller_36            = new TallerAnalizar;
            $taller_36->taller_id = $a->id;
            $taller_36->enunciado = $request->input('enunciado');
            $taller_36->save();
         }

           if ($taller_36 = true) {
               $o = TallerAnalizar::get()->last();              
               foreach ($request->enun as $key=>$v) {
                  $datos=array(
                     'taller_analizar_id'=> $o->id,
                     'enunciado'=> $request->enun[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  TallerAnalizarOp::insert($datos);
               }
                 return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');
             }
      }

   public function balance_inicial(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->tipo   = $request->tipo;
          if ($request->tipo  == 'vertical') {

              $taller_37->balance_inicial_vertical   = true;
             
            }elseif($request->tipo  == 'horizontal'){
              $taller_37->balance_inicial_horizontal = true;
          }
        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->enunciado                 = $request->enunciado;
          $vertical->tipo                      = $request->tipo;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);

         //   if ($taller_37 = true) {

         //       $o = TallerContabilidad::get()->last();              
         //       foreach ($request->enun as $key=>$v) {
         //          $datos=array(
         //             'taller_contabilidad_id'=> $o->id,
         //             'enunciado'=> $request->enun[$key],
         //             'created_at'=> now(),
         //             'updated_at'=> now(),
         //          );
         //          TallerContabilidadOp::insert($datos);
         //       }

         //         return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');
         //     }
      }

         public function kardex(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $kardex               = new Taller;
         $kardex->nombre       = 'Taller '.++$valor[1];
         $kardex->enunciado    = $request->enunciado;
         $kardex->plantilla_id = 37;
         $kardex->contenido_id = $request->contenido_id;
         $kardex->estado       = 0;
         $kardex->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->tipo   = $request->tipo;


          if ($request->tipo  == 'fifo') {
              $taller_37->kardex_fifo   = true;
            }elseif($request->tipo  == 'promedio'){
              $taller_37->kardex_promedio = true;
          }
        $taller_37->save();

        if ($taller_37 = true) {
          $e = TallerModuloContable::get()->last();
           $productos = json_decode($request->transacciones, true);
           
        if ($request->tipo  == 'fifo') {
         foreach ($productos as $key=>$v) {
              $datos=array(
                 'taller_modulo_contable_id' => $e->id,
                 'tipo'                      => 'fifo',
                 'enunciado'                 => $request->enunciado,
                 'nombre'                  => $v['nombre'],
                 'transacciones'             => $v['transacciones'],
                 'created_at'                => now(),
                 'updated_at'                => now(),
                );
              TallerModuloTransaccion::insert($datos);
           }
         }elseif($request->tipo  == 'promedio'){
          foreach ($productos as $key=>$v) {
            $datos=array(
                 'taller_modulo_contable_id' => $e->id,
                 'tipo'                      => 'promedio',
                 'enunciado'                 => $request->enunciado,
                 'nombre'                  => $v['nombre'],
                 'transacciones'             => $v['transacciones'],
                 'created_at'                => now(),
                 'updated_at'                => now(),
                );
              TallerModuloTransaccion::insert($datos);
         }
        
       }
        return response(array(                                      
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }
    }

       public function crearDiario(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->diario_general = true;
        $taller_37->tipo   = 'diario_general';

        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'diario_general';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }

        public function crearMayor(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->mayor_general = true;
        $taller_37->tipo   = 'mayor_general';

        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'mayor_general';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }

       public function crearBalanceCompro(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->balance_comprobacion = true;
        $taller_37->tipo   = 'balance_comprobacion';

        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'balance_comprobacion';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }
         public function crearHojaTrabajo(Request $request)
      {
        $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->hoja_trabajo = true;
        $taller_37->tipo   = 'hoja_trabajo';   
        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'hoja_trabajo';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }
    public function crearBalanceAjustado(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->balance_comprobacion_ajustado = true;
        $taller_37->tipo   = 'balance_comprobacion_ajustado';   
        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'balance_comprobacion_ajustado';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }

          public function crearEtadoResultado(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->estado_resultado = true;
        $taller_37->tipo   = 'estado_resultado';       
        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'estado_resultado';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }
      public function crearBalanceGeneral(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->tipo   = 'balance_general';       
        $taller_37->balance_general = true;
        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'balance_general';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();



       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }
      public function crearAsientosCierre(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->asientos_cierre = true;
        $taller_37->tipo   = 'asientos_cierre';       

        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'asientos_cierre';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }

         public function crearLibroCaja(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
    $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->librocaja = true;
        $taller_37->tipo   = 'librocaja';       

        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'librocaja';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }
      public function crearConciliacion(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->conciliacionbancaria = true;
        $taller_37->tipo   = 'conciliacionbancaria';       

        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'conciliacionbancaria';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }
    public function crearArqueo(Request $request)
      {
        $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->arqueocaja = true;
        $taller_37->tipo   = 'arqueocaja';       

        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'arqueocaja';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }
      public function libroBanco(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->librobanco = true;
        $taller_37->tipo   = 'librobanco';       

        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'librobanco';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }
       public function retencionIva(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->retencioniva = true;
        $taller_37->tipo   = 'retencioniva';       

        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'retencioniva';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }
             public function crearNomina(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->nominaempleados = true;
        $taller_37->tipo   = 'nominaempleados';       

        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'nominaempleados';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }
        public function crearProvision(Request $request)
      {
        $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'individual';
             if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          } 
        $taller_37->provisiondebeneficio = true;
        $taller_37->tipo   = 'provisiondebeneficio';       

        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
          $vertical                            = new TallerModuloTransaccion;
          $vertical->taller_modulo_contable_id = $e->id;
          $vertical->tipo                      = 'provisiondebeneficio';
          $vertical->enunciado                 = $request->enunciado;
          $vertical->transacciones             = $request->transacciones;
          $vertical->save();
       }
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente'
                ),200,[]);
      }


       public function tallerConcatenado(Request $request)
      {
        

         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $balance_inicial               = new Taller;
         $balance_inicial->nombre       = 'Taller '.++$valor[1];
         $balance_inicial->enunciado    = $request->enunciado;
          
         $balance_inicial->plantilla_id = 37;
         $balance_inicial->contenido_id = $request->contenido_id;
         $balance_inicial->estado       = 0;
         $balance_inicial->save();
         // $modulos = $request->modulos;

        $a                    = Taller::get()->last();
        $taller_37            = new TallerModuloContable;
        $taller_37->taller_id = $a->id;
        $taller_37->enunciado = $request->enunciado;
        $taller_37->metodo    = 'concatenado';
        $taller_37->tipo      = 'concatenado';       
        if ($request->hasFile('documento')) {
            $archivo        = $request->file('documento');
            $nombre        = time().'_'.$archivo->getClientOriginalName();
            $ruta          = public_path().'/archivos/';
            $archivo->move($ruta, $nombre);
            $urlarchivo     = '/archivos/'.$nombre;
            $taller_37->archivo   = $urlarchivo;
          }     
        $taller_37->modulos      = $request->modulos;       
        $taller_37->save();

        if ($taller_37 = true) {
          $e                                   = TallerModuloContable::get()->last();
           if (isset($request->balance_horizontal)  ) {
          $binicial                            = new TallerModuloTransaccion;
          $binicial->taller_modulo_contable_id = $e->id;
          $binicial->tipo                      = 'horizontal';
          $binicial->enunciado                 = $request->enunciado;
          $binicial->transacciones             = $request->balance_horizontal;
          $binicial->save();
        }
          if (isset($request->productos)  ) {
            $productos = json_decode($request->productos, true);
                  foreach ($productos as $key=>$v) {
                    $datos=array(
                       'taller_modulo_contable_id' => $e->id,
                       'tipo'                      => 'fifo',
                       'enunciado'                 => $request->enunciado,
                       'nombre'                  => $v['nombre'],
                       'transacciones'             => $v['transacciones'],
                       'created_at'                => now(),
                       'updated_at'                => now(),
                      );
                    TallerModuloTransaccion::insert($datos);
                    }
          }
           if (isset($request->diario_general)  ) {

          $diariogeneral                            = new TallerModuloTransaccion;
          $diariogeneral->taller_modulo_contable_id = $e->id;
          $diariogeneral->tipo                      = 'diario_general';
          $diariogeneral->enunciado                 = $request->enunciado;
          $diariogeneral->transacciones             = $request->diario_general;
          $diariogeneral->save();
}
  if (isset($request->conciliacionbancaria)  ) {
          $diariogeneral                            = new TallerModuloTransaccion;
          $diariogeneral->taller_modulo_contable_id = $e->id;
          $diariogeneral->tipo                      = 'conciliacionbancaria';
          $diariogeneral->enunciado                 = $request->enunciado;
          $diariogeneral->transacciones             = $request->conciliacionbancaria;
          $diariogeneral->save();
          }

      if (isset($request->arqueocaja)  ) {
          $diariogeneral                            = new TallerModuloTransaccion;
          $diariogeneral->taller_modulo_contable_id = $e->id;
          $diariogeneral->tipo                      = 'arqueocaja';
          $diariogeneral->enunciado                 = $request->enunciado;
          $diariogeneral->transacciones             = $request->arqueocaja;
          $diariogeneral->save();
}   
       }
     
        return response(array(                                         //ENVIO DE RESPUESTA
                    'success' => true,
                    'estado' => 'guardado',
                    'message' => 'Taller creado correctamente',
                ),200,[]);
      }


       public function taller38(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller38               = new Taller;
         $taller38->nombre       = 'Taller '.++$valor[1];
         $taller38->enunciado    = $request->input('enunciado');
         $taller38->plantilla_id = $request->input('id_plantilla');
         $taller38->contenido_id   = $request->input('contenido_id');
         $taller38->estado       = 0;
         $taller38->save();

          if ($taller38 = true) {
            $a                    = Taller::get()->last();
            $taller_38            = new TallerALectura;
            $taller_38->taller_id = $a->id;
            $taller_38->enunciado = $request->input('enunciado');
            $taller_38->lectura = $request->input('lectura');
            $taller_38->save();
         }
           if ($taller_38 = true) {
               $o = TallerALectura::get()->last();              
               foreach ($request->enun as $key=>$v) {
                  $datos=array(
                     'taller_a_lectura_id'=> $o->id,
                     'enunciado'=> $request->enun[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  TallerALecturaOp::insert($datos);
               }

                 return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');
             }
      }
       public function taller39(Request $request)
      {
        $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller39               = new Taller;
         $taller39->nombre       = 'Taller '.++$valor[1];
         $taller39->enunciado    = $request->input('enunciado');
         $taller39->plantilla_id = $request->input('id_plantilla');
         $taller39->contenido_id   = $request->input('contenido_id');
         $taller39->estado       = 0;
         $taller39->save();

          if ($taller39 = true) {
            $a                    = Taller::get()->last();
            $taller_39            = new TallerPalabra;
            $taller_39->taller_id = $a->id;
            $taller_39->enunciado = $request->input('enunciado');
            $taller_39->letra = $request->input('palabra');
            $taller_39->save();
         }

         return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');

      }
         public function taller40(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller40               = new Taller;
         $taller40->nombre       = 'Taller '.++$valor[1];
         $taller40->enunciado    = $request->input('enunciado');
         $taller40->plantilla_id = $request->input('id_plantilla');
         $taller40->contenido_id   = $request->input('contenido_id');
         $taller40->estado       = 0;
         $taller40->save();

          if ($taller40 = true) {
            $a                    = Taller::get()->last();
            $taller_40            = new TallerIdenTransa;
            $taller_40->taller_id = $a->id;
            $taller_40->enunciado = $request->input('enunciado');
            $taller_40->save();
         }

           if ($taller_40 = true) {
               $o = TallerIdenTransa::get()->last();              
               foreach ($request->enun as $key=>$v) {
                  $datos=array(
                     'taller_iden_transa_id'=> $o->id,
                     'enunciado'=> $request->enun[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  TallerIdenTransaOp::insert($datos);
               }
                 return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');
             }
      }
      public function taller42(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller42               = new Taller;
         $taller42->nombre       = 'Taller '.++$valor[1];
         $taller42->enunciado    = $request->input('enunciado');
         $taller42->plantilla_id = $request->input('id_plantilla');
         $taller42->contenido_id   = $request->input('contenido_id');
         $taller42->estado       = 0;
         $taller42->save();

           if ($taller42 = true) {
               $o = Taller::get()->last();              
               foreach ($request->enun as $key=>$v) {
                  $datos=array(
                     'taller_id'=> $o->id,
                     'idea'=> $request->enun[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  TallerOrdenIdea::insert($datos);
               }
                 return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');
             }
      }

       public function taller43(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller43               = new Taller;
         $taller43->nombre       = 'Taller '.++$valor[1];
         $taller43->enunciado    = $request->input('enunciado');
         $taller43->plantilla_id = $request->input('id_plantilla');
         $taller43->contenido_id   = $request->input('contenido_id');
         $taller43->estado       = 0;
         $taller43->save();

           if ($taller43 = true) {
               $o = Taller::get()->last(); 
                $taller_43            = new TallerMConceptual;
                $taller_43->taller_id = $o->id;
                $taller_43->enunciado = $request->input('enunciado');
                $taller_43->concepto  = $request->input('concepto');
                $taller_43->cantidad  = $request->input('cantidad');
                $taller_43->save();             
   
                 return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');
             }
      }

        public function taller44(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller44               = new Taller;
         $taller44->nombre       = 'Taller '.++$valor[1];
         $taller44->enunciado    = $request->input('enunciado');
         $taller44->plantilla_id = $request->input('id_plantilla');
         $taller44->contenido_id   = $request->input('contenido_id');
         $taller44->estado       = 0;
         $taller44->save();

           if ($taller44 = true) {
                $o                    = Taller::get()->last(); 
                $taller_44            = new TallerEscribirCuenta;
                $taller_44->taller_id = $o->id;
                $taller_44->enunciado = $request->input('enunciado');
                $taller_44->cuenta    = $request->input('cuenta');
                $taller_44->save();             
   
                 return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');
             }
      }
          public function taller45(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller45               = new Taller;
         $taller45->nombre       = 'Taller '.++$valor[1];
         $taller45->enunciado    = $request->input('enunciado');
         $taller45->plantilla_id = $request->input('id_plantilla');
         $taller45->contenido_id   = $request->input('contenido_id');
         $taller45->estado       = 0;
         $taller45->save();

           if ($taller45 = true) {
                $o                    = Taller::get()->last(); 
                $taller_45            = new TallerSopaLetra;
                $taller_45->taller_id = $o->id;
                $taller_45->enunciado = $request->input('enunciado');
                $taller_45->palabras    = $request->input('palabras');
                $taller_45->save();             
   
                 return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');
             }
      }
        public function taller47(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller47               = new Taller;
         $taller47->nombre       = 'Taller '.++$valor[1];
         $taller47->enunciado    = $request->input('enunciado');
         $taller47->plantilla_id = $request->input('id_plantilla');
         $taller47->contenido_id   = $request->input('contenido_id');
         $taller47->estado       = 0;
         $taller47->save();

           if ($taller47 = true) {
                $o                    = Taller::get()->last(); 
                $taller_47            = new TallerRAlternativa;
                $taller_47->taller_id = $o->id;
                $taller_47->enunciado = $request->input('enunciado');
                $taller_47->alternativa_correcta = $request->input('alternativa_correcta');
                $taller_47->save(); 

                $a    = TallerRAlternativa::get()->last(); 

                  foreach ($request->enunciados as $key=>$v) {
                  $datos=array(
                     'taller_r_alternativa_id'=> $a->id,
                     'enunciado'=> $request->enunciados[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  RAEnunciado::insert($datos);
               }
                  foreach ($request->definicion as $key=>$v) {
                  $datos=array(
                     'taller_r_alternativa_id'=> $a->id,
                     'definicion'=> $request->definicion[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  RADefinicion::insert($datos);
               }
                foreach ($request->alternativas as $key=>$v) {
                  $datos=array(
                     'taller_r_alternativa_id'=> $a->id,
                     'alternativa'=> $request->alternativas[$key],
                     'created_at'=> now(),
                     'updated_at'=> now(),
                  );
                  RAAlternativa::insert($datos);
               }

                 return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');
             }
      }
      public function taller48(Request $request)
      {
          $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller48 = new Taller;
         $taller48->nombre = 'Taller '.++$valor[1];
         $taller48->enunciado            = $request->input('enunciado');
         $taller48->plantilla_id = $request->input('id_plantilla');
         $taller48->contenido_id = $request->input('contenido_id');
         $taller48->estado = 0;
         $taller48->save();
          if ($taller48 = true) {
            $a                               = Taller::get()->last();
            $taller_48                       = new TallerArchivo;
            $taller_48->taller_id            = $a->id;
            $taller_48->enunciado            = $request->input('enunciado');
            $taller_48->ar_num                = $request->input('ar_num');
            $taller_48->save();
         }
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');  
         

      }
        public function taller49(Request $request)
      {
         $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $taller49               = new Taller;
         $taller49->nombre       = 'Taller '.++$valor[1];
         $taller49->enunciado    = $request->input('enunciado');
         $taller49->plantilla_id = $request->input('id_plantilla');
         $taller49->contenido_id = $request->input('contenido_id');
         $taller49->estado       = 0;
         $taller49->save();
          if ($taller49 = true) {
            $a                    = Taller::get()->last();
            $taller_49            = new PlanCuenta;
            $taller_49->taller_id = $a->id;
            $taller_49->enunciado = $request->input('enunciado');
            $taller_49->detalles  = $request->input('detalles');
            $taller_49->save();
         }
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');  
         

      }
      public function tallerprecon(Request $request)
      {
        $i = Taller::where('contenido_id', $request->input('contenido_id'))->get()->last();//cambios
        $valor = explode(" ", $i->nombre);
         $preconnfifurado               = new Taller;
         $preconnfifurado->nombre       = 'Taller '.++$valor[1];
         $preconnfifurado->enunciado    = $request->input('enunciado');
         $preconnfifurado->plantilla_id = $request->input('id_plantilla');
         $preconnfifurado->contenido_id = $request->input('contenido_id');
         $preconnfifurado->estado       = 0;
         $preconnfifurado->save();
      return redirect()->route('admin.create')->with('datos', 'Taller Creado Correctamente!');  

      }

}