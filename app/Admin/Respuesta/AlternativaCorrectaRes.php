<?php

namespace App\Admin\Respuesta;

use Illuminate\Database\Eloquent\Model;

class AlternativaCorrectaRes extends Model
{
    public function alternativaCorrect(){

        return $this->belongsTo('App\Admin\Respuesta\AlternativaCorrecta');
    }
}
