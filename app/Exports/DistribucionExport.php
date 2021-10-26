<?php

namespace App\Exports;

use App\Distribucionmacu;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DistribucionExport implements FromView 
{
   
   public function view(): View
   {
             return view('Reportes.documento.distribucionmacu',[
                 'dist' => Distribucionmacu::get()
             ]);
   }
   
}
