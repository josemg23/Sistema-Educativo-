<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class PDDebe extends Model
{
      public function pdregistro(){

        return $this->belongsTo('App\Admin\Respuesta\PartidaDobleRegis');
    }
}
