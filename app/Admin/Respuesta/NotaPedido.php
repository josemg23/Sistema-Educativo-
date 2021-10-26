<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class NotaPedido extends Model
{
    public function taller(){
        return $this->belongsTo('App\Taller');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
     public function notapedidoRe(){
        return $this->hasMany('App\Admin\Respuesta\NotaPedidoRe');
    }
}
