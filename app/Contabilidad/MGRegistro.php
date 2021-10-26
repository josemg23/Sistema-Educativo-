<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class MGRegistro extends Model
{
     public function mayorGeneral(){
        return $this->belongsTo('App\Contabilidad\MayorGeneral');
    }
     public function mgrMovimientos(){
       return $this->hasMany('App\Contabilidad\MGRMovimiento');
    }
}
