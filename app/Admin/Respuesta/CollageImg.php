<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class CollageImg extends Model
{
     public function collage(){

        return $this->belongsTo('App\Admin\Respuesta\Collage');
    }
}
