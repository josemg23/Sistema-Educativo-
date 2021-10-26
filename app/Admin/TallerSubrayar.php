<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerSubrayar extends Model
{
     public function Taller(){

        return $this->belongsTo('App\Taller');
    }
     public function tallerSubraOps(){

        return $this->hasMany('App\Admin\TallerSubrayarOp', 'taller_subrayars_id');
    }
   
}
