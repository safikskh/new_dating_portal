<?php

namespace App\Models;
use App\User;
use App\Models\Groups;
use Illuminate\Database\Eloquent\Model;

class UserPromotation extends Model
{
  protected $primaryKey = 'id';
  public function user(){
      return $this->belongsTo(User::class,'user_id');
  }
}
