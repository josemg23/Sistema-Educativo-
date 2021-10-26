<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewUserRegistered
{
       use Dispatchable, InteractsWithSockets, SerializesModels;
 
    public $users;
 
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($users)
    {
        $this->users = $users;   
    }
}
