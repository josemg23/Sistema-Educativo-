<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cajadatos extends Model
{
    
    public function Anexocaja(){

        return $this->belongsTo('App\AnexoCaja');
    }
}
