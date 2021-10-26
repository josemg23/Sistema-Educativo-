<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentodoc extends Model
{
   
    protected $fillable = [
        'url'
        
    ];

    protected $hidden =['created_at','updated_at'];
    
   
    public function documentable(){

        return $this->morphTo();
    
    }
}
