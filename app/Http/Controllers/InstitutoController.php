<?php

namespace App\Http\Controllers;

use App\Contenido;
use App\Distribuciondo;
use App\Distribucionmacu;
use App\Distrima;
use App\Http\Controllers\Controller;
use App\Instituto;
use App\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InstitutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //Gate::authorize('haveaccess', 'instituto.index');
        $instituto= Instituto::all();
    
        return view('Instituto.indexins',['institutos'=>$instituto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clone(Request $request, $id)
    {
        $model              = Instituto::find($id);
     
        $model->email       = 'itsvr2gmail.com';
        // $model->estado      = $request->estado;
        $duplicatedModel    = $model->saveAsDuplicate();
        return $duplicatedModel;
    
    }
    public function hola($id)
    {
         $model = Instituto::find($id);
         $materias = $model->materias;
          foreach ($materias as $key => $value) {
            $materia[$key]        = $value;
            $duplicaMateria[$key] =$materia[$key]->saveAsDuplicate();
        }
    }
    public function create()
    {
        //Gate::authorize('haveaccess', 'instituto.create');
        return \view('Instituto.createins');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // Gate::authorize('haveaccess', 'instituto.store');
        $request->validate([

            'nombre'      => 'required|string|max:150',
            'descripcion' => 'required|string|max:150',
            'provincia'   => 'required|string|max:250',
            'canton'      => 'required|string|max:150',
            'direccion'   => 'required|string|max:250',
            'telefono'    => 'required|string|max:13',
            'email'       => 'required|string|max:150|unique:institutos',
            'estado'      => 'required|in:on,off',
            

        ]);

        $instituto = Instituto::create($request->all());
   
       return \redirect('sistema/institutos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instituto  $instituto
     * @return \Illuminate\Http\Response
     */
    public function show(Instituto $instituto)
    {
        //Gate::authorize('haveaccess', 'instituto.show');
        return view ('instituto.showins',['instituto'=>$instituto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instituto  $instituto
     * @return \Illuminate\Http\Response
     */
    public function edit(Instituto $instituto)
    {
        //Gate::authorize('haveaccess', 'instituto.edit');
      return \view('instituto.editins',['instituto'=>$instituto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instituto  $instituto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instituto $instituto)
    {
       // Gate::authorize('haveaccess', 'instituto.update');
        $request->validate([

            'nombre'      => 'required|string|max:150',
            'descripcion' => 'required|string|max:150',
            'provincia'   => 'required|string|max:250',
            'canton'      => 'required|string|max:150',
            'direccion'   => 'required|string|max:250',
            'telefono'    => 'required|string|max:13',
            'email'       => 'required|string|max:150',
            'estado'      => 'required|in:on,off',
            

        ]);
       
    
        $instituto ->update($request->all());
   
       return \redirect('sistema/institutos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instituto  $instituto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // Gate::authorize('haveaccess', 'instituto.destroy');
        $instituto= Instituto::find($id);
        $instituto->delete();

        return redirect('sistema/institutos')->with('success','Haz eliminado un Dato con exito');
   
    }
}