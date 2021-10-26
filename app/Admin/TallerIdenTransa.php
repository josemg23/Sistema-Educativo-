<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerIdenTransa extends Model
{
     public function taller(){

        return $this->belongsTo('App\Taller');
    }
     public function tallerIdenTranOp(){

        return $this->hasMany('App\Admin\TallerIdenTransaOp');
    }
}
