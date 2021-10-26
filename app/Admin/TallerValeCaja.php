<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerValeCaja extends Model
{
    public function Taller(){

        return $this->belongsTo('App\Taller');
    }
}
