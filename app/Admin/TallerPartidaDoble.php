<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerPartidaDoble extends Model
{
       public function taller(){

        return $this->belongsTo('App\Taller');
    }
      public function partidaDobleEnn(){

        return $this->hasMany('App\Admin\TallerPartidaDobleEnun');
    }
}
