<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class TipoSaldo extends Model
{
    public function taller(){

        return $this->belongsTo('App\Taller');
    }
    
    public function user(){

        return $this->belongsTo('App\User');
    }
      public function saldoDato(){
        return $this->hasMany('App\Admin\Respuesta\TipoSaldoDato');
    }
}
