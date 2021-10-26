<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retencionivaventa extends Model
{
    public function retencioniva(){
        return $this->belongsTo('App\Retencioniva');
     }

}
