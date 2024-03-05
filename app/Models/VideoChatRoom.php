<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\VideoRoomJoinUser;
use App\User;

class VideoChatRoom extends Model
{
    protected $fillable = [];
    public $table = 'video_rooms';

    public function creator()
    {
        return $this->hasOne(User::class, "id", "creator_id");
    }
}
