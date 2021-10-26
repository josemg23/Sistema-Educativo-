<?php

namespace App\Http\Controllers;
use App\Materia;
use App\User;
use App\Instituto;
use App\Nivel;
use App\Distribuciondo;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistribuciondoController extends Controller
{
   
    public function index()
    {
        
        $distribucions=Distribuciondo::all();
       
        return \view('DistribucionDocente.indexdocente',['distribucions'=>$distribucions,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $institutos = Instituto::get();
        $materias=Materia::get();

        // $paralelos=
        $user=User::get();
      
      
        return \view('DistribucionDocente.createdocente',compact('materias','user','institutos'));
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
            'instituto' =>['required'],
            'docente'   => ['required'],
            'materia'   =>    ['required'],
            'estado'    =>   ['required' ,'in:on,off'],
        ]);

        $distribuciondo =new  Distribuciondo;
        $distribuciondo ->instituto_id = $request->instituto;
        $distribuciondo ->user_id = $request->docente;
        $distribuciondo ->materia_id = $request->materia;
        $distribuciondo ->estado = $request->estado;
        $distribuciondo->save();

     
      //  if($request->get('paralelos')){


      //   $distribuciondo->paralelos()->sync($request->get('materia'));
      // }
         foreach ($request->get('paralelos') as $group) { 
            $nombre = Nivel::find($group);
            $as =   DB::table('distribuciondo_nivel')->insert(
                ['distribuciondo_id' => $distribuciondo->id, 'nivel_id' => $group, 'nivel_nombre' => $nombre->nombre]);
        } 
        return redirect('sistema/distribuciondos ');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distribuciondo  $distribuciondo
     * @return \Illuminate\Http\Response
     */
    public function show(Distribuciondo $distribuciondo)
    {
        $distd=Distribuciondo::find($distribuciondo->id);
        $user=  $distd->user()->first();
        $materia=  Materia::find($distd->materia_id);
        $instituto=Distribuciondo::find($distribuciondo->id)->instituto()->first();
        $paralelos=  $distd->paralelos()->get();

        // $materia_all = Materia::where('instituto_id', $instituto->id)->get();
       
      

        return \view('DistribucionDocente.showdocente', compact('distribuciondo','user','instituto','distd','paralelos', 'materia'));
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distribuciondo  $distribuciondo
     * @return \Illuminate\Http\Response
     */
    public function edit(Distribuciondo $distribuciondo)
    {
        $distd=Distribuciondo::find($distribuciondo->id);
        $materia = Materia::find($distd->materia_id);
        $user=  $distd->user()->first();
        $instituto=Distribuciondo::find($distribuciondo->id)->instituto()->first();
        $paralelos_docente=  $distd->paralelos()->get();

        $consulta = Distribuciondo::join("distribuciondo_nivel", "distribuciondo_nivel.distribuciondo_id", "=", "distribuciondos.id")
        ->join("nivels", "nivels.id", "=", "distribuciondo_nivel.nivel_id")
        ->where('distribuciondos.materia_id', $distd->materia_id)
        ->select("nivels.id")
        ->get();

        $paralelos = [];
        foreach ($consulta as $ids) {
        $paralelos[] = $ids->id;
        }

         $paralelos_all = Nivel::whereNotIn('id', $paralelos)->get();

        $ids = [];
        // foreach ($paralelos_docente as $paralelo) {
        //     $ids[] = $paralelo->id;
        // }
        // $paralelos_all = Nivel::whereNotIn('id', $ids)->get();
         // return $paralelos_all;

       
      

        return \view('DistribucionDocente.editdocente', compact('distribuciondo','user','instituto','distd','materia','paralelos_docente', 'paralelos_all'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distribuciondo  $distribuciondo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distribuciondo $distribuciondo)
    {
        $request->validate([

           
            
            'estado'      => 'required|in:on,off',
        ]);

        $distribuciondo->update($request->all());

          if($request->get('paralelos')){
            $distribuciondo->paralelos()->detach();
          }

          foreach ($request->get('paralelos') as $group) { 
            $nombre = Nivel::find($group);
            $as =   DB::table('distribuciondo_nivel')->insert(
                ['distribuciondo_id' => $distribuciondo->id, 'nivel_id' => $group, 'nivel_nombre' => $nombre->nombre]);
        } 
          $distribuciondo->save();

          return redirect('sistema/distribuciondos ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distribuciondo  $distribuciondo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distribuciondo $distribuciondo)
    {
       $distribuciondo= Distribuciondo::find($distribuciondo->id);
       $distribuciondo->delete();

        return redirect('sistema/distribuciondos ')->with('success','Haz eliminado una Asignación con exito');
    
    }
}
