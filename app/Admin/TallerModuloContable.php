<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerModuloContable extends Model
{
    public function taller(){
        return $this->belongsTo('App\Taller');
    }
     public function modulotransaccion(){

        return $this->hasMany('App\Admin\TallerBalanceInicial');
    }
}
