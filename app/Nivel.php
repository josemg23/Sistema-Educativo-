<?php

namespace App;
use App\Curso;
use App\Distribucionmacu;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $fillable = [
        'nombre',
        'estado',
    ];

    public function cursos(){
          
        return $this->hasMany('App\Curso');

    }
    public function distribucionmacus(){
        
        return $this->hasMany('App\Distribucionmacu');

    }

    public function distrimas(){
        
        return $this->hasMany('App\Distrima');

    }

    public function users(){
        
        return $this->hasMany('App\User');

    }
     public function distribuciondos(){
         
        return $this->belongsToMany(Distribuciondo::class)->withPivot('distribuciondo_id', 'nivel_id')->withTimestamps();
    }


    public function archivodocentes(){
          
        return $this->hasMany('App\Archivodocente');
    }

    public function posts(){
          
        return $this->hasMany('App\Post');
    }

    public function historials(){
          
        return $this->hasMany('App\Historial');
    }
}
