<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerPagare extends Model
{
     public function Taller(){

        return $this->belongsTo('App\Taller');
    }
}
