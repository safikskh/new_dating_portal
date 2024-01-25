<?php

namespace App\Models;
use App\User;
use App\Models\Groups;
use Illuminate\Database\Eloquent\Model;

class UserPostOnGroup extends Model
{
  protected $table = 'user_post_on_groups';
  protected $primaryKey = 'id';
  protected $fillable = [
      'group_id','user_id','type','data'
  ];

  public function user(){
      return $this->belongsTo(User::class,'user_id');
  }
  public function group(){
      return $this->belongsTo(Groups::class,'group_id');
  }
}
