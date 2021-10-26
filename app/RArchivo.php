<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RArchivo extends Model
{
  public function archivo(){

        return $this->belongsTo('App\RespuestaArchivo');
    }
}
