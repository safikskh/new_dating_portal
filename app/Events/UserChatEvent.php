<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $receiver; // integer
    public $info; // Object

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($receiver, $info)
    {
        $this->receiver = $receiver;
        $this->info     = $info;
    }

    public function broadcastAs()
    {
        return 'user.chat';
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->receiver);
    }

    public function broadcastWith()
    {
        return $this->info;
    }
}
