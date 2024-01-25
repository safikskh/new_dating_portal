<?php

namespace App\Listeners;

use App\Events\ChatRoomEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChatRoomListener
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
     * @param  ChatRoomEvent  $event
     * @return void
     */
    public function handle(ChatRoomEvent $event)
    {
        //
    }
}
