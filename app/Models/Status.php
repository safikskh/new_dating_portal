<?php

namespace App\Models;

use App\User;
use App\Models\PortalJoinUser;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'user_id','portal_id','title','details','status_ends_at'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function portal(){
        return $this->belongsTo(PortalJoinUser::class,'portal_id');
    }
}
