<?php

namespace App;

use App\Instituto;
use App\Modelos\Role;
use App\Notifications\ResetPassword;
use App\Traits\UserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, UserTrait;

     public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'nombre', 'apellido','domicilio','telefono',
        'celular', 'email', 'password','estado',
        

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     public function tallersCompletar(){

        return $this->belongsToMany('App\Taller');
    } 
     public function tallerDiferenciaRes(){

        return $this->belongsToMany('App\TallerDiferenciaRes');
    }
     public function tallerCirculoRe(){

        return $this->belongsToMany('App\TallerCirculoRe');
    }


    


    //relacion de muchos a 1 es decir muchos usuarios 
    //tomaran 1 dato de instituto
    public function instituto(){
          
        return $this->belongsTo('App\Instituto');
    }

    public function distrima(){
          
        return $this->hasOne('App\Distrima');
    }


    public function distribuciondos(){
          
        return $this->hasMany('App\Distribuciondo');
    }
    public function tallers(){
        
        return $this->belongsToMany('App\Taller','taller_user')
            ->withPivot('status','calificacion', 'retroalimentacion', 'fecha_entregado');
    }

    public function posts(){
          
        return $this->hasMany('App\Post');
    }
    public function archivodocentes(){
          
        return $this->hasMany('App\Archivodocente');
    }


    public function comments(){
          
        return $this->hasMany('App\Comment');
    }

    public function curso(){
          
        return $this->belongsTo('App\Curso');
    }

    public function nivel(){
        return $this->belongsTo('App\Nivel');
    }
    public function assignmets(){
        return $this->hasMany('App\Assignment');
    }
     public function cheques(){
        return $this->hasMany('App\Modulo\ModuloCheque');
    }
      public function creditos(){
        return $this->hasMany('App\Modulo\ModuloNotaCredito');
    }
    public function facturas(){
        return $this->hasMany('App\Modulo\ModuloFactura');
    }
     public function letras(){
        return $this->hasMany('App\ModuloLetraCambio');
    }
    public function pagares(){
        return $this->hasMany('App\Modulo\ModuloPagare');
    }
        public function papeletas(){
        return $this->hasMany('App\Modulo\ModuloPapeleta');
    }
    public function historials(){     
        return $this->hasMany('App\Historial');
    }
    
    public function distribucionmacu(){
        
        return $this->belongsTo('App\Distribucionmacu');

    }

}