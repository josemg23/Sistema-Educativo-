<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class Relacionar2 extends Model
{
       public function taller(){

        return $this->belongsTo('App\Taller');
    }
    
    public function user(){

        return $this->belongsTo('App\User');
    }
      public function relacionarrs2(){

        return $this->hasMany('App\Admin\Respuesta\Relacionar2Re');
    }
}
