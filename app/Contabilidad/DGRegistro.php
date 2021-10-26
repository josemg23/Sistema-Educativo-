<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class DGRegistro extends Model
{
     public function diarioGeneral(){
        return $this->belongsTo('App\Contabilidad\DiarioGeneral');
    }
     public function dgrHaber(){
       return $this->hasMany('App\Contabilidad\DGRHaber');
    }

     public function dgrDebe(){
       return $this->hasMany('App\Contabilidad\DGRDebe');
    }
}
