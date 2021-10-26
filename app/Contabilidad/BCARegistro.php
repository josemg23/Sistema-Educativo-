<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class BCARegistro extends Model
{
      public function balanceAjustado(){
        return $this->belongsTo('App\Contabilidad\BalanceAjustado');
    }
}
