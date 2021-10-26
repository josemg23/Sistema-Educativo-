<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinstituto extends Model
{
    protected $fillable = [
          'institutoclon',
    ];

    public function instituto(){
          
        return $this->belongsTo('App\Instituto');
    }

}

