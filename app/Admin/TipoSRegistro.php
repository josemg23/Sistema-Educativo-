<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TipoSRegistro extends Model
{
    public function tallerSaldo(){
        return $this->belongsTo('App\Admin\TallerTipoSaldo');
    }
    //  public function saldoHaber(){
    //    return $this->hasMany('App\Admin\TipoSaldoHaber');
    // }

    //  public function saldoDebe(){
    //    return $this->hasMany('App\Admin\TipoSaldoDebe');
    // }
}
