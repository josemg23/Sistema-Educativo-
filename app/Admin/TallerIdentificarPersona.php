<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerIdentificarPersona extends Model
{
      public function Taller(){

        return $this->belongsTo('App\Taller');
    }

}
