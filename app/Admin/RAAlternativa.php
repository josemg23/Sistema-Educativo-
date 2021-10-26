<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class RAAlternativa extends Model
{
     public function tallerRAlternativa(){

        return $this->belongsTo('App\Admin\TallerRAlternativa');
    }
}
