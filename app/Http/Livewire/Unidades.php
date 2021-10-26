<?php

namespace App\Http\Livewire;

use App\Taller;
use Livewire\Component;
use Livewire\WithPagination;

class Unidades extends Component
{
	use WithPagination;
    protected $paginationTheme = 'bootstrap';

	 protected $queryString =[
    'page'];

	public $contenido_id;
	public function mount($contenido)
	{
		$this->contenido_id = $contenido->id;

	}
    public function render()
    {
    	$tallers=Taller::where('contenido_id', $this->contenido_id)->paginate(10);

        return view('livewire.unidades',[
        	'tallers' => $tallers
        ]);
    }
    public function eliminarTaller($id)
    {
    	$taller=Taller::find($id);
    	$taller->delete();
    	$this->emit('postAdded');
    	
    }

     public function cambiar($id)
    {      
    	$taller = Taller::find($id);
       $estado = $taller->estado;
      
       if ($estado === 1) {
         $taller->estado = 0; 
         $taller->save(); 
        
       }elseif ($estado == 0) {
        $taller->estado = 1; 
        $taller->save();  
          
       }
    	$this->emit('Estado');
    	
    }
}
