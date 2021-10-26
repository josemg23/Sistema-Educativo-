<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class ACRegistro extends Model
{
     public function asientoCierre(){
        return $this->belongsTo('App\Contabilidad\AsientoCierre');
    }
     public function acrHaber(){
       return $this->hasMany('App\Contabilidad\ACRHaber');
    }

     public function acrDebe(){
       return $this->hasMany('App\Contabilidad\ACRDebe');
    }
}
