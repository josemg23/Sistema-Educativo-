<?php

namespace App\Http\Middleware;

use Closure;

class UserActiveMiddleware
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
        if (Auth::guard($guard)->check() && auth()->user()->active == 0) {

    // usuario con sesión iniciada pero inactivo

    // cerramos su sesión
    Auth::guard()->logout();

    // invalidamos su sesión
    $request->session()->invalidate();

    // redireccionamos a donde queremos
    return redirect('/login')->withInput()->with('message', 'Login Failed o cuenta desactivada');
}
        return $next($request);
    }
}
