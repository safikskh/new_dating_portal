<?php

namespace App\Models\Backend;

use App\Models\ChatRoom;
use App\Models\ChatRoomJoinUser;
use Illuminate\Database\Eloquent\Model;

class ChatRoomDetails extends Model
{
    protected $fillable = ['chatroom_name','portal_id','membership_id', 'chatroom_image'];

    public function chatRoomJoinUsers(){
        return $this->hasMany(ChatRoomJoinUser::class);
    }
    public function chatRooms(){
        return $this->hasMany(ChatRoom::class);
    }

    public function portal(){
        return $this->belongsTo(Portal::class);
    }
}
