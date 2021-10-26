<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class HTRegistro extends Model
{
    public function hojaTrabajo(){
        return $this->belongsTo('App\Contabilidad\HojaTrabajo');
    }

}
