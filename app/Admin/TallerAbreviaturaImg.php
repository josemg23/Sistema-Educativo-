<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerAbreviaturaImg extends Model
{
    public function tallerAbreviatura(){

        return $this->belongsTo('App\Admin\TallerAbreviatura');
    }
}
