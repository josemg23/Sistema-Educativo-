<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerVerdaFalsoOp extends Model
{
     public function tallerVerFal(){

        return $this->belongsTo('App\Admin\TallerVerdaderoFalso');
    }
}
