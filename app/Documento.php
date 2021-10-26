<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = [
        'nombre','descripcion','estado'

    ];

  public function contenido(){
          
        return $this->belongsTo('App\Contenido');

    }


 public function archivo(){

        return $this->morphOne('App\Archivo','archivoable');
    }

}
