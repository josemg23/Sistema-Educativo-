<?php

namespace App;
use App\Materia;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Neurony\Duplicate\Options\DuplicateOptions;
use Neurony\Duplicate\Traits\HasDuplicates;

class Instituto extends Model
{
   use HasDuplicates;

    protected $fillable = [
        'nombre','descripcion','provincia','canton',
        'direccion','telefono','email','telefono',
        'estado',
    ];

    public function getDuplicateOptions(): DuplicateOptions
    {
        return DuplicateOptions::instance()
        ->excludeRelations('users');
    }

    //relacion de uno a muchos en este caso el muchos usuarios tomaran 1 dato de instituto
    // haciendo referencia de 1 a muchos

    public function users(){
          
        return $this->hasMany('App\User');

    }

    public function posts(){
          
        return $this->hasMany('App\Post');
    }

    public function materias(){

        return $this->hasMany('App\Materia');
        
    }
    public function contenidos()
    {
            return $this->hasManyThrough('App\Contenido', 'App\Materia');
    }

    
    public function distribumacus(){
          
        return $this->hasMany('App\Distribucionmacu');

    }

    public function distmas(){
          
        return $this->hasMany('App\Distrima');

    }

    public function distribuciondos(){
          
        return $this->hasMany('App\Distribuciondo');
    }


    
    public function clinsitutos(){
          
        return $this->hasMany('App\User');

    }

    public function assignmets(){
          
        return $this->hasMany('App\Assignment');
    }

    public function historials(){
          
        return $this->hasMany('App\Historial');
    }
    
}
