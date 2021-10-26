<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerFacturaDato extends Model
{
      public function tallerFactura(){

        return $this->belongsTo('App\Admin\TallerFactura');
    }
}
