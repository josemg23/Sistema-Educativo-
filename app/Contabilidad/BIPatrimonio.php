<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class BIPatrimonio extends Model
{
     public function balanceInicial(){

        return $this->belongsTo('App\Contabilidad\BalanceInicial');
    }
}
