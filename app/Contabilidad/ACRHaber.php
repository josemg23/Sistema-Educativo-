<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class ACRHaber extends Model
{
      public function acRegistro(){

        return $this->belongsTo('App\Contabilidad\ACRegistro');
    }
}
