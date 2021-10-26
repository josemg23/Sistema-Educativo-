<?php

namespace App\Http\Controllers;

use App\Materia;
use App\User;
use App\Instituto;
use App\Assignment;
use App\Distribucionmacu;
use Illuminate\Http\Request;
use DB;

class AssignmentController extends Controller
{
  
    public function index()
    {
        $as=Assignment::all();
       
        return \view('Asignacion.index',compact('as'));
       
    }

   
    public function create()
    {
        $institutos = Instituto::get();
        $materias=Materia::get();
        $user=User::get();

        return \view('Asignacion.create',compact('materias','user','institutos'));
    }

  
    public function store(Request $request)
    {
        $request->validate([ 
            'instituto' =>['required'],
            'estudiante' => ['required','unique:assignments,user_id'],
            'materia' =>    ['required'],
            'estado' =>   ['required' ,'in:on,off'],
        ]);

         $as                = new Assignment;
         $as ->instituto_id = $request->instituto;
         $as ->user_id      = $request->estudiante;
         $as ->estado       = $request->estado;
         $as->save();

         // if($request->get('materia')){
         //    $as->materias()->sync($request->get('materia'));
         //  }
         foreach ($request->get('materia') as $group) { 
        $ag =   DB::table('assignment_materia')->insert(
                ['assignment_id' => $as->id, 'materia_id' => $group, 'user_id' => $request->estudiante]);
        }      
            return redirect('sistema/assignments ')->with('success','Haz Creado una Asignación con exito!');

    }

   
    public function show(Assignment $assignment)
    {

        $as1= Assignment::find($assignment->id);
        $user = $as1->user()->first();
        $instituto = Assignment::find($assignment->id)->instituto()->first();
        $materias= $as1->materias()->get();
        $materia_all = Materia::where('instituto_id', $instituto->id)->get();
        
        return view('Asignacion.show', compact('assignment','as1','user','instituto','materias','materia_all'));
  


        return \view('Asignacion.show');
    }

    public function edit(Assignment $assignment)
    {
        $as1= Assignment::find($assignment->id);
        $user = $as1->user()->first();
        $instituto = Assignment::find($assignment->id)->instituto()->first();
        $materias_user= $as1->materias()->get();
        $materia = [];

        $distribucion = Distribucionmacu::where('id', $user->distribucionmacu_id)->first();
        $materias = $distribucion->materias;


        // foreach($distribucion as $key => $value){
        //     $materia[$key] =[
        //         'id'=> $value->id,
        //         'nombre' => $value->curso->nombre,
        //         'materias' => $value->materias,
        //     ];
        // }
        // $materia_all = Materia::where('instituto_id', $instituto->id)->get();
        
        return view('Asignacion.edit', compact('assignment','as1','user','instituto','materias','materias_user'));
    }

  
    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([            
            'estado'      => 'required|in:on,off',
        ]);

        $assignment->update($request->all());

         
        if($request->get('materia')){
            $assignment->materias()->detach();
          }

        $assignment->save();

        // $dis = Distribucionmacu::find($request->curso);
        // $curso = $dis->materias;
        // $ids =[];

        foreach ($request->get('materia') as $group) { 
        $as =   DB::table('assignment_materia')->insert(
                ['assignment_id' => $assignment->id, 'materia_id' => $group, 'user_id' => $assignment->user_id]);
        } 

          return redirect('sistema/assignments ')->with('success','Haz Actualizado una Asignación con exito!');

    }

   
    public function destroy(Assignment $assignment)
    {
        $assignment= Assignment::find($assignment->id);
        $assignment->delete();
 
         return redirect('sistema/assignments ')->with('success','Haz eliminado una Asignación con exito!');
     
    }
}
