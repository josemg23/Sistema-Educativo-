<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Taller2Relacionar extends Model
{
      public function Taller(){

        return $this->belongsTo('App\Taller');
    }
      public function relacionarOptions(){

        return $this->hasMany('App\Admin\TallerRelacionarOpcion');
    }
     public function relacionar2Options(){

        return $this->hasMany('App\Admin\Taller2RelacionarOpcion');
    }
}
