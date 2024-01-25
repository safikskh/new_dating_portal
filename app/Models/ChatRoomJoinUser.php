<?php

namespace App\Models;

use App\Models\ChatRoomJoinUser;
use Illuminate\Database\Eloquent\Model;

class ChatRoomJoinUser extends Model
{
    protected $fillable = [
        'user_id','chatRoomDetail_id'
    ];

     public function user(){
        return $this->belongsTo(User::class);
    }

    public function chatRoomDetails(){
        return $this->belongsTo(ChatRoomDetails::class);
    }

}
