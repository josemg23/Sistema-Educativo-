<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimientonomina extends Model
{
    public function nominaempleado(){
        return $this->belongsTo('App\Nominaempleado');
     }
}
