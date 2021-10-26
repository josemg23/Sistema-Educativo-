<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class BalanceInicial extends Model
{
    public function taller(){
       return $this->belongsTo('App\Taller');
    }
    public function user(){
       return $this->belongsTo('App\User');
    }
    public function dGeneral(){
       return $this->hasOne('App\Contabilidad○\DiarioGeneral');
    }
    public function bActivos(){
       return $this->hasMany('App\Contabilidad\BIActivo');
    }
      public function bPasivos(){
       return $this->hasMany('App\Contabilidad\BIPasivo');
    }
       public function bPatrimonios(){
       return $this->hasMany('App\Contabilidad\BIPatrimonio');
    }
}
