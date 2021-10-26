<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class IdenTrasaDato extends Model
{
      public function idenTrasa(){

        return $this->belongsTo('App\Admin\Respuesta\IdenTrasa');
    }
}
