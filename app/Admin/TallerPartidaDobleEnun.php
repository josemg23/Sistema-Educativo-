<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerPartidaDobleEnun extends Model
{
       public function tallerPartidaDoble(){

        return $this->belongsTo('App\Admin\TallerPartidaDoble');
    }
}
