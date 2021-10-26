<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class BGActivo extends Model
{
     public function balanceGeneral(){

        return $this->belongsTo('App\Contabilidad\BalanceGeneral');
    }
}
