<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerSubrayarOp extends Model
{
    public function tallerSubrayar(){

        return $this->belongsTo('App\Admin\TallerSubrayar', 'taller_subrayars_id');
    }
}
