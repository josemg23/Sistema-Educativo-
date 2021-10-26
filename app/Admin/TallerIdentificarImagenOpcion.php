<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TallerIdentificarImagenOpcion extends Model
{
      public function tallerIdentificarImg(){

        return $this->belongsTo('App\Admin\TallerIdentificarImagen', 'taller_img_id');
    }
}
