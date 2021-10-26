<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TipoSaldoDebe extends Model
{
    public function saldoRegister(){

        return $this->belongsTo('App\Admin\TipoSRegistro');
    }
}
