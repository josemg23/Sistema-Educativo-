<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class CompletarEnunciadoRes extends Model
{
    public function completarEnun(){

        return $this->belongsTo('App\Admin\Respuesta\CompletarEnunciado');
    }
}
