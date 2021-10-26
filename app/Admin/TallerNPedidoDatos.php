<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerNPedidoDatos extends Model
{
    public function tallerNPedido(){

        return $this->belongsTo('App\Admin\TallerNotaPedido');
    }
}
