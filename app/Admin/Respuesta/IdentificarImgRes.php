<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class IdentificarImgRes extends Model
{
    public function identificar(){

        return $this->belongsTo('App\Admin\Respuesta\Identificar');
    }
}
