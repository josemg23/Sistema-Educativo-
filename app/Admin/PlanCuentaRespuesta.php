<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class PlanCuentaRespuesta extends Model
{
         public function taller(){

        return $this->belongsTo('App\Taller');
    }
    
    public function user(){

        return $this->belongsTo('App\User');
    }
}
