<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
     protected $fillable = ['block_by', 'block_to', 'block_status'];

    public function userblockto(){
        return $this->belongsTo('App\User', 'block_to', 'id');
    }
}
