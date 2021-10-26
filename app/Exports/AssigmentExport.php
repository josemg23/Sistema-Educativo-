<?php

namespace App\Exports;

use App\Assignment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AssigmentExport implements FromView
{
    
    public function view(): View
    {
              return view('Reportes.documento.assignment',[
                  'est' => Assignment::get()
              ]);
    }
}
