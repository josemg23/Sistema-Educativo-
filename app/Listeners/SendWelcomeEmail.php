<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewUserRegistered  $event
     * @return void
     */
    public function handle(NewUserRegistered $event)
    {
          $data = array('name' => $event->users['name'], 'apellido' => $event->users['apellido'], 'email' => $event->users['email'], 'clave'=> $event->users['password'], 'body' => 'Bienvenido a SmartMoodle');
 
        Mail::send('mails.userregister', $data, function($msj) use ($data) {
            $msj->from("soporte@smartmoodle.com","SmartMoodle");
            $msj->subject($data['body']);
            $msj->to($data['email']);
        });
    }
}
