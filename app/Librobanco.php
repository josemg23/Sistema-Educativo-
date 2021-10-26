<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Librobanco extends Model
{
    public function movimientobancos(){

        return $this->hasMany('App\Movimientobanco');
    }

    public function taller(){
        return $this->belongsTo('App\Taller');
     }
     public function user(){
        return $this->belongsTo('App\User');
     }
}
