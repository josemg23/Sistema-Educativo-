<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class EstadoResultado extends Model
{
    public function taller(){
       return $this->belongsTo('App\Taller');
    }
    public function user(){
       return $this->belongsTo('App\User');
    }
      public function erIngreso(){
       return $this->hasMany('App\Contabilidad\ERIngreso');
    }
}
