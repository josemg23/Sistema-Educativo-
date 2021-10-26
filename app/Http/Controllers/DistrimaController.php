<?php

namespace App\Http\Controllers;
use App\Materia;
use App\Curso;
use App\Instituto;
use App\Distribucionmacu;
use App\Distrima;
use App\User;
use App\Nivel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistrimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distrimas= Distrima::orderBy('id','Asc')->paginate(5);
        $dist = Distribucionmacu::find(2);
       $user = Distrima::where('distribucionmacu_id', 2)->get();
       
        //dd($distrimas);
        return \view('DistribucionAlumno.indexdma',['distrimas'=>$distrimas, 'user' => $user]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nivels= Nivel::get();
        $institutos = Instituto::get();
        $materias=Materia::get();  
        $cursos=Curso::get();
        $users=User::get();
        $distribucion=Distribucionmacu::get();
        return \view('DistribucionAlumno.createma',compact('materias','cursos','institutos','users','nivels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'estudiante' => ['required','unique:distrimas,user_id'],
            'asignacion' =>    ['required'],
            'instituto' =>['required'],
            'paralelo' =>['required'],
            'estado' => ['required' ,'in:on,off'],
        ]);

        $distrima =new  Distrima;
        $distrima ->instituto_id = $request->instituto;
        $distrima ->nivel_id = $request->paralelo;
        $distrima ->estado = $request->estado;
        $distrima->distribucionmacu_id =$request->asignacion;
        $distrima ->user_id = $request->estudiante;
        
        $distrima->save();
       
        return redirect('sistema/distrimas ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distrima  $distrima
     * @return \Illuminate\Http\Response
     */
    public function show(Distrima $distrima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distrima  $distrima
     * @return \Illuminate\Http\Response
     */
    public function edit(Distrima $distrima)
    {

       

        $distma=Distrima::find($distrima->id);
        $user=$distma->user()->first();
      
        $distribucion= $distma->distribucionmacu()->first();
        $curs[] =array(
            'id' => $distribucion->id,
            'curso_id' => $distribucion->curso_id,
            'nombre' => $distribucion->curso->nombre,
          
        );
        $instituto=Distrima::find($distrima->id)->instituto()->first();
        $distribucion_all=Distribucionmacu::where('instituto_id', $instituto->id)->get();

        $cursos =[];
        foreach($distribucion_all as $value)
        {
            $curso =array(
                'id' =>$value->id,
                'curso_id' => $value->curso_id,
                'nombre' => $value->curso->nombre,
              
            );
            $cursos[] = $curso;
        }
       

        $nivels = Nivel::get(); // todos los datos de la bd
        $niveldis = Distrima::find($distrima->id)->nivel()->get(); //llama al instituto que este relacionado a un usuario 

        return \view('DistribucionAlumno.editdisma',compact('distrima','distma','cursos','curs','instituto','distribucion_all','user','distribucion','nivels','niveldis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distrima  $distrima
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distrima $distrima)
    {
        $request->validate([

           
            
            'estado'      => 'required|in:on,off',
        ]);

        $distrima->update($request->all());

        if($request->get('asignacion')){
          
            $distrima->distribucionmacu_id = $request->asignacion;
          }

        if($request->get('paralelo')){
          
            $distrima->nivel_id = $request->paralelo;
          }

        $distrima->save();

          return redirect('sistema/distrimas');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distrima  $distrima
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distrima $distrima)
    {
       $distrima= Distrima::find($distrima->id);
       $distrima->delete();

        return redirect('sistema/distrimas')->with('success','Haz eliminado una Asignación con exito');
    }
}