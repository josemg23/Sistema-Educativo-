<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class BGPatrimonio extends Model
{
     public function balanceGeneral(){

        return $this->belongsTo('App\Contabilidad\BalanceGeneral');
    }
}
