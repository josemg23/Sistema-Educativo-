<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerDefinirEnunOp extends Model
{
     public function TallerDefinirEnun(){

        return $this->belongsTo('App\Admin\TallerDefinirEnunciado');
    }
}
