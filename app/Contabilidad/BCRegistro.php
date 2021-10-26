<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class BCRegistro extends Model
{
      public function balanceCompr(){
        return $this->belongsTo('App\Contabilidad\BalanceComprobacion');
    }
}
