<?php

namespace App\Models;

use App\User;
use App\Models\Subscription;
use App\Http\Resources\Users;
use App\Models\PortalJoinUser;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'stripe_plan',
        'cost',
        'description'
    ];

    public function memberships(){
        return $this->hasMany(User::class,'membership_id','id');
    }
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
    public function portalJoinUsers(){
        return $this->hasMany(PortalJoinUser::class,'portalJoinUser_id','id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
