<?php

namespace App\Models;

use App\User;
use App\Models\EventPost;
use Illuminate\Database\Eloquent\Model;

class EventPostComment extends Model
{
    protected $fillable = ['user_id', 'event_post_id', 'detail'];

    public function eventPost(){
        return $this->belongsTo(EventPost::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
