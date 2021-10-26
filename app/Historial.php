<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    
    public function user(){
          
        return $this->belongsTo('App\User');
    }


    public function materia(){
          
        return $this->belongsTo('App\Materia');

    }

    
    public function nivel(){
        return $this->belongsTo('App\Nivel');
    }


    public function instituto(){
          
        return $this->belongsTo('App\Instituto');
    }


}
