<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conciliacioncredito extends Model
{
    public function conciliacionbancaria(){

        return $this->belongsTo('App\Conciliacionbancaria');
    }
}
