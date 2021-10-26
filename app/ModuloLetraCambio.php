<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuloLetraCambio extends Model
{
    public function taller(){

        return $this->belongsTo('App\Taller');
    }
    
    public function user(){

        return $this->belongsTo('App\User');
    }
}
