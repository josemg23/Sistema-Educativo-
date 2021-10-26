<?php

namespace App\Http\Controllers;

use App\Nivel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NivelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::authorize('haveaccess', 'nivel.index');

        $nivels= Nivel::orderBy('id','Asc')->paginate(5);
    
        return view('Niveles.indexn',['nivels'=>$nivels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // Gate::authorize('haveaccess', 'nivel.create');
        return \view('Niveles.createn');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Gate::authorize('haveaccess', 'nivel.store');
        
        $request->validate([

            'nombre'      => 'required|string|max:150',
            'estado'      => 'required|in:on,off',
        ]);

        $nivels = Nivel::create($request->all());
   
        return \redirect('sistema/nivels');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function show(Nivel $nivel)
    {
       // Gate::authorize('haveaccess', 'nivel.show');
        return view ('Niveles.shown',['nivel'=>$nivel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function edit(Nivel $nivel)
    {
        //Gate::authorize('haveaccess', 'nivel.edit');
        return view('Niveles.editn',['nivel'=>$nivel]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nivel $nivel)
    {
      //  Gate::authorize('haveaccess', 'nivel.update');
        $request->validate([

            'nombre'      => 'required|string|max:150',
            'estado'      => 'required|in:on,off',
        ]);

        $nivel->update($request->all());
   
        return \redirect('sistema/nivels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nivel  $nivel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // Gate::authorize('haveaccess', 'nivel.destroy');
        $nivel= Nivel::find($id);
        $nivel->delete();

        return redirect('sistema/nivels')->with('success','Haz eliminado un Dato con exito');
   
    }
}
