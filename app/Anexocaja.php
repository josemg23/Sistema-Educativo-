<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anexocaja extends Model
{
    public function cajadatos(){

        return $this->hasMany('App\Cajadatos');
    }

    public function taller(){
        return $this->belongsTo('App\Taller');
     }
     public function user(){
        return $this->belongsTo('App\User');
     }
}
