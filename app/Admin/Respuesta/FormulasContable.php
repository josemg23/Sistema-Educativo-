<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class FormulasContable extends Model
{
    public function taller(){

        return $this->belongsTo('App\Taller');
    }
    
    public function user(){

        return $this->belongsTo('App\User');
    }
}
