<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerCheque extends Model
{
 public function Taller(){

        return $this->belongsTo('App\Taller');
    }
}
