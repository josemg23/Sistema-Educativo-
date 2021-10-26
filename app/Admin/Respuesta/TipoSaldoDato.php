<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class TipoSaldoDato extends Model
{
     public function tipoSaldo(){

        return $this->belongsTo('App\Admin\Respuesta\TipoSaldo');
    }
}
