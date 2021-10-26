<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class Subrayar extends Model
{
     public function taller(){

        return $this->belongsTo('App\Taller');
    }
    
    public function user(){

        return $this->belongsTo('App\User');
    }
      public function subrayarres(){

        return $this->hasMany('App\Admin\Respuesta\SubrayarRes');
    }
}
