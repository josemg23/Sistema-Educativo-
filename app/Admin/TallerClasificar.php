<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerClasificar extends Model
{
     public function Taller(){

        return $this->belongsTo('App\Taller');
    }
   
}
