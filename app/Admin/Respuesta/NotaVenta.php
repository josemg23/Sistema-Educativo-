<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class NotaVenta extends Model
{
      public function taller(){
        return $this->belongsTo('App\Taller');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
     public function notavDatos(){
        return $this->hasMany('App\Admin\Respuesta\NotaVentaDato');
    }
}
