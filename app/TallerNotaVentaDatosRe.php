<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TallerNotaVentaDatosRe extends Model
{
    public function tallerNotaVentaRe(){

        return $this->belongsTo('App\TallerNotaVentaRe');
    }
}
