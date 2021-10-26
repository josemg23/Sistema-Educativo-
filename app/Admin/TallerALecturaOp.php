<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerALecturaOp extends Model
{
    public function tallerLectura(){
       return $this->belongsTo('App\Admin\TallerALectura');
    }
}
