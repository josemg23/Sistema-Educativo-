<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Taller2RelacionarOpcion extends Model
{
    public function taller2Relacionar(){

        return $this->belongsTo('App\Admin\Taller2Relacionar');
    }
}
