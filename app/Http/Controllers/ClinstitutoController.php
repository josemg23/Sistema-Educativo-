<?php

namespace App\Http\Controllers;
use App\Instituto;
use App\Clinstituto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinstitutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

  
    public function create()
    {
        $institutos=Instituto::get();
        return \view('Clonacion.clonacionc', compact('institutos'));
    }

  
    public function p_clonainstituto(Request $request)
    {


         $value=[$request->p_source, $request->p_target];
         DB::select('call p_clonainstituto (?,?)', $value);
        
         return redirect('sistema/clinstitutos/create')->with('success','Clonación Realizada Exitosamente!');
           
      
        
    }

    
}