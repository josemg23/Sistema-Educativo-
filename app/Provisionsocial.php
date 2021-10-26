<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provisionsocial extends Model
{
    
    public function taller(){
        return $this->belongsTo('App\Taller');
     }
     public function user(){
        return $this->belongsTo('App\User');
     }

     public function movimientoprovisions(){

        return $this->hasMany('App\Movimientoprovision');
    }

}
