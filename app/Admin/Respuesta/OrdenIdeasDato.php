<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class OrdenIdeasDato extends Model
{
     public function ordenIdea(){

        return $this->belongsTo('App\Admin\Respuesta\OrdenIdea');
    }
}
