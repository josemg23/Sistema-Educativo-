<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerRelacionar extends Model
{
     public function Taller(){

        return $this->belongsTo('App\Taller');
    }
      public function relacionarOptions(){

        return $this->hasMany('App\Admin\TallerRelacionarOpcion');
    }
}
