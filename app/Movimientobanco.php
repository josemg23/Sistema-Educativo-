<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimientobanco extends Model
{
 
    public function Librobanco(){

        return $this->belongsTo('App\Librobanco');
    }
}
