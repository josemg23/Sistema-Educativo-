<?php

namespace App\Http\Controllers;


use App\Archivodocente;
use App\Assignment;
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
use App\Post;
use App\Taller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class EstudianteController extends Controller
{

      public function __construct()
    {
        
    $this->middleware('auth');
        $this->middleware('estudiante');
    }

    public function index()
    {
     

        $au =  auth()->user()->assignmets;
         if ($au == null) {
         return view('errors.error'); //ruta estudiante //ruta estudiante       
             
        }
      
        $p = Post::orderBy('id','Desc')
        ->where('instituto_id', Auth::user()->instituto_id)
        ->where('distribucionmacu_id',Auth::user()->distribucionmacu_id)
        ->where('nivel_id',Auth::user()->nivel_id)->paginate(5);
      
       
        return view('Estudiante.indexes',compact('p'));
           
    }

    public function Postdocentes(){
      $p2 = Post::orderBy('id','Desc')
      ->where('instituto_id', Auth::user()->instituto_id)
      //->where('distribucionmacu_id',Auth::user()->distribucionmacu_id)
      ->where('nivel_id',Auth::user()->nivel_id)->paginate(5);
  
     
      return view('Estudiante.postdocentes',compact('p2'));
    }

   
    public function show(User $user){
        $usuario = User::find(Auth::id());
        $curso   = Distribucionmacu::find($usuario->distribucionmacu_id);

        $materias = Assignment::join("assignment_materia", "assignment_materia.assignment_id", "=", "assignments.id")
        ->join("materias", "materias.id", "=", "assignment_materia.materia_id")
        ->join("distribuciondos", "distribuciondos.materia_id", "=", "assignment_materia.materia_id")
        ->join("distribuciondo_nivel", "distribuciondo_nivel.distribuciondo_id", "=", "distribuciondos.id")
        ->join("users", "users.id", "=", "distribuciondos.user_id")
        ->where('distribuciondo_nivel.nivel_id', $usuario->nivel_id)
        ->where('assignment_materia.user_id', $usuario->id)
        ->select("assignment_materia.*","materias.nombre as nombre_materia", "users.name as nombre_docente", "users.apellido as apellido_docente")
        ->get();

              
        return view('Estudiante.perfile',compact('curso','user', 'materias')); //ruta estudiante

    }

    
    public function unidades($id){
              // todos los datos de la bd
         $user =  User::findorfail( Auth::id());
         //$institutomate = Materia::find($id)->instituto()->get();
          $curso = Distribucionmacu::find($user->distribucionmacu_id);
          $docente = Distribuciondo::join("distribuciondo_nivel", "distribuciondo_nivel.distribuciondo_id", "=", "distribuciondos.id")
          ->join("users", "users.id", "=", "distribuciondos.user_id")
        ->where('distribuciondo_nivel.nivel_id', $user->nivel_id)
        ->where('distribuciondos.materia_id', $id)
        ->select("users.name as nombre_docente", "users.apellido as apellido_docente")
          ->first();
          
         $contenido=Contenido::get();

  


         // return $realizar;
        $completados = $user->tallers;
         $con =Contenido::where('materia_id', $id)->first();
         $ids = [];
          foreach($completados as $act){
                $ids[]=$act->id;
            }
                   // $tallers=Taller::get();
         $realizar = Distribucionmacu::join('distribucionmacu_taller' , "distribucionmacu_taller.distribucionmacu_id", "=", "distribucionmacus.id")
         ->join('contenidos', 'distribucionmacu_taller.contenido_id', '=', 'contenidos.id')
        ->join('tallers', 'distribucionmacu_taller.taller_id', '=', 'tallers.id')
         ->where('distribucionmacu_taller.distribucionmacu_id', $curso->id)
         ->where('distribucionmacu_taller.nivel_id', $user->nivel_id)
         ->where('distribucionmacu_taller.nivel_id', $user->nivel_id)
         ->whereNotIn('distribucionmacu_taller.taller_id', $ids)
         ->where('distribucionmacu_taller.estado', 1)
        ->select("distribucionmacu_taller.*", "contenidos.nombre as unidad", "tallers.nombre as nombre_taller", "tallers.enunciado")

         ->get();

         // $tallers = Taller::whereNotIn('id', $ids)->get();
 
         $materia =Materia::where('id', $id)->firstOrfail();
         $conten =Contenido::join('documentos' , "documentos.contenido_id", "=", "contenidos.id")
         ->where('contenidos.materia_id', $id)
        ->select("documentos.*", "contenidos.nombre as nombre_contenido")

         ->get();

        //return $conten;


        // $conten =Contenido::where('materia_id', $id)->firstOrfail();
        // $cons =Documento::where('contenido_id',$conten->id)->get();
         $cons2 =Archivodocente::where('materia_id',$materia->id)->where('nivel_id', Auth::user()->nivel_id)->paginate(6);
         return view ('Estudiante.contenido',['materia'=>$materia, 'docente'=>$docente, 'curso'=>$curso,'contenidos'=>$contenido,'tallers'=>$realizar,'cons2'=>$cons2,'contenido'=>$conten]);
            
     
       // return $tallers;

    }


    public function password(){

        return view('Estudiante.password');
    }
  
    

    public function updatep(Request $request){

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

        return redirect('sistema/homees')->with('Password actualizado');
          

     }

  /////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////INICIO DOC ESTUDIANTE//////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////

     public function VisualizacionPDF($id){
     //documento no descargable 
      $contenido =Documento::where('id', $id)->firstOrfail();

       return \view('Estudiante.archivopdf',['contenido'=>$contenido]);

   }
   public function VisualizacionPDF3($id){
    //documento  descargable 
      $contenido =Documento::where('id', $id)->firstOrfail();

      return \view('Estudiante.archivopdf3',['contenido'=>$contenido]);

  }


   public function VisualizacionPDF2($id){
  //visualizar documento del docente
    $contenido =Archivodocente::where('id', $id)->firstOrfail();
     return \view('Estudiante.archivopdf2',['contenido'=>$contenido]);

 }

      /////////////////////////////////////////////////////////////////////////////////////
      //////////////////////////////////FIN DOC ESTUDIANTE/////////////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////


  public function PostE()
  {

     return \view('Estudiante.postestudiante');

  }


  public function storee(Request $request)
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
      $post->nivel_id= Auth::user()->nivel_id;
      $post->distribucionmacu_id= Auth::user()->distribucionmacu_id;
      $post->nombre   = e($request->nombre);
      $post->abstract = e($request->abstract);
      $post->body = e($request->body);

      $post->save();

      $post->image()->create($urlimage);

      return redirect('sistema/homees')->with('Post Creado!');

  }


  public function destroype(Post $post)
    {
        $post = Post::findOrFail($post->id)->delete();
   

        return redirect('sistema/homees')->with('Post Eliminado!');
    }



 

}