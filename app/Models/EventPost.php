<?php

namespace App\Models;

use App\User;
use App\Models\Events;
use App\Models\EventPostComment;
use Illuminate\Database\Eloquent\Model;

class EventPost extends Model
{
   protected $fillable = ['user_id', 'event_id', 'detail'];

    public function event(){
        return $this->belongsTo(Events::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function eventPostComments(){
        return $this->hasMany(EventPostComment::class);
    }
}
