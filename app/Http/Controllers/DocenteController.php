<?php

namespace App\Http\Controllers;

use App\Archivodocente;
use App\Assignment;
use APp\User;
use App\Contenido;
use App\Curso;
use App\Distribuciondo;
use App\Distribucionmacu;
use App\Distrima;
use App\Documento;
use App\Http\Controllers\Controller;
use App\Instituto;
use App\Materia;
use App\Nivel;
use App\Taller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Illuminate\Support\Facades\Hash;

class DocenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('docente');
    }

   public function Perfil()
    {
              $user = User::find(Auth::id());

                $au = Distribuciondo::join('distribucionmacu_materia', 'distribucionmacu_materia.materia_id', '=', 'distribuciondos.materia_id')
                ->join('distribucionmacus', 'distribucionmacus.id', '=', 'distribucionmacu_materia.distribucionmacu_id')
                ->join('cursos', 'cursos.id', '=', 'distribucionmacus.curso_id')
                ->join('materias', 'materias.id', '=', 'distribucionmacu_materia.materia_id')
                ->select('distribuciondos.*','cursos.nombre as nombre_curso' ,'materias.nombre as nombre_materia')
                ->where('distribuciondos.user_id', $user->id)

              
                ->get();
                // return $au;
                

                $materias =[];
                foreach ($au as $materia) {
                  $materias[] =array(
                    "materia_id" => $materia->materia_id,
                    'materia' => $materia->nombre_materia,
                    "curso" => $materia->nombre_curso,
                    "paralelos" => $paralelos = DB::table('distribuciondo_nivel')->select('nivel_nombre')->where('distribuciondo_id', $materia->id)->orderBy('nivel_nombre', 'asc')->get(),
                  );
                }
                // return $materias;
                // if ($au == null) {
                // return redirect()->route('welcome'); 
                
                // }
                // return $au;
                
                if (isset($au->materias)) {
                    $ids =[];
                        foreach ($au->materias as $value) {
                            foreach ($value->contenidos as $conte) {
                            $ids[] = $conte->id;
                                
                    }
                }
                // $materias = $au->materias;
                $users = DB::table('tallers')
                ->join('taller_user', 'tallers.id', '=', 'taller_user.taller_id')
                ->join('users', 'users.id', '=', 'taller_user.user_id')
                ->join('cursos', 'users.curso_id', '=', 'cursos.id')
                ->join('nivels', 'users.nivel_id', '=', 'nivels.id')
                ->join('contenidos', 'contenidos.id', '=', 'tallers.contenido_id')
                ->join('materias', 'materias.id', '=', 'contenidos.materia_id')
                ->whereIn('tallers.contenido_id', $ids)
                // ->wherein('tallers.contenido_id','==', 1)
                ->where('taller_user.status', 'completado')
                ->select('tallers.*','taller_user.*','cursos.nombre as cur_nombre','nivels.nombre as nivel_nombre', 'materias.nombre as mate_nombre', 'contenidos.nombre as conte_name','users.name as alumno')
                ->get();
            

                    $calificado = DB::table('tallers')
                    ->join('taller_user', 'tallers.id', '=', 'taller_user.taller_id')
                    ->join('users', 'users.id', '=', 'taller_user.user_id')
                    ->join('cursos', 'users.curso_id', '=', 'cursos.id')
                    ->join('nivels', 'users.nivel_id', '=', 'nivels.id')
                    
                    ->join('contenidos', 'contenidos.id', '=', 'tallers.contenido_id')
                    ->join('materias', 'materias.id', '=', 'contenidos.materia_id')
                    ->whereIn('tallers.contenido_id', $ids)
                    // ->wherein('tallers.contenido_id','==', 1)
                    ->where('taller_user.status', 'calificado')
                    ->select('tallers.*','taller_user.*','cursos.nombre as cur_nombre' ,'nivels.nombre as nivel_nombre',  'materias.nombre as mate_nombre', 'contenidos.nombre as conte_name','users.name as alumno')
                    ->get();


                    // return $users;
              return view('Docente.Pcurso', compact('users','au', 'calificado', 'materias')); //ruta docente
      }else{


            return view('Docente.Pcurso', compact('materias')); //ruta docente

      } 
    }
    public function index()
    {
        // $p = Post::where('instituto', Auth::user()->instituto_id)->get();
      
         $p = Post::orderBy('id','Desc')->where('instituto_id', Auth::user()->instituto_id)->paginate(5);
             
                return view('Docente.indexd',compact('p'));
     
    }
    
    public function contenidos($id)
    {
        // todos los datos de la bd
        $user =  User::findorfail( Auth::id());
       
    
          $curso = Distribuciondo::join('distribucionmacu_materia', 'distribucionmacu_materia.materia_id', '=', 'distribuciondos.materia_id')
            ->join('distribucionmacus', 'distribucionmacus.id', '=', 'distribucionmacu_materia.distribucionmacu_id')
            ->join('cursos', 'cursos.id', '=', 'distribucionmacus.curso_id')
            ->join('materias', 'materias.id', '=', 'distribucionmacu_materia.materia_id')
            ->select('distribuciondos.*','cursos.nombre as nombre_curso' ,'materias.nombre as nombre_materia')
            ->where('distribucionmacu_materia.materia_id', $id)
            ->where('distribuciondos.user_id', $user->id)->first();

          $paralelos = Distribuciondo::join('distribuciondo_nivel', 'distribuciondo_nivel.distribuciondo_id', '=', 'distribuciondos.id')
            // ->join('nivels', 'distribuciondo_nivel.nivel_id', '=', 'nivels.id')
            ->select('distribuciondo_nivel.*')
            ->where('distribuciondos.user_id', $user->id)
            ->where('distribuciondos.materia_id', $id)
            ->orderBy('nivel_nombre', 'asc')
            ->get();

          // return $paralelos;


        // $users = DB::table('tallers')
        //     ->join('taller_user', 'tallers.id', '=', 'taller_user.taller_id')
        //     ->join('users', 'users.id', '=', 'taller_user.user_id')
        //     ->join('cursos', 'users.curso_id', '=', 'cursos.id')
        //     ->join('nivels', 'users.nivel_id', '=', 'nivels.id')

        //     ->join('contenidos', 'contenidos.id', '=', 'tallers.contenido_id')
        //     ->join('materias', 'materias.id', '=', 'contenidos.materia_id')
        //     ->where('contenidos.materia_id', $id)
        //     // ->wherein('tallers.contenido_id','==', 1)
        //     ->where('taller_user.status', 'completado')
        //     ->select('tallers.*','taller_user.*','cursos.nombre as cur_nombre', 'nivels.nombre as nivel_nombre','materias.nombre as mate_nombre', 'contenidos.nombre as conte_name','users.name as alumno')
        //     ->get();

        //     $calificado = DB::table('tallers')
        //     ->join('taller_user', 'tallers.id', '=', 'taller_user.taller_id')
        //     ->join('users', 'users.id', '=', 'taller_user.user_id')
        //     ->join('cursos', 'users.curso_id', '=', 'cursos.id')
        //     ->join('nivels', 'users.nivel_id', '=', 'nivels.id')

        //     ->join('contenidos', 'contenidos.id', '=', 'tallers.contenido_id')
        //     ->join('materias', 'materias.id', '=', 'contenidos.materia_id')
        //     ->where('contenidos.materia_id', $id)
        //     // ->wherein('tallers.contenido_id','==', 1)
        //     ->where('taller_user.status', 'calificado')
        //     ->select('tallers.*','taller_user.*' ,'cursos.nombre as cur_nombre','nivels.nombre as nivel_nombre', 'materias.nombre as mate_nombre', 'contenidos.nombre as conte_name','users.name as alumno')
        //     ->get();

            // return $calificado;

             $materia =Materia::where('id', $id)->firstOrfail();
          
            
           $cons = Contenido::join('documentos',"documentos.contenido_id","=","contenidos.id")
           ->where('contenidos.materia_id', $id)
           ->select("documentos.*","contenidos.nombre as nombre_c")
           ->get();

             //return $cons;
        return view ('Docente.contenidodocente',compact('user','materia','cons', 'paralelos', 'curso'));

    }

    function paralelo($id, $nivel)
    {
      $paralelo = Nivel::find($nivel);
      $materia = Materia::find($id);

         $users = DB::table('tallers')
            ->join('taller_user', 'tallers.id', '=', 'taller_user.taller_id')
            ->join('users', 'users.id', '=', 'taller_user.user_id')
            ->join('distribucionmacus', 'distribucionmacus.id', '=', 'users.distribucionmacu_id')
            ->join('cursos', 'cursos.id', '=', 'distribucionmacus.curso_id')
            ->join('nivels', 'users.nivel_id', '=', 'nivels.id')

            ->join('contenidos', 'contenidos.id', '=', 'tallers.contenido_id')
            ->join('materias', 'materias.id', '=', 'contenidos.materia_id')
            ->where('contenidos.materia_id', $id)
            ->where('users.nivel_id', $nivel)
            // ->wherein('tallers.contenido_id','==', 1)
            ->where('taller_user.status', 'completado')
            ->select('tallers.*','taller_user.*','cursos.nombre as cur_nombre', 'nivels.nombre as nivel_nombre','materias.nombre as mate_nombre', 'contenidos.nombre as conte_name','users.name as alumno', 'users.apellido as apelli')
            ->get();
            // return $users;
            // 
            $calificado = DB::table('tallers')
            ->join('taller_user', 'tallers.id', '=', 'taller_user.taller_id')
            ->join('users', 'users.id', '=', 'taller_user.user_id')
            ->join('distribucionmacus', 'distribucionmacus.id', '=', 'users.distribucionmacu_id')
            ->join('cursos', 'cursos.id', '=', 'distribucionmacus.curso_id')
            ->join('nivels', 'users.nivel_id', '=', 'nivels.id')

            ->join('contenidos', 'contenidos.id', '=', 'tallers.contenido_id')
            ->join('materias', 'materias.id', '=', 'contenidos.materia_id')
            ->where('contenidos.materia_id', $id)
            ->where('users.nivel_id', $nivel)
            // ->wherein('tallers.contenido_id','==', 1)
            ->where('taller_user.status', 'calificado')
            ->select('tallers.*','taller_user.*','cursos.nombre as cur_nombre', 'nivels.nombre as nivel_nombre','materias.nombre as mate_nombre', 'contenidos.nombre as conte_name','users.name as alumno', 'users.apellido as apelli')
            ->get();
            
     return view ('Docente.paralelo', compact('materia', 'paralelo', 'users', 'calificado'));
      
    }
    public function cursos($id)
    {
        $materia =Materia::where('id', $id)->firstOrfail(); 
       
        $curso = Curso::get();
        $assignment= Assignment::get();
        $mate = $materia->assignments;
        
     return view ('Docente.cursos', compact('materia','curso', 'mate','assignment'));

    }
    public function talleres($id)
    {
        $contenidos=Contenido::where('materia_id', $id)->get();
        $materia = Materia::select('nombre')->where('id', $id)->first();
      
        $tallers=Taller::paginate(10);
        $talleres =[];
        foreach ($contenidos as $key => $value) {
            $talleres[$key] = array(
            'nombre' => $value->nombre,
            'talleres' =>$value->tallers
        );
        }
       
     return view('Docente.talleres',compact('tallers', 'contenidos', 'talleres', 'id', 'materia'));

    }
        public function resueltos($id)
    {
         $user =  User::findorfail( Auth::id());

        $contenidos= Contenido::get();
        $materia = Materia::where('id', $id)->first();
      

        $completados = $user->tallers;
        // return $completados;
          $ids = [];
          foreach($completados as $act){
                $ids[]=$act->id;
            }

        $tallers=Taller::whereNotIn('id', $ids)->get();
        // return $tallers;

        // $talleres =[];
        // foreach ($contenidos as $key => $value) {
        //     $talleres[$key] = array(
        //     'nombre' => $value->nombre,
        //     'talleres' =>$value->tallers
        // );
        // }
       
     return view('Docente.talleresresueltos',compact('tallers', 'contenidos', 'id', 'materia', 'completados'));

    }
    public function registro(Request $request)
    {
            $contenidos=Contenido::where('materia_id', $request->materia)->get();
            $talleres =[];
            
            $taller = Taller::find($request->taller_id);
            $estado = $request->estado;
            // return $estado;
            if ($estado == true) {
                $taller->estado = 1; 
                $taller->fecha_entrega = $request->fecha; 
                $taller->save(); 

                foreach ($contenidos as $key => $value) {
                    $talleres[$key] = array(
                    'nombre' => $value->nombre,
                    'talleres' =>$value->tallers
                );

                }

                return response(array(
                        'success' => true,
                        'message' => 'Taller activado correctamente',
                        'talleres' => $talleres

                    ),200,[]);  

            }elseif ($estado == false) {

        $taller->estado = 0; 
        $taller->fecha_entrega = $request->fecha; 
        $taller->save();  
          foreach ($contenidos as $key => $value) {
            $talleres[$key] = array(
            'nombre' => $value->nombre,
            'talleres' =>$value->tallers
        );
            }
                return response(array(
                        'success' => true,
                        'message' => 'Taller desactivado correctamente',
                        'talleres' => $talleres
                        
                    ),200,[]);   
            }

    }



    public function VerPDF($id){

        $contenido =Documento::where('id', $id)->firstOrfail();
         return \view('Docente.archivopdf',['contenido'=>$contenido]);
  
    }

    public function VerPDF2($id){

        $contenido =Documento::where('id', $id)->firstOrfail();
         return \view('Docente.archivopdf2',['contenido'=>$contenido]);
  
    }


    public function password(){

        return view('Docente.password');
    }
  

    public function updatep(Request $request)
    {

            //dd($request);
      /////////////////////////////////////////////////////////////////////////////////////
      //////////////////////////////////METODO UNO/////////////////////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////
            //metodo funcional 1 pero no verifica el password anterior

      $request->validate([
        // 'password' => ['required'],
        'newpassword' => ['required', 'string', 'min:8', 'confirmed'],
        'newpassword_confirmation'=>['required']
      ]); 
      
        $request->user()->fill([
            'password' => Hash::make($request->newpassword)
        ])->save();

        return redirect('sistema/homedoc')->with('Password actualizado');
          

    }

      /////////////////////////////////////////////////////////////////////////////////////
      //////////////////////////////////Post/////////////////////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////

     
  public function PostD()
  {

    $materias = Distribuciondo::join('distribucionmacu_materia', 'distribucionmacu_materia.materia_id', '=', 'distribuciondos.materia_id')
    ->join('distribucionmacus', 'distribucionmacus.id', '=', 'distribucionmacu_materia.distribucionmacu_id')
    ->join('cursos', 'cursos.id', '=', 'distribucionmacus.curso_id')
    ->join('materias', 'materias.id', '=', 'distribucionmacu_materia.materia_id')
    ->select('distribuciondos.*', 'cursos.nombre as nombre_curso', 'materias.nombre as nombre_materia')
    ->where('distribuciondos.user_id', Auth::id())
    ->get();

     //return $materias;
     return \view('Docente.postdocente',compact('materias'));
  
  
  }



  public function stored(Request $request)
  {
      $request->validate([
          'nombre'              =>  'required|string|max:60',
          'user_id'             =>  'required|integer',
          'abstract'            =>  'required|max:500',
          'body'                =>  'required',    
          'image'            =>  'image|dimensions:min_width=1200, max_with=1200, min_height=490, max_height=490|mimes:jpeg,jpg,png',
        
      ]);

        $urlimage=[];
      if($request->hasFile('image')){

          $image=$request->file('image');
          $nombre=time().$image->getClientOriginalName();
          $ruta= public_path().'/imagenes';
          $image->move($ruta,$nombre);
          $urlimage['url']='/imagenes/'.$nombre;
      }

      $post =New Post;
      $post->user_id  = e($request->user_id);
      $post->instituto_id= Auth::user()->instituto_id;
      $post->materia_id   = e($request->materia);
      $post->nivel_id   = e($request->paralelos);
      $post->nombre   = e($request->nombre);
      $post->abstract = e($request->abstract);
      $post->body = e($request->body);

      $post->save();

      $post->image()->create($urlimage);

      return redirect('sistema/homedoc')->with('Post Creado!');

  }

  public function destroyped(Post $post)
  {
      $post = Post::findOrFail($post->id)->delete();
 

      return redirect('sistema/homedoc')->with('Post Eliminado!');
  }

     /////////////////////////////////////////////////////////////////////////////////////
      //////////////////////////////////FIN POST/////////////////////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////


       /////////////////////////////////////////////////////////////////////////////////////
      //////////////////////////////////METODO ARCHIVOS DOCENTE/////////////////////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////


      public function Archivos_docente()
      {
        $doc = Archivodocente::where('user_id', Auth::id())->get();
         //   $doc = Archivodocente::all();
        // return $doc;
       return \view('Docente.contenido.doc', compact('doc'));
      }
    
      public function Doc_crear()
      {
        

          $au = User::find(Auth::id())->distribuciondos;
        //  $materias = Distribuciondo::where('materia_id', Auth::id())->get();
          $materias = Distribuciondo::join('distribucionmacu_materia', 'distribucionmacu_materia.materia_id', '=', 'distribuciondos.materia_id')
          ->join('distribucionmacus', 'distribucionmacus.id', '=', 'distribucionmacu_materia.distribucionmacu_id')
          ->join('cursos', 'cursos.id', '=', 'distribucionmacus.curso_id')
          ->join('materias', 'materias.id', '=', 'distribucionmacu_materia.materia_id')
          ->select('distribuciondos.*', 'cursos.nombre as nombre_curso', 'materias.nombre as nombre_materia')
          ->where('distribuciondos.user_id', Auth::id())
          ->get();
        // dd($au);
       // return $materias;

        //$materias= Distribuciondo::where('materia_id',Auth::id())->get();
           
         return \view('Docente.contenido.creardoc', compact('au','materias'));
      }
    
      public function Guardardoc(Request $request){

       // return $request->all();
        $request->validate([

            'nombre'      => 'required|string|max:150',
            'descripcion' => 'required|string|max:250',
            'materia'     =>'required',
            'paralelos'     =>'required',
            'archivo'  => 'required|mimes:jpg,jpeg,gif,png,xls,xlsx,doc,docx,pdf|max:100000',
            
        ]);
     

        if($request->hasFile('archivo')){

            $archivo=$request->file('archivo');
            $nombre=time().$archivo->getClientOriginalName();
            $ruta= public_path().'/documentodoc';
            $archivo->move($ruta,$nombre);
            $urlarchivo['url']='/documentodoc/'.$nombre;
         }
        
         $d = new Archivodocente;
         $d->user_id= Auth::id();
         $d->nombre = $request->nombre;
         $d->nivel_id = $request->paralelos;
         $d->descripcion =$request->descripcion;    
         $d->materia_id = $request->materia;
         
             
         $d->save();

         $d->documentodoc()->create($urlarchivo);

          
         return redirect('sistema/docente/archivos-update')->with('success','Documento Subido Exitosamente!');

      }


      public function docshow(Archivodocente $archivodocente){
       
        $au = User::find(Auth::id())->distribuciondos;
      
        return \view('Docente.contenido.showdoc', compact('au','archivodocente'));

      
       
      }

      public function docedit(Archivodocente $archivodocente){

        $au = User::find(Auth::id())->distribuciondos;
        

       

        return \view('Docente.contenido.editdoc', compact('au','archivodocente'));

      }

      public function docupdate(Request $request, Archivodocente $archivodocente){

        $request->validate([

            'nombre'      => 'string|max:150',
            'descripcion' => 'string|max:250',
            'archivo'  => 'mimes:jpg,jpeg,gif,png,xls,xlsx,doc,docx,pdf|max:50000',
            
        ]);

        if($request->hasFile('archivo')){

            $archivo=$request->file('archivo');
            $nombre=time().$archivo->getClientOriginalName();
            $ruta= public_path().'/documentodoc';
            $archivo->move($ruta,$nombre);
            $urlarchivo['url']='/documentodoc/'.$nombre;
         }

         $archivodocente->update($request->all());

         if ($request->hasFile('archivo')){
            $archivodocente->documentodoc()->delete();
        }

        $archivodocente->save();

        if ($request->hasFile('archivo')){
            $archivodocente->documentodoc()->create($urlarchivo);
        }

      
         $archivodocente->save();


         return redirect('sistema/docente/archivos-update')->with('success','Documento Actualizado Exitosamente!');

     }


      public function destroy(Archivodocente $archivodocente)
      {
          
        $archivodocente =Archivodocente::findOrFail($archivodocente->id)->delete();

       
        return redirect('sistema/docente/archivos-update')->with('success','Documento Eliminado Exitosamente!');

      }


      public function VerDoc(Archivodocente $archivodocente){

        $contenido =Archivodocente::where('id', $archivodocente->id)->firstOrfail();
         return \view('Docente.contenido.documentos.documentopdf',compact('archivodocente','contenido'));
  
    }
      
  

}