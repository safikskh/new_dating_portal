<?php

namespace App\Models;

use App\User;
use App\Models\Events;
use Illuminate\Database\Eloquent\Model;

class EventJoinUser extends Model
{
    protected $table = 'event_join_users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'event_id','user_id',
    ];
     public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
     public function events(){
        return $this->belongsTo(Events::class,'event_id');
    }
}
