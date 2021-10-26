<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerTipoSaldo extends Model
{
    public function taller(){

        return $this->belongsTo('App\Taller');
    }
    // public function tsRegistro(){
    //    return $this->hasMany('App\Admin\TipoSRegistro');
    // }
      public function saldoHaber(){
       return $this->hasMany('App\Admin\TipoSaldoHaber');
    }

     public function saldoDebe(){
       return $this->hasMany('App\Admin\TipoSaldoDebe');
    }
}
