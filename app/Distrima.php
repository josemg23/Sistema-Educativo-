<?php

namespace App;
use App\Distribucionmacu;
use Illuminate\Database\Eloquent\Model;

class Distrima extends Model
{
    protected $fillable = [
       
        'estado',

    ];


    public function instituto(){
          
        return $this->belongsTo('App\Instituto');

    }

    public function user(){
          
        return $this->belongsTo('App\User');

    }

    public function distribucionmacu(){
          
        return $this->belongsTo('App\Distribucionmacu');

    }

    public function nivel(){
          
        return $this->belongsTo('App\Nivel');

    }
  
}
