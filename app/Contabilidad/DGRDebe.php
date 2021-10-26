<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class DGRDebe extends Model
{
    public function dgRegistro(){

        return $this->belongsTo('App\Contabilidad\DGRegistro');
    }
}
