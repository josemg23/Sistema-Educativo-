<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class KFRegistro extends Model
{
     public function kardexFifo(){
        return $this->belongsTo('App\Contabilidad\KardexFifo');
    }
     public function kfrMovimientos(){
       return $this->hasMany('App\Contabilidad\KFRMovimiento');
    }
}
