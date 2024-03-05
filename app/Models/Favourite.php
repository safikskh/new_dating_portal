<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = ['favourite_by', 'favourite_to','portal_id','favourite_status'];

    public function userFavourite(){
        return $this->belongsTo(User::class, 'favourite_to');
    }
}
