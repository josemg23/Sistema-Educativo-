<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class KPRegistro extends Model
{
       public function kardexProm(){
        return $this->belongsTo('App\Contabilidad\KardexPromedio');
    }
}
