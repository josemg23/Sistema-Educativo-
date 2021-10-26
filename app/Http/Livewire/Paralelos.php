<?php

namespace App\Http\Livewire;

use App\Distribuciondo;
use App\Distribucionmacu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Paralelos extends Component
{
		        protected $listeners = [
    'render',
    
];
		public $p = [];
		public $filtros_paralelos;
		public  $taller;
		public function mount($id, $taller)
	{
        $user_id = Auth::id();
		$this->materia_id = $id;
		$this->taller = $taller;
          $curso = Distribucionmacu::join('distribucionmacu_materia', 'distribucionmacu_materia.distribucionmacu_id', '=', 'distribucionmacus.id')
         ->where('distribucionmacu_materia.materia_id', $this->materia_id)
         ->select('distribucionmacus.*')
         ->first();
         $this->curso = $curso;

        $distribuciondo = Distribuciondo::where('user_id', $user_id)->where('materia_id', $this->materia_id)->first();

         $this->filtros_paralelos = $distribuciondo->paralelos;
           
        foreach ($this->filtros_paralelos as $fp) {
            $this->p[] = $fp->id;
        }
	}
    public function render()
    {
    	 $niveles = DB::table('distribucionmacu_taller')
        ->join('nivels', 'distribucionmacu_taller.nivel_id', '=', 'nivels.id')
        ->select('distribucionmacu_taller.*', 'nivels.nombre as nivel_nombre')
        ->whereIn('nivel_id', $this->p)
        ->where('taller_id', $this->taller)
        ->get();
        return view('livewire.paralelos',
        	[
        		'niveles' => $niveles

        	]);
    }
}
