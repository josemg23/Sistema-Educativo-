<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
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

     public function materias(){
         
        return $this->belongsToMany(Materia::class)->withPivot('assignment_id', 'materia_id')->withTimestamps();
    }
    
}
