<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TallerCompletarEnunRe extends Model
{
      public function TallerCompletarEnu(){

        return $this->belongsTo('App\Admin\TallerCompletarEnunciado');
    }
}
