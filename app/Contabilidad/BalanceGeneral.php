<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class BalanceGeneral extends Model
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
    public function bgActivos(){
       return $this->hasMany('App\Contabilidad\BGActivo');
    }
      public function bgPasivos(){
       return $this->hasMany('App\Contabilidad\BGPasivo');
    }
       public function bgPatrimonios(){
       return $this->hasMany('App\Contabilidad\BGPatrimonio');
    }
}
