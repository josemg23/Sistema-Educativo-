<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    protected $fillable = [
        'nombre','user_id','abstract','body', 'status'
        
    ];

    protected $hidden =['created_at','updated_at'];

    public function image(){

        return $this->morphOne('App\Image','imageable');
    }

    public function instituto(){
          
        return $this->belongsTo('App\Instituto');
    }

    public function user(){
          
        return $this->belongsTo('App\User');
    }

    public function distribucionmacu(){
          
        return $this->belongsTo('App\Distribucionmacu');
    }


    public function materia(){
          
        return $this->belongsTo('App\Materia');
    }
    public function nivel(){
          
        return $this->belongsTo('App\Nivel');
    }

    public function comments(){  //relacion polimorfica con comentario y post
          
        return $this->morphMany('App\Comment','commentable')->whereNull('parent_id');;
    }

}
