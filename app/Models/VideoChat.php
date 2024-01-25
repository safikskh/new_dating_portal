<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoChat extends Model
{
    protected $fillable = [];

    function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
