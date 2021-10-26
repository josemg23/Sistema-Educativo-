<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerCeldaClasificar extends Model
{
     public function tallerCelda(){

        return $this->belongsTo('App\Admin\TallerCelda');
    }
}
