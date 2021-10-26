<?php

namespace App\Http\Controllers;

use App\Contenido;
use App\Documento;
use App\Materia;
use App\Taller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;




class ContenidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responses
     */
    public function index()
    {
        $contenido= Contenido::all();
    
        return view('Contenido.indexcon',['contenidos'=>$contenido]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $materias=Materia::get();
        return \view('Contenido.createco',compact('materias'));

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

            'nombre'      => 'required|string|max:150',
            'descripcion' => 'required|string|max:250',
            'materia'     =>'required',
            'estado'      => 'required|in:on,off',
        ]);
     
    
         
     
       

         $contenido = New Contenido;
         $contenido->nombre = $request->nombre;
         $contenido->descripcion =$request->descripcion;
       
      
         
         $contenido->estado = $request->estado;

         if($request->get('materia')){
         
            $contenido->materia_id = $request->materia;
         }

         $contenido->save();
              
         


        return redirect('sistema/contenidos')->with('success','Contenido Creado Exitosamente!');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
        $materias=Materia::get();
        $contenido =Contenido::where('id', $id)->firstOrfail();
        $materiacontenido=Contenido::find($contenido->id)->materia()->get();
        // $tallers=Taller::where('contenido_id', $contenido->id)->paginate(10);

        $doc =Documento::where('contenido_id', $contenido->id)->paginate(10);
        return \view('Contenido.showcon',['contenido'=>$contenido,'materias'=>$materias,'materiacontenido'=> $materiacontenido,'doc'=>$doc]);
    
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function edit(Contenido $contenido)
    {
        $materias=Materia::get();
        $materiacontenido=Contenido::find($contenido->id)->materia()->get();
        
        return \view('Contenido.editcon',['contenido'=>$contenido,'materias'=>$materias,'materiacontenido'=> $materiacontenido]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contenido $contenido)
    {
        $request->validate([

            'nombre'      => 'required|string|max:150',
            'descripcion' => 'required|string|max:250',
        
            'archivo'  => 'mimes:jpg,jpeg,gif,png,xls,xlsx,doc,docx,pdf|max:100000',
            'estado'      => 'required|in:on,off',
        ]);

          $contenido->update($request->all());
      
      /**  if($request->hasFile('archivo')){

            $archivo=$request->file('archivo');
            $nombre=time().$archivo->getClientOriginalName();
            $ruta= public_path().'/archivos';
            $archivo->move($ruta,$nombre);
            $urlarchivo['url']='/archivos/'.$nombre;
         }

         if($request->accion == 1){
          
            $contenido->accion = true;
         }elseif($request->accion == 0){
          
            $contenido->accion = false;
         }

      
      
        if ($request->hasFile('archivo')){
            $contenido->archivo()->delete();
        }

        $contenido->save();

        if ($request->hasFile('archivo')){
            $contenido->archivo()->create($urlarchivo);
        }
     **/
          if($request->get('materia')){
           
              $contenido->materia_id = $request->materia;
           }
           $contenido->save();
         
  
          return redirect('sistema/contenidos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contenido $contenido)
    {
        $contenido= Contenido::find($contenido->id);
    
           $contenido->delete();
          
           
            return redirect('sistema/contenidos')->with('success','Haz eliminado un Contenido con exito');     
       
       
    }
}