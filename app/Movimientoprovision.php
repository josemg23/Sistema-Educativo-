<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimientoprovision extends Model
{
    public function provisionsocial(){
        return $this->belongsTo('App\Provisionsocial');
     }
}
