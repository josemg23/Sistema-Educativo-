<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerSenalar extends Model
{
     public function Taller(){

        return $this->belongsTo('App\Taller');
    }
      public function options(){

        return $this->hasMany('App\Admin\TallerSenalarOpcion');
    }
}
