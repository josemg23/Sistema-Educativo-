<?php

namespace App\Http\Middleware;

use Closure;

class EstudianteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach(auth()->user()->roles as $role){
        $rol =$role->descripcion;
        }
        if($rol == 'docente'){
            return redirect('/sistema/homedoc');
        }
           return $next($request);
          
    }
}
