<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class BalanceAjustado extends Model
{
       public function taller(){
       return $this->belongsTo('App\Taller');
    }
    public function user(){
       return $this->belongsTo('App\User');
    }
      public function bcaRegistro(){
       return $this->hasMany('App\Contabilidad\BCARegistro');
    }
}
