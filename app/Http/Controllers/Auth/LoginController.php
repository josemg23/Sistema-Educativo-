<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


   //protected $redirectTo = RouteServiceProvider::HOME;

   ////////////////  

//////////////////
   
   
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function authenticated($request , $user){

  if ($user->estado == 'off') {

    Auth::guard()->logout();

    $request->session()->invalidate();

    return redirect('/login')->withInput()->with('message', 'Tu cuenta esta desactivada por favor comunicate con el administrador');
}

        if($user->roles[0]->descripcion=='administrador'){
           return redirect()->route('administrador') ;
       }
       elseif($user->roles[0]->descripcion=='docente'){
           return redirect()->route('docente') ;
       }

       elseif($user->roles[0]->descripcion=='estudiante'){
           return redirect()->route('estudiante') ;
       }

       return redirect()->route('administrador');
   }
   
   // protected function credentials(Request $request)
   //  {
   //   $credentials = $request->only($this->username(), 'password');
   //   return array_merge($credentials, ['estado' => 'on']); 
   //  }

}