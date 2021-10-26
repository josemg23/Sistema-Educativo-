<?php

namespace App;
use App\User;
use App\Materia;
use Illuminate\Database\Eloquent\Model;

class Distribuciondo extends Model
{
    protected $fillable = [
        
        'estado',
     ];

     public function user(){
          
        return $this->belongsTo('App\User');

    }
     public function instituto(){
          
        return $this->belongsTo('App\Instituto');

    }

     public function materia(){
         
        return $this->belongsTo('App\Materia');
    }
    
    public function paralelos(){
         
        return $this->belongsToMany(Nivel::class)->withPivot('distribuciondo_id', 'nivel_id')->withTimestamps();
    }



}



