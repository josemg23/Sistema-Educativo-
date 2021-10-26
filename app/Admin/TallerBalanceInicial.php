<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerBalanceInicial extends Model
{
    public function moduloContable(){

        return $this->belongsTo('App\Admin\TallerModuloContable');
    }
}
