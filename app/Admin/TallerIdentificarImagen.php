<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerIdentificarImagen extends Model
{
    public function Taller(){

        return $this->belongsTo('App\Taller');
    }
     public function tallerimg(){

        return $this->hasMany('App\Admin\TallerIdentificarImagenOpcion', 'taller_img_id');
    }

}
