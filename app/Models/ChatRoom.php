<?php

namespace App\Models;

use App\User;
use App\Models\Backend\ChatRoomDetails;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $fillable = [
        'message', 'user_id','chatRoomDetail_id'
    ];

     public function reciver() {
        return $this->belongsTo(\App\User::class)
            ->select('id', 'firstName', 'lastName', 'profilePicture', 'dob');
    }

    public function chatRoomDetails(){
        return $this->belongsTo(ChatRoomDetails::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
        
    }
   
}
