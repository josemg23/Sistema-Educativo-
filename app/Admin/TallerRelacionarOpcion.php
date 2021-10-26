<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerRelacionarOpcion extends Model
{
     public function tallerRelacionar(){

        return $this->belongsTo('App\Admin\TallerRelacionar');
    }
}
