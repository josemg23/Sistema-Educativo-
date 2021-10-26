<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class Activo4 extends Model
{
    public function escribirCuenta(){
        return $this->belongsTo('App\Admin\Respuesta\EscribirCuenta');
    }
}
