<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class FacturaDato extends Model
{
     public function factura(){

        return $this->belongsTo('App\Admin\Respuesta\Factura');
    }
}
