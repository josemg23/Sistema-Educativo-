<?php

namespace App;
use App\Materia;
use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    protected $fillable = [
        'nombre','descripcion','estado'

    ];

    public function materia(){
          
        return $this->belongsTo('App\Materia');

    }

    public function tallers(){
          
        return $this->hasMany('App\Taller');
    }


   public function documentos(){
          
        return $this->hasMany('App\Documento');
    }


    
}
