<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerCompletarEnunciado extends Model
{
    public function taller(){

        return $this->belongsTo('App\Taller');
    }
     public function completarEnlist(){

        return $this->hasMany('App\TallerCompletarEnunRe');
    }
}
