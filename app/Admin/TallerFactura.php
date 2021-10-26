<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerFactura extends Model
{
      public function Taller(){

        return $this->belongsTo('App\Taller');
    }
       public function facturaDatos(){

        return $this->hasMany('App\Admin\TallerFacturaDato');
    }
}
