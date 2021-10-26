<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class BIPasivo extends Model
{
     public function balanceInicial(){

        return $this->belongsTo('App\Contabilidad\BalanceInicial');
    }
}
