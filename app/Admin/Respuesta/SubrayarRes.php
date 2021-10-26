<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class SubrayarRes extends Model
{
    public function subrayar(){

        return $this->belongsTo('App\Admin\Respuesta\Subrayar');
    }
}
