<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerAnalizar extends Model
{
    public function taller(){

        return $this->belongsTo('App\Taller');
    }
     public function tallerAnalizarOp(){

        return $this->hasMany('App\Admin\TallerAnalizarOp');
    }
}
