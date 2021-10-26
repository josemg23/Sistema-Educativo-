<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerALectura extends Model
{
     public function taller(){

        return $this->belongsTo('App\Taller');
    }
     public function tallerLecturaOp(){

        return $this->hasMany('App\Admin\TallerALecturaOp');
    }
}
