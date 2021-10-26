<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaArchivo extends Model
{
        public function taller(){

        return $this->belongsTo('App\Taller');
    }
    
    public function user(){

        return $this->belongsTo('App\User');
    }
      public function rarchivos(){

        return $this->hasMany('App\RArchivo');
    }
}
