<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivodocente extends Model
{
    
    protected $fillable = [
        'nombre','descripcion'

    ];

    public function materia(){
          
        return $this->belongsTo('App\Materia');

    }

    public function nivel(){
          
        return $this->belongsTo('App\Nivel');

    }


    public function user(){
          
        return $this->belongsTo('App\User');

    }


    public function documentodoc(){

        return $this->morphOne('App\Documentodoc','documentable');
    }

}
