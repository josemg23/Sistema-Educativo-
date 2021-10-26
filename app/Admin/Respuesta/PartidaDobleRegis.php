<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class PartidaDobleRegis extends Model
{
     public function partidaDoble(){

        return $this->belongsTo('App\Admin\Respuesta\PartidaDoble');
    }
     public function pdDebe(){

        return $this->hasMany('App\Admin\Respuesta\PDDebe');
    }
     public function pdHaber(){

        return $this->hasMany('App\Admin\Respuesta\PDHaber');
    }
}
