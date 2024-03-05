<?php

namespace App\Models;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'stripe_id',
        'stripe_plan',
        'quantity',
        'trial_ends_at',
        'ends_at'
    ];

    public function membership(){
        return $this->belongsTo(Membership::class,'stripe_plan');
    }
}
