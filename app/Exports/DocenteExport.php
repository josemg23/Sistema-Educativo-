<?php

namespace App\Exports;

use App\Distribuciondo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DocenteExport implements FromView
{
    
    public function view(): View
   {
             return view('Reportes.documento.docente',[
                 'doc' => Distribuciondo::get()
             ]);
   }
}
