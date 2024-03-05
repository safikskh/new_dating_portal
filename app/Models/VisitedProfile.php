<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;

class VisitedProfile extends Model
{
  public function user(){
      return $this->belongsTo(User::class,'user_id');
  }
  public function visitor(){
      return $this->belongsTo(User::class,'visited_id');
  }
}
