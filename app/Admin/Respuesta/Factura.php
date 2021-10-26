<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
      public function taller(){
        return $this->belongsTo('App\Taller');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
     public function facturaDato(){
        return $this->hasMany('App\Admin\Respuesta\FacturaDato');
    }
}
