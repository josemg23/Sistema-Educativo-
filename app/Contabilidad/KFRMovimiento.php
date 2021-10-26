<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class KFRMovimiento extends Model
{
      public function kfRegistro(){

        return $this->belongsTo('App\Contabilidad\KFRegistro');
    }
}
