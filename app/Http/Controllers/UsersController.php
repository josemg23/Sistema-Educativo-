<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Curso;
use App\Distribucionmacu;
use App\Events\NewUserRegistered;
use App\Http\Controllers\Controller;
use App\Instituto;
use App\Mail\UserRegister;
use App\Modelos\Role;
use App\Nivel;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::authorize('haveaccess', 'user.index');
     
         $users= User::all();
         return view('Persona.inicio',['users'=>$users]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // Gate::authorize('haveaccess', 'user.create');
        
         $cursos= Curso::get();
         $nivels= Nivel::get();
         $roles=Role::get();
         $institutos=Instituto::get();
        

       return \view('Persona.createuser',compact('roles','institutos','cursos','nivels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // Gate::authorize('haveaccess', 'user.store');
        //validacion de datos 
         $request->validate([
            'cedula'          =>  'required|string|max:10|unique:users' ,
            'name'            =>  'required|string|max:20',
            'apellido'        =>  'required|string|max:20',
            'role'            =>  'required',
            'email'           => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'        =>  'required|string|min:8',
            'estado'      => 'required|in:on,off',
          
        ]);
        $users                     = $request->all();
        $user                      = new User;
        $user->instituto_id        = $request->instituto;  //relacion con el instituto y usuario     
        $user->distribucionmacu_id = $request->curso;
        $user->nivel_id            = $request->paralelo;
        $user->cedula              = $request->cedula;
        $user->name                = $request->name;
        $user->apellido            = $request->apellido;  
        $user->domicilio           = $request->domicilio;
        $user->telefono            = $request->telefono;
        $user->celular             = $request->celular;
        $user->email               = $request->email;
        $user->estado              = $request->estado;
        $user->password            = Hash::make($request->password);
       //agregados estudiantes y docente sen la misma tabla de persona 
         
        $user->save();
        
        // event(new NewUserRegistered($users));

        if ($request->get('role')) {
           
            $user->roles()->sync($request->get('role'));
        }

     
$rol = Role::find($request->role);

if ($rol->descripcion == 'estudiante') {
       $dis = Distribucionmacu::find($request->curso);
        $curso = $dis->materias;
        $ids =[];

        foreach ($curso as $id) {
           $ids[] = $id->id; 
        }

     $as                = new Assignment;
        $as ->instituto_id = $request->instituto;
        $as ->user_id      = $user->id;
        $as ->estado       = $request->estado;
        $as->save();

        // $as->materias()->sync($ids);

        foreach ($curso as $group) { 
        $ag =   DB::table('assignment_materia')->insert(
                ['assignment_id' => $as->id, 'materia_id' => $group->id, 'user_id' => $user->id]);
        }      
}

        Mail::to($user->email)->send(new UserRegister($users));

        return redirect('sistema/users/create ')->with('success','Usuario Creado Exitosamente!');
        //return redirect('sistema/admin');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
       // Gate::authorize('haveaccess', 'user.show');
       
       $us=User::find($user->id);
       $roles= Role::orderBy('name')->get();
         $curso = Distribucionmacu::join('cursos', 'cursos.id', '=', 'distribucionmacus.curso_id')->select('distribucionmacus.*', 'cursos.nombre')->where('distribucionmacus.id', $us->distribucionmacu_id)->first();
        // $roles = Role::all();
        $cursos= Curso::get();
        $nivels= Nivel::get();
        $institutos = Instituto::get(); // todos los datos de la bd
        $institutouser = User::find($user->id)->instituto()->get(); //llama al instituto que este relacionado a un usuario 
        $cursouser=User::find($user->id)->curso()->get();
        $niveluser = User::find($user->id)->nivel()->get();
        $roluser=  $us->roles()->get();
     
       return view('Persona.showu',compact('roles','institutos','cursos','nivels','institutouser','cursouser','curso','niveluser','user','roluser'));
        
    
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
       // Gate::authorize('haveaccess', 'user.edit');
       $us=User::find($user->id);
        
        $curso = Distribucionmacu::join('cursos', 'cursos.id', '=', 'distribucionmacus.curso_id')->select('distribucionmacus.*', 'cursos.nombre')->where('distribucionmacus.id', $us->distribucionmacu_id)->first();
       
     
        $cursos= Distribucionmacu::where('id', '!=', $us->distribucionmacu_id)->where('instituto_id', $us->instituto_id)->get();
             
        $asignacion = [];
           foreach($cursos as $key => $value){
            $asignacion[$key] =[
                'id'=> $value->id,
                'curso' => $value->curso->nombre,
            ];
        }

        $nivels= Nivel::where('id', '!=', $user->nivel_id)->get();
        // return $nivels;
        $instituto =$us->instituto_id;
        $institutos = Instituto::where('id', '!=', $instituto)->get(); // todos los datos de la bd
        $institutouser = User::find($user->id)->instituto;
         //llama al instituto que este relacionado a un usuario 
        $cursouser=User::find($user->id)->curso()->get();
        $niveluser = User::find($user->id)->nivel()->get();
        $roluser=  $us->roles()->get();
       $roles= Role::where('id','!=', $roluser[0]->id)->orderBy('name')->get();

        $rol =  array(
           'id' => $roluser[0]->id,
           'name' => $roluser[0]->name,
           'descripcion' => $roluser[0]->descripcion
        );
     
       return view('Persona.edituser',compact('roles','rol','institutos','asignacion','curso','nivels','institutouser','cursouser','niveluser','user','roluser'));

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
       // Gate::authorize('haveaccess', 'user.update');
        $request->validate([

            'cedula'          =>  'required|string|max:10',        
            'apellido'        =>  'required|string|max:20',         
            'name'            =>  'required|string|max:20',
            'estado'          =>  'required|in:on,off',
            'email'           => [ 'string', 'email', 'max:255,'.$user->id,],
            
         
         
//agregados estudiantes y docente sen la misma tabla de persona 
          

        ]);
        $user->update($request->all());
     //validacion de passowrd
        //omitir hecho de actualizar materia y que se mantenga la misma 
         if($request->get('instituto')){
          
            $user->instituto_id = $request->instituto;
          }
        
          if($request->get('paralelo')){
          
            $user->nivel_id = $request->paralelo;
          }

          $user->roles()->sync($request->get('roles'));
          $count = Assignment::where('user_id', $user->id)->count();

         if ($request->roles == 3 || $request->roles == 1) {
            $user->distribucionmacu_id = null;
            $user->nivel_id = null;

             if ($count == 1) {
               $el = Assignment::where('user_id', $user->id)->first();
               $el->delete();
             }
             
         }

         if ($request->roles == 2 ) {

            if ($user->distribucionmacu_id !=  $request->curso) {
            
               if ($count == 1) {
                  $eliminar = Assignment::where('user_id', $user->id)->first();
                  $eliminar->delete();
               }
          

             
            $dis = Distribucionmacu::find($request->curso);
            $curso = $dis->materias;
            $ids =[];

            foreach ($curso as $id) {
               $ids[] = $id->id; 
            }

         $as                = new Assignment;
            $as ->instituto_id = $request->instituto;
            $as ->user_id      = $user->id;
            $as ->estado       = $request->estado;
            $as->save();

            // $as->materias()->sync($ids);

            foreach ($curso as $group) { 
            $ag =   DB::table('assignment_materia')->insert(
                     ['assignment_id' => $as->id, 'materia_id' => $group->id, 'user_id' => $user->id]);
            }      


            }




         }
         if($request->get('curso')){
          
            $user->distribucionmacu_id = $request->curso;
          }

        $user->save();
    
       return redirect('sistema/users');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Gate::authorize('haveaccess', 'user.destroy');
        $user= User::find($user->id);
        $user->delete();

        return redirect('sistema/users')->with('success','Haz eliminado un Usuario con exito');
       
    }
}