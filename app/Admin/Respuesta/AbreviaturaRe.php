<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class AbreviaturaRe extends Model
{
     public function abreviatura(){

        return $this->belongsTo('App\Admin\Respuesta\Abreviatura');
    }
}
