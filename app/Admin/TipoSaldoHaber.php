<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TipoSaldoHaber extends Model
{
    public function saldoRegister(){

        return $this->belongsTo('App\Admin\TipoSRegistro');
    }
}
