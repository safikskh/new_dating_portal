<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['region_name'];


   public function user(){
        return $this->hasMany(User::class);
    }
}
