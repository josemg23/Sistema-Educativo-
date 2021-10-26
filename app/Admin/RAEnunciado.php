<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class RAEnunciado extends Model
{
       public function tallerRAlternativa(){

        return $this->belongsTo('App\Admin\TallerRAlternativa');
    }
}
