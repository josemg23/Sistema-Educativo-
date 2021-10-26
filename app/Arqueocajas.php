<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arqueocajas extends Model
{
    public function arqueosaldos(){

        return $this->hasMany('App\ArqueoSaldo');
    }
    public function arqueoexis(){

        return $this->hasMany('App\ArqueoExi');
    }

    public function taller(){
        return $this->belongsTo('App\Taller');
     }
     public function user(){
        return $this->belongsTo('App\User');
     }
}
