<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class RADefinicion extends Model
{
       public function tallerRAlternativa(){

        return $this->belongsTo('App\Admin\TallerRAlternativa');
    }
}
