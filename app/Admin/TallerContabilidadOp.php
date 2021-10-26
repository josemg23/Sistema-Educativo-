<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerContabilidadOp extends Model
{
    public function tallerContabilidad(){

        return $this->belongsTo('App\Admin\TallerContabilidad');
    }
}
