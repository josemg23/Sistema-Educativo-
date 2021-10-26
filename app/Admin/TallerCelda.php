<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerCelda extends Model
{
     public function taller(){

        return $this->belongsTo('App\Taller');
    }
     public function celdaClasificaciones(){

        return $this->hasMany('App\Admin\TallerCeldaClasificacion');
    }
      public function celdaClasificados(){

        return $this->hasMany('App\Admin\TallerCeldaClasificar');
    }
}
