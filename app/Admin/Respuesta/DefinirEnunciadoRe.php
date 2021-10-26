<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class DefinirEnunciadoRe extends Model
{
    public function definirEnun(){

        return $this->belongsTo('App\Admin\Respuesta\DefinirEnunciado');
    }
}
