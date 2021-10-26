<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerSenalarOpcion extends Model
{
     public function tallerSeñalar(){

        return $this->belongsTo('App\Admin\TallerSenalar');
    }
}
