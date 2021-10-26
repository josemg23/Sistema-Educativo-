<?php

namespace App;
use App\Materia;
use App\Curso;
use App\Nivel;
use App\Distrima;
use Illuminate\Database\Eloquent\Model;

class Distribucionmacu extends Model
{


    protected $fillable = [
        
       'estado',
    ];

 public function materias(){
         
        return $this->belongsToMany(Materia::class)->withPivot('distribucionmacu_id', 'materia_id')->withTimestamps();
    }
    

    public function curso(){
          
        return $this->belongsTo('App\Curso');

    }

    public function tallers(){
        return $this->belongsToMany('App\Taller','distribucionmacu_taller')
            ->withPivot('estado','contenido_id', 'fecha_entrega', 'plantilla_id');
    }
    
    
    public function instituto(){
          
        return $this->belongsTo('App\Instituto');

    }
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function nivel(){
        
        return $this->belongsTo('App\Nivel');

    }
  
    public function distrimas(){
          
        return $this->hasMany('App\Distrima');

    }


    
    public function posts(){
          
        return $this->hasMany('App\Post');
    }
  

}