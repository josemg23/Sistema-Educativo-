<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TallerFacturaDatosRe extends Model
{
	 public function tallerFacturaRe(){

        return $this->belongsTo('App\TallerFacturaRe');
    }
}
