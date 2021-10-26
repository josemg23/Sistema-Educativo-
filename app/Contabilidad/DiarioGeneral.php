<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class DiarioGeneral extends Model
{
     public function taller(){
       return $this->belongsTo('App\Taller');
    }
    public function user(){
       return $this->belongsTo('App\User');
    }
    public function bInical(){
       return $this->belongsTo('App\Contabilidad\BalanceInicial');
    }
    public function dgRegistro(){
       return $this->hasMany('App\Contabilidad\DGRegistro');
    }

}
