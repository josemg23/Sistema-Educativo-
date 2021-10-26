<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class KardexPromedio extends Model
{
    public function taller(){
       return $this->belongsTo('App\Taller');
    }
    public function user(){
       return $this->belongsTo('App\User');
    }
      public function kpRegistro(){
       return $this->hasMany('App\Contabilidad\KPRegistro');
    }
}
