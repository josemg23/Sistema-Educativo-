<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerCeldaClasificacion extends Model
{
     public function tallerCelda(){

        return $this->belongsTo('App\Admin\TallerCelda');
    }
      public function clasificadoscelda(){

        return $this->hasMany('App\Admin\Respuesta\CeldaClasificado');
    }
}
