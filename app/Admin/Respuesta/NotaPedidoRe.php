<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class NotaPedidoRe extends Model
{
    public function notaPedido(){

        return $this->belongsTo('App\Admin\Respuesta\NotaPedido');
    }
}
