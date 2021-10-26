<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewUserRegistered;
use App\Http\Controllers\Controller;
use App\Mail\UserRegister;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME; //para redireccionar a la pagina de inicio del dasboard en este caso welcome

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'cedula' => ['required', 'string', 'max:10', ],
            'fechanacimiento' => ['required', 'string', 'max:10'],
            'sname' => ['required', 'string', 'max:20'],
            'apellido' => ['required', 'string', 'max:20'],
            'sapellido' => ['required', 'string', 'max:20'],
            'domicilio' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:13'],
            'celular' => ['required', 'string', 'max:13'],
            'titulo' => ['required', 'string', 'max:255'],
            
            'fcontrato' => ['required', 'string', 'max:255'],
            'cirepre' => ['required', 'string', 'max:255'],
            'namerepre' => ['required', 'string', 'max:255'],
            'namema' => ['required', 'string', 'max:255'],
            'namepa' => ['required', 'string', 'max:255'],
            'telefonorep' => ['required', 'string', 'max:255'],
            'fregistro' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'in:on,off'],
            
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $clave = $data['password'];
        $user = User::create([
           
            'cedula' => $data['cedula'],
            'fechanacimiento' => $data['fechanacimiento'],
            'name' => $data['name'],
            'sname' => $data['sname'],
            'apellido' => $data['apellido'],
            'sapellido' => $data['sapellido'],
            'domicilio' => $data['domicilio'],
            'telefono' => $data['telefono'],
            'celular' => $data['celular'],
            'titulo' => $data['titulo'],
            'email' => $data['email'],
            'email' => $data['email'],
            'clave' => $data['password'],
            'password' => Hash::make($data['password']),

            'estado' => $data['estado'],
            'fcontrato' => $data['fcontrato'],
            'cirepre' => $data['cirepre'],
            'namema' => $data['namema'],
            'telefonorep' => $data['telefonorep'],
            'namepa' => $data['namepa'],
            'namerepre' => $data['namerepre'],
            'fregistro' => $data['fregistro'],

            
        ]);
        

        return $user;
    }
}
