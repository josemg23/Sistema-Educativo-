<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $guarder = [];

    protected $fillable = [
        'user_id','parent_id','status','body','commentable_id','commentable_type'

    ];


   


    public function user(){
          
        return $this->belongsTo('App\User');
    }


    public function replies(){
          
        return $this->hasMany('App\Comment', 'parent_id');
    }
}
