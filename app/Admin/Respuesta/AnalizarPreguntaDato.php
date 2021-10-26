<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class AnalizarPreguntaDato extends Model
{
    public function analizarPregunta(){

        return $this->belongsTo('App\Admin\Respuesta\AnalizarPregunta');
    }
}
