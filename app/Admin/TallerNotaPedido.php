<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerNotaPedido extends Model
{
    public function Taller(){

        return $this->belongsTo('App\Taller');
    }
       public function pedidoDatos(){

        return $this->hasMany('App\Admin\TallerNPedidoDatos');
    }

}
