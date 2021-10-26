<?php

namespace App\Http\Livewire;

use App\Contenido;
use App\Distribuciondo;
use App\Distribucionmacu;
use App\Materia;
use App\Taller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Talleres extends Component
{
        protected $listeners = [
    'active',
    
];
      use WithPagination;
       protected $paginationTheme = 'bootstrap';

    public $materia_id, $status, $date, $select_id, $buscador, $date_paralelo, $estado, $paralelo_id = '', $search_paralelo = '';

    public $perPage    = 10;
    public $search     = '';
    public $orderBy    = 'id';
    public $orderAsc   = true;
    public $curso_id   = '';
    public $curso;
    public $paralelos = [];
    public $filtros_paralelos = [];
    public $p = [];

    public function mount($id)
    {
        $user_id = Auth::id();
        $this->materia_id = $id;
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
         // $materia = Materia::select('nombre')->where('id', $id)->first();
        // $this->contenidos = $contenido;
    }
    public function render()
    {
         $contenidos = Contenido::where('materia_id', $this->materia_id)->get();
          $niveles = DB::table('distribucionmacu_taller')
        ->join('nivels', 'distribucionmacu_taller.nivel_id', '=', 'nivels.id')
        ->select('distribucionmacu_taller.*', 'nivels.nombre as nivel_nombre')
        ->whereIn('nivel_id', $this->p)
        ->get();



// dd($niveles);

         if ($this->search_paralelo == '') {
              $activados = DB::table('distribucionmacu_taller')
            ->join('contenidos', 'distribucionmacu_taller.contenido_id', '=', 'contenidos.id')
            ->join('tallers', 'distribucionmacu_taller.taller_id', '=', 'tallers.id')
            ->join('nivels', 'distribucionmacu_taller.nivel_id', '=', 'nivels.id')
            ->where(function ($query) {
                       $query->where('tallers.enunciado', 'like', '%'.$this->buscador.'%')
                            ->orWhere('contenidos.nombre', 'like', '%'.$this->buscador.'%');
                 })
            ->where('contenidos.materia_id', $this->materia_id)
            ->whereIn('nivel_id', $this->p)
            ->select('distribucionmacu_taller.*', 'tallers.enunciado as enunciado_taller', 'tallers.nombre as nombre_taller','nivels.nombre as paralelo', 'contenidos.nombre as nombre_unidad')
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
         }else {
             
         
         $activados = DB::table('distribucionmacu_taller')
            ->join('contenidos', 'distribucionmacu_taller.contenido_id', '=', 'contenidos.id')
            ->join('tallers', 'distribucionmacu_taller.taller_id', '=', 'tallers.id')
            ->join('nivels', 'distribucionmacu_taller.nivel_id', '=', 'nivels.id')
            ->where(function ($query) {
                       $query->where('tallers.enunciado', 'like', '%'.$this->buscador.'%')
                            ->orWhere('contenidos.nombre', 'like', '%'.$this->buscador.'%');
                 })
            ->where('contenidos.materia_id', $this->materia_id)
            ->whereIn('nivel_id', $this->p)
            ->where('distribucionmacu_taller.nivel_id',$this->search_paralelo)
            ->select('distribucionmacu_taller.*', 'tallers.enunciado as enunciado_taller', 'tallers.nombre as nombre_taller','nivels.nombre as paralelo', 'contenidos.nombre as nombre_unidad')
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        }

        return view('livewire.talleres',[
            'contenidos' => $contenidos,
            'activados' => $activados,
            'niveles' => $niveles,
            // 'paralelos' => $paralelos
        ]);
    }

    public function active($id)
    {
        $user_id = Auth::id();

        $this->select_id = $id;
        $activados = DB::table('distribucionmacu_taller')
        ->where('taller_id', $id)
        ->select('nivel_id')
        ->get();
       

        $ids =[];
        foreach ($activados as $id) {
            $ids[] = $id->nivel_id;
        }
         $distribuciondo = Distribuciondo::where('user_id', $user_id)->where('materia_id', $this->materia_id)->first();

         $this->paralelos = $distribuciondo->paralelos->whereNotIn('id', $ids);



    }
   public function modify($id)
    {
        $this->select_id     = $id;
        $taller = DB::table('distribucionmacu_taller')
        ->where('id', $id)
        ->first();

        $this->date_paralelo = $taller->fecha_entrega;
        $this->estado        = $taller->estado;

    }

   public function actualizar()
    {
        $taller = DB::table('distribucionmacu_taller')
        ->where('id', $this->select_id)
        ->update(['estado' => $this->estado, 'fecha_entrega' => $this->date_paralelo]);

        // $taller->estado        = $this->estado;
        // $taller->fecha_entrega = $this->date_paralelo;
        // $taller->save();
        $this->estado          = '';
        $this->date_paralelo   = '';
        $this->dispatchBrowserEvent('activado', ['mensaje' => 'Asignacion de taller modificada correctamente', 'modal' => 'modal_activacion']);




    }
   public  function activar()
    {
        $c_id = $this->curso->id;

           $this->validate([
            'date'   => 'required',
            'paralelo_id' => 'required',
        ]);
        // $consulta = DB::table('distribucionmacu_taller')
        // ->where('taller_id', $this->select_id)
        // ->where('distribucionmacu_id', $c_id)
        // ->where('paralelo_id', $this->paralelo_id)
        // ->count();

        // if ($consulta >= 1 ) {
        // $this->dispatchBrowserEvent('activado', ['mensaje' => 'Este taller ya se encuentra activado para este paralelo']);
            
        // }else{

        $taller = Taller::find($this->select_id);
        $taller->distribucionmacus()->attach($c_id,['estado'=> 1 , 'plantilla_id'=> $taller->plantilla_id , 'contenido_id'=> $taller->contenido_id, 'nivel_id' => $this->paralelo_id, 'fecha_entrega' => $this->date]);
        $this->dispatchBrowserEvent('activado', ['mensaje' => 'Taller activado correctamente', 'modal' => 'fecha']);
        $this->select_id = '';
        $this->paralelo_id = '';
        $this->date = '';

        $this->emit('render');
        // }
    }
    public function eliminar($id)
    {
        $delete = DB::table('distribucionmacu_taller')->where('id', $id)->delete();
        $this->dispatchBrowserEvent('activado', ['mensaje' => 'Asignacion Eliminada']);
        $this->emit('render');
        

    }
}