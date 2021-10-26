<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerOrdenPago extends Model
{
     public function Taller(){

        return $this->belongsTo('App\Taller');
    }
}
