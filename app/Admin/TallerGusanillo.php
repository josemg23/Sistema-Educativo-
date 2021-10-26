<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerGusanillo extends Model
{
    public function Taller(){

        return $this->belongsTo('App\Taller');
    }
}
