<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conciliacionbancaria extends Model
{
    public function taller(){
        return $this->belongsTo('App\Taller');
     }
     public function user(){
        return $this->belongsTo('App\User');
     }



     public function conciliaciondebitos(){

        return $this->hasMany('App\Conciliaciondebito');
    }
    public function conciliacioncrditos(){

        return $this->hasMany('App\Conciliacioncredito');
    }

    public function conciliacionsaldos(){

        return $this->hasMany('App\Conciliacionsaldo');
    }

    public function conciliacioncheques(){

        return $this->hasMany('App\Conciliacioncheque');
    }

    public function conciliaciondepositos(){

        return $this->hasMany('App\Conciliaciondeposito');
    }

}
