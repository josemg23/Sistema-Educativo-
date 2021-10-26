<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class EscribirCuenta extends Model
{
     public function taller(){
       return $this->belongsTo('App\Taller');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
     public function activos(){
        return $this->hasMany('App\Admin\Respuesta\Activo4');
    }
     public function pasivos(){
        return $this->hasMany('App\Admin\Respuesta\Pasivo4');
    }
     public function patrimonios(){
        return $this->hasMany('App\Admin\Respuesta\Patrimonio4');
    }

}
