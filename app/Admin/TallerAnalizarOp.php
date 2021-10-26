<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerAnalizarOp extends Model
{
    public function tallerAnalizar(){

        return $this->belongsTo('App\Admin\TallerAnalizar');
    }
}
