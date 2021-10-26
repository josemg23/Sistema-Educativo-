<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class BIActivo extends Model
{
     public function balanceInicial(){

        return $this->belongsTo('App\Contabilidad\BalanceInicial');
    }
}
