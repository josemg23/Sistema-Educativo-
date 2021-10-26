<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class Relacionar2Re extends Model
{
    public function relacionar2(){

        return $this->belongsTo('App\Admin\Respuesta\Relacionar2');
    }
}
