<?php

namespace App\Events;

use App\User;
use App\Models\ChatRoom;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatRoomEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;
    public $chr;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChatRoom $chat,$chr)
    {
        $this->chat = $chat;
        $this->chr = $chr;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('chatroom.'.$this->chat->chatRoomDetail_id);
    }

    public function broadcastWith()
    {
        return [
            'chat' => [
                'id' => $this->chat->id,
                'message' => $this->chat->message,
                'user_id' => $this->chat->user_id,
                'room_id' => $this->chat->chatRoomDetail_id,
                'created_at' => date('Y-m-d h:m:s', strtotime($this->chat->created_at)),
                'updated_at' => $this->chat->updated_at,
                'room' => $this->chr,
                'user' => [
                    'id' => $this->chat->user->id,
                    'portalInfo' => [
                        'username' => $this->chat->user->portalInfo->username,
                        'profilePicture' => $this->chat->user->portalInfo->profilePicture,
                    ]
                ]
            ]
        ];
    }
}
