<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;
use App\Instituto;
use App\Materia;
use App\Curso;
use App\Modelos\Role;
use App\Distribuciondo;
use App\Distribucionmacu;
use App\Exports\AssigmentExport;
use App\Exports\ReportExport;
use App\Exports\DistribucionExport;
use App\Exports\DocenteExport;
use App\Exports\CursoExport;
use Maatwebsite\Excel\Facades\Excel;

class PDFController extends Controller
{
   

    public function Reporteindex(){

        $dist = Distribucionmacu::all();
      
        $doc = Distribuciondo::all();
        $est = Assignment::all();
       
        $users= User::all();
        //return $doc;
        return view('Reportes.reportedocente', compact('dist', 'doc','est','users'));
    }


    //////////////////////////////////////////
    ////Metodos para descargar reporte////////
    //////////////////////////////////////////

    public function UserExport(){

        return Excel::download(new ReportExport, 'user-list.xlsx');
    }

    public function DistribucionExport(){

        return Excel::download(new DistribucionExport , 'distribucion-list.xlsx');
    }

    public function AssigmentExport(){

        return Excel::download(new AssigmentExport , 'asignaciones-list.xlsx');
    }

    public function DocenteExport(){

        return Excel::download(new  DocenteExport , 'docentes-list.xlsx');
    }
    
    public function CursoExport(){

        return Excel::download(new  CursoExport , 'cursos-list.xlsx');
    }

   




}