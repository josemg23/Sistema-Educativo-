<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class VerdaderoFalsoRe extends Model
{
     public function verdadFalso(){

        return $this->belongsTo('App\Admin\Respuesta\VerdaderoFalso');
    }
}
