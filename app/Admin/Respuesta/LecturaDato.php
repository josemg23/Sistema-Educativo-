<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class LecturaDato extends Model
{
    public function lectura(){

        return $this->belongsTo('App\Admin\Respuesta\Lectura');
    }
}
