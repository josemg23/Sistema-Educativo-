<?php

namespace App\Http\Controllers;

use App\Curso;

use App\Materia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::authorize('haveaccess', 'curso.index');
               
        $cursos= Curso::orderBy('id','Asc')->paginate(5);
       
        return \view('Cursos.indexc',['cursos'=>$cursos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // Gate::authorize('haveaccess', 'curso.create');
       
         
        return \view('Cursos.createc');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Gate::authorize('haveaccess', 'curso.store');
        $request->validate([

            'nombre'      => 'required|string|max:60',
          
            'estado'      => 'required|in:on,off',
        ]);
       
//    $curso=Curso::create($request->all());
        $curso = new Curso ;
      
        $curso->nombre = $request->nombre;
        $curso->estado = $request->estado;
        
       

        $curso->save();
  
        
        return redirect('sistema/cursos')->with('success','Haz Creado un Paralelo con exito');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
       // Gate::authorize('haveaccess', 'curso.show');
      
         //llama al nivel que esta relacionado con el modelo curso
     
       return \view('Cursos.showc',['curso'=>$curso,]);
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        //Gate::authorize('haveaccess', 'curso.edit');


       //llama al nivel que esta relacionado con el modelo curso
    
      return \view('Cursos.editc',['curso'=>$curso]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
      //  Gate::authorize('haveaccess', 'curso.update');
        
        $request->validate([

            'nombre'      => 'required|string|max:60',
            'estado'      => 'required|in:on,off',
        ]);

        $curso->update($request->all());

      
          
     
        return redirect('sistema/cursos')->with('success','Haz Actualizado un Paralelo con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        //Gate::authorize('haveaccess', 'curso.destroy');
        $curso= Curso::find($curso->id);
        $curso->delete();

        return redirect('sistema/cursos')->with('success','Haz eliminado un Paralelo con exito');
   
    }
}
