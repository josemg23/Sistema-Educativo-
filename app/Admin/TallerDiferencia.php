<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerDiferencia extends Model
{
    public function Taller(){

        return $this->belongsTo('App\Taller');
    }
}
