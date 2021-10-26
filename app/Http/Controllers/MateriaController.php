<?php

namespace App\Http\Controllers;

use App\Contenido;
use App\Taller;
use App\Materia;
use App\Plantilla;
use App\Instituto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      

        $materias= Materia::all();
    
        return view('Materias.indexm',['materias'=>$materias]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $institutos=Instituto::get();
        return \view('Materias.createm',compact('institutos'));
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

            'nombre'      => 'required|string|max:60',
            'slug'      => 'required|string|max:60',
            'descripcion'      => 'required|string|max:150',
            'estado'      => 'required|in:on,off',
        ]);

       
       $materia = new Materia;
       $materia->instituto_id = $request->instituto;
       $materia->nombre = $request->nombre;
       $materia->slug = $request->slug;
       $materia->descripcion = $request->descripcion;
       $materia->estado = $request->estado;
        
       $materia->save();
        
        return \redirect('sistema/materias');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
        // todos los datos de la bd
        
         $materia =Materia::where('id', $id)->firstOrfail();  
         $institutomate = Materia::find($materia->id)->instituto()->get(); 
         $contenido =Contenido::where('materia_id',$materia->id)->paginate(10);
         
         return view ('Materias.showm',['materia'=>$materia,'contenidos'=>$contenido,'institutomate'=>$institutomate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function edit(Materia $materia)
    {
     
        $institutos = Instituto::get(); // todos los datos de la bd
        $institutomate = Materia::find($materia->id)->instituto()->get();
    
        return view('Materias.editm',['materias'=>$materia,'institutos'=>$institutos,'institutomate'=>$institutomate,]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materia $materia)
    {
     
        $request->validate([

            'nombre'      => 'required|string|max:60',
            'slug'      => 'required|string|max:60',
            'descripcion'      => 'required|string|max:150',
            'estado'      => 'required|in:on,off',
        ]);

        $materia->update($request->all());
        if($request->get('instituto')){
          
            $materia->instituto_id = $request->instituto;
          }
    
          $materia->save();
        return \redirect('sistema/materias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materia $materia)
    {
        
        $materia= Materia::find($materia->id);
        $materia->delete();

        return redirect('sistema/materias')->with('success','Haz eliminado una Materia con exito');
  

    }
}