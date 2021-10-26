<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArqueoExi extends Model
{
    public function Arqueocaja(){

        return $this->belongsTo('App\Arqueocajas');
    }
}
