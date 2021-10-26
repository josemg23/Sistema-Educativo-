<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerVerdaderoFalso extends Model
{
     public function Taller(){

        return $this->belongsTo('App\Taller');
    }
    public function tallerVerFalOp(){

        return $this->hasMany('App\Admin\TallerVerdaFalsoOp');
    }
}
