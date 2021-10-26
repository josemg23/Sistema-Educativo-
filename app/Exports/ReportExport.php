<?php

namespace App\Exports;

use App\User;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView 
{

   

   public function view(): View
   {
             return view('Reportes.documento.usuarios',[
                 'users' => User::get()
             ]);
   }


}
