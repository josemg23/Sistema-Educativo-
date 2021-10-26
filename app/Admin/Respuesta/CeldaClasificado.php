<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class CeldaClasificado extends Model
{
      public function celda(){

        return $this->belongsTo('App\Admin\Respuesta\Celda');
    }
      public function celdaClasificacionRes(){

        return $this->belongsTo('App\Admin\TallerCeldaClasificacion');
    }
}
