<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TallerArchivo extends Model
{
       public function taller(){

        return $this->belongsTo('App\Taller');
    }
}
