<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class ERIngreso extends Model
{
     public function eResultado(){
        return $this->belongsTo('App\Contabilidad\EstadoResultado');
    }
}
