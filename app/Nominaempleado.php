<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nominaempleado extends Model
{
    public function taller(){
        return $this->belongsTo('App\Taller');
     }
     public function user(){
        return $this->belongsTo('App\User');
     }

     public function movimientonominas(){

        return $this->hasMany('App\Movimientonomina');
    }
}
