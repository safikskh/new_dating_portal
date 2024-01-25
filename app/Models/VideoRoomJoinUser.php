<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoRoomJoinUser extends Model
{

    protected $fillable = [];
    public $table = 'video_room_join_users';

    public static function joinParticipant($param){
        $user = self::where('room_id',$param['room_id'])->where('user_id',$param['user_id'])->first();
        if(!is_null($user)){
            return true;
        }
        $user = new self;
        $user->room_id = $param['room_id'];
        $user->user_id = $param['user_id'];
        $user->save();
        return true;
    }
}
