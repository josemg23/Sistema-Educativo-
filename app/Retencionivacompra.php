<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retencionivacompra extends Model
{
    public function retencioniva(){
        return $this->belongsTo('App\Retencioniva');
     }
}
