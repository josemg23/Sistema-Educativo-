<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class MGRMovimiento extends Model
{
    public function mgRegistro(){

        return $this->belongsTo('App\Contabilidad\MGRegistro');
    }
}
