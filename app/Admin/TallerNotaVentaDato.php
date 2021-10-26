<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerNotaVentaDato extends Model
{
      public function tallerNotaVenta(){

        return $this->belongsTo('App\Admin\TallerNotaVenta');
    }
}
