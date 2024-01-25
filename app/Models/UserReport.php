<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    protected $fillable = ['fron_user_id','to_user_id','title','details','files'];

    public function reportFromUser() {
        return $this->belongsTo(\App\User::class, 'fron_user_id');
    }
    public function reportToUser() {
        return $this->belongsTo(\App\User::class, 'to_user_id');
    }
}
