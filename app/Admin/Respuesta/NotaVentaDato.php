<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class NotaVentaDato extends Model
{
     public function notaVenta(){

        return $this->belongsTo('App\Admin\Respuesta\NotaVenta');
    }
}
