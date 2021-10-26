<?php

namespace App\Http\Controllers;

use App\Contenido;
use App\Documento;
use App\Instituto;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
   

    public function index()
    {
         $documentos= Documento::all();
    
        return view('Documento.index',compact('documentos'));
    }

  
    public function create()
    {
        $contenidos =Contenido::get();
        $institutos = Instituto::get();
        return view('Documento.create',compact('contenidos', 'institutos'));
    }

        public function getContenidos(Request $request)
        {
            $id = $request->id;
            $contenidos = Contenido::join('materias' , "materias.id", "=", "contenidos.materia_id")
            ->where('materias.instituto_id', $id)
            ->select("contenidos.*", "materias.nombre as nombre_mate")

            ->get();
            return $contenidos;
            
            
        }
   
    public function store(Request $request)
    {
        


  $request->validate([

            'nombre'      => 'required|string|max:150',
            'descripcion' => 'required|string|max:250',
            'unidad'     =>'required',
            'archivo'     => 'required|mimes:jpg,jpeg,gif,png,xls,xlsx,doc,docx,pdf|max:100000',
            'estado'      => 'required|in:on,off',
        ]);
     
    
         
        if($request->hasFile('archivo')){

            $archivo=$request->file('archivo');
            $nombre=time().$archivo->getClientOriginalName();
            $ruta= public_path().'/archivos';
            $archivo->move($ruta,$nombre);
            $urlarchivo['url']='/archivos/'.$nombre;
         }
       
       

         $d = New Documento;
         $d->nombre = $request->nombre;
         $d->descripcion =$request->descripcion;
       
         if($request->accion == 1){
          
            $d->accion = true;
         }elseif($request->accion == 0){
          
            $d->accion = false;
         }
       
         
         $d->estado = $request->estado;

         if($request->get('unidad')){
         
            $d->contenido_id = $request->unidad;
         }

         $d->save();
              
         
         $d->archivo()->create($urlarchivo);

        return redirect('sistema/documentos')->with('success','Contenido Creado Exitosamente!');
  


    }

    

    public function show(Documento $documento)
    {
        $contenidos=Contenido::get();
        $cdoc=Documento::find($documento->id)->contenido()->get();
        
        return \view('Documento.show',compact('contenidos','cdoc','documento'));
    }

 
    public function edit(Documento $documento)
    {
        

        // $cdoc=Documento::find($documento->id)->contenido()->get();
        $contenido = Contenido::join('materias' , "materias.id", "=", "contenidos.materia_id")
            ->where('contenidos.id', $documento->contenido_id)
            ->select("contenidos.*", "materias.nombre as nombre_mate")
            ->first();
        $instituto = Instituto::find($contenido->materia->instituto_id);
        $institutos = Instituto::whereNotIn('id', [$instituto->id])->get();
        // $contenido = Contenido::find($documento->contenido_id);
         $contenidos = Contenido::join('materias' , "materias.id", "=", "contenidos.materia_id")
            ->where('materias.instituto_id', $instituto->id)
            ->select("contenidos.*", "materias.nombre as nombre_mate")
            ->whereNotIn('contenidos.id', [$contenido->id])
            ->get();
        // $contenidos=Contenido::whereNotIn('id', [$contenido->id])->get();




        // return $contenido;
        
        return \view('Documento.edit',compact('contenidos', 'contenido','documento', 'instituto' , 'institutos'));


    }


    public function update(Request $request, Documento $documento)
    {
    

    $request->validate([

            'nombre'      => 'required|string|max:150',
            'descripcion' => 'required|string|max:250',
        
            'archivo'  => 'mimes:jpg,jpeg,gif,png,xls,xlsx,doc,docx,pdf|max:100000',
            'estado'      => 'required|in:on,off',
        ]);
      
        if($request->hasFile('archivo')){

            $archivo=$request->file('archivo');
            $nombre=time().$archivo->getClientOriginalName();
            $ruta= public_path().'/archivos';
            $archivo->move($ruta,$nombre);
            $urlarchivo['url']='/archivos/'.$nombre;
         }

         if($request->accion == 1){
          
            $documento->accion = true;
         }elseif($request->accion == 0){
          
            $documento->accion = false;
         }

        $documento->update($request->all());
      

        if ($request->hasFile('archivo')){
            $documento->archivo()->delete();
        }

        $documento->save();

        if ($request->hasFile('archivo')){
            $documento->archivo()->create($urlarchivo);
        }
     
        if($request->get('unidad')){
         
            $documento->contenido_id = $request->unidad;
         }
           $documento->save();
         
  
          return redirect('sistema/documentos');

    }

 

    public function destroy(Documento $documento)
    {
         $documento= Documento::find($documento->id);
    
           $documento->delete();
          
           
            return redirect('sistema/documentos')->with('success','Haz eliminado un Contenido con exito'); 
    }
}
