<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class RelacionarRe extends Model
{
    public function relacionar(){

        return $this->belongsTo('App\Admin\Respuesta\Relacionar');
    }
}
