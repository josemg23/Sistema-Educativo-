<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
     public function Tallers()
    {
    	return $this->hasMany('App\Taller');
    }
}
