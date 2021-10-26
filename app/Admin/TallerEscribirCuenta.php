<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerEscribirCuenta extends Model
{
      public function taller()
    {
        return $this->belongsTo('App\Taller');
    }
}
