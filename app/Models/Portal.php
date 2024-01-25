<?php

namespace App\Models;

use App\User;
use App\UserChat;
use App\Models\PortalJoinUser;
use Illuminate\Database\Eloquent\Model;

class Portal extends Model
{
    protected $fillable = [
        'portalType'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function portalJoinUser(){
        return $this->hasMany(PortalJoinUser::class,'portal_id','id');
    }
    public function chats(){
        return $this->hasMany(UserChat::class);
    }

    /**
     * Relationship with `advance_searches` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function advanceSearch()
    {
        return $this->hasOne(AdvanceSearch::class)->where('user_id', auth()->user()->id);
    }
}
