<?php

namespace App\Http\Controllers;
use App\Materia;
use App\Curso;
use App\Instituto;
use App\Distribucionmacu;
use App\Nivel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistribucionmacuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distribucionmacus= Distribucionmacu::all();
       
        return \view('Distribucion.indexmc',['distribucionmacus'=>$distribucionmacus,]);
    }

   
    public function create()
    {
          
        $institutos = Instituto::get();
        $materias=Materia::get();
        $nivels=Nivel::get();
        $cursos=Curso::get();
      
        return \view('Distribucion.createmc',compact('materias','cursos','institutos','nivels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //return $request->all();

        $request->validate([

            'cursos' =>  'required',
          
            'instituto' =>['required'],
            'materia' =>  ['required'],
            'estado' => ['required' ,'in:on,off'],
        ]);

         $search = Distribucionmacu::where('instituto_id', $request->instituto)->where('curso_id', $request->cursos)->count();
        if ($search >= 1) {
            return back()->with('error','Esta asignacion ya existe en la base de datos');
            
        }else{
        $distribucionmacu =new  Distribucionmacu;
        $distribucionmacu ->instituto_id = $request->instituto;
        // $distribucionmacu ->nivel_id = $request->nivel;
        $distribucionmacu ->estado = $request->estado;
        $distribucionmacu->curso_id=$request->cursos;
          
      

       $distribucionmacu->save();

     
       if($request->get('materia')){
        $distribucionmacu->materias()->sync($request->get('materia'));
      }
        return redirect('sistema/distribucionmacus ')->with('success','Haz Creado una Asignación con exito');
}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distribucionmacu  $distribucionmacu
     * @return \Illuminate\Http\Response
     */
    public function show(Distribucionmacu $distribucionmacu)
    {
        $distcursos=Distribucionmacu::find($distribucionmacu->id);
        $materias= $distcursos->materias()->get();
        
        $instituto=Distribucionmacu::find($distribucionmacu->id)->instituto()->first();
        $materia_all = Materia::where('instituto_id', $instituto->id)->get();
        $cursos =  $distcursos->curso()->first();//todos los datos de la bd de cursos
         //llama al curso que esta relacionado a esta distribucion
         $nivels= $distcursos->nivel()->first();

         return view('Distribucion.showmacu',compact('distribucionmacu','materias', 'materia_all','cursos','distcursos','instituto','nivels'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distribucionmacu  $distribucionmacu
     * @return \Illuminate\Http\Response
     */
    public function edit(Distribucionmacu $distribucionmacu)
    {
      
        $distcursos=Distribucionmacu::find($distribucionmacu->id);
        $materias= $distcursos->materias()->get();
        
        $instituto=Distribucionmacu::find($distribucionmacu->id)->instituto()->first();
        $consulta = Distribucionmacu::join("distribucionmacu_materia", "distribucionmacu_materia.distribucionmacu_id", "=", "distribucionmacus.id")
        ->join("materias", "materias.id", "=", "distribucionmacu_materia.materia_id")
        ->where('materias.instituto_id', $instituto->id)
        ->select("materias.id")
        ->get();

        $ids = [];
        foreach ($consulta as $id) {
        $ids[] = $id->id;
        }

        $materiaclasificadas= Materia::where('instituto_id', $instituto->id)->whereNotIn('id', $ids)->get();
        $materia_all = [];
   
           foreach($materiaclasificadas as $key => $value){
            $materia_all[$key] =[
                'id'=> $value->id,
                'nombre' => $value->nombre
            ];
        }

        // $materia_all = Materia::where('instituto_id', $instituto->id)->get();
        $cursos =  $distcursos->curso()->first();//todos los datos de la bd de cursos
         //llama al curso que esta relacionado a esta distribucion
         $nivels= $distcursos->nivel()->first();

        return view('Distribucion.editmacu',compact('distribucionmacu','materias', 'materia_all','cursos','distcursos','instituto','nivels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distribucionmacu  $distribucionmacu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distribucionmacu $distribucionmacu)
    {

        $request->validate([

                       
            'estado'      => 'required|in:on,off',
        ]);

        $distribucionmacu->update($request->all());
   
        // if($request->get('curso')){
          
        //     $distribucionmacu->curso_id = $request->curso;
        //   }

          if($request->get('materia')){
            $distribucionmacu->materias()->sync($request->get('materia'));
          }
         

        $distribucionmacu->save();
        return redirect('sistema/distribucionmacus');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distribucionmacu  $distribucionmacu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distribucionmacu $distribucionmacu)
    {
        $distribucionmacu= Distribucionmacu::find($distribucionmacu->id);
        $distribucionmacu->delete();

        return redirect('sistema/distribucionmacus')->with('success','Haz eliminado una Asignación con exito');
    }
}