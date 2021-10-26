<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerIdenTransaOp extends Model
{
     public function tallerITransa(){

        return $this->belongsTo('App\Admin\TallerIdenTransa');
    }
}
