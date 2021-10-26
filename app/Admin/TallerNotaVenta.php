<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerNotaVenta extends Model
{
    public function Taller(){

        return $this->belongsTo('App\Taller');
    }
       public function notaventaDatos(){

        return $this->hasMany('App\Admin\TallerNotaVentaDato');
    }
}
