<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            foreach(auth()->user()->roles as $role){
                $rol =$role->descripcion;
            }
            if($rol == 'estudiante'){
                return redirect('/sistema/homees');
            }elseif ($rol == 'docente') {
                return redirect('/sistema/homedoc');
            }
            // return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
