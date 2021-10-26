<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conciliaciondeposito extends Model
{
    public function conciliacionbancaria(){

        return $this->belongsTo('App\Conciliacionbancaria');
    }
}
