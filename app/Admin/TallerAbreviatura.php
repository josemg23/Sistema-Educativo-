<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerAbreviatura extends Model
{
     public function Taller(){

        return $this->belongsTo('App\Taller');
    }
    public function abreviaturaImg(){

        return $this->hasMany('App\Admin\TallerAbreviaturaImg');
    }
}
