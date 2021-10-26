<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerRAlternativa extends Model
{
      public function taller(){

        return $this->belongsTo('App\Taller');
    }
     public function alternativas(){

        return $this->hasMany('App\Admin\RAAlternativa');
    }
      public function definiciones(){

        return $this->hasMany('App\Admin\RADefinicion');
    }
      public function enunciados(){

        return $this->hasMany('App\Admin\RAEnunciado');
    }
}
