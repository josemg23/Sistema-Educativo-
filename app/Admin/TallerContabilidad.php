<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerContabilidad extends Model
{
     public function taller(){

        return $this->belongsTo('App\Taller');
    }
     public function tallerContabilidadOp(){

        return $this->hasMany('App\Admin\TallerContabilidadOp');
    }
}
