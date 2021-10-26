<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    
    protected $fillable = [
        'url'
        
    ];

    protected $hidden =['created_at','updated_at'];



    public function archivoable(){

        return $this->morphTo();
    
    }


}
