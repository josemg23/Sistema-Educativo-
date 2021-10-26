<?php

namespace App\Modulo;

use Illuminate\Database\Eloquent\Model;

class ModuloNotaCredito extends Model
{
      public function taller(){

        return $this->belongsTo('App\Taller');
    }
    
    public function user(){

        return $this->belongsTo('App\User');
    }
}
