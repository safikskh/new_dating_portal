<?php

namespace App\Models;
use App\User;
use App\Models\Groups;
use Illuminate\Database\Eloquent\Model;

class GroupJoinUser extends Model
{
  protected $table = 'group_join_users';
  protected $primaryKey = 'id';
  protected $fillable = [
      'group_id','user_id',
  ];

  public function user(){
      return $this->belongsTo(User::class,'user_id');
  }
  public function group(){
      return $this->belongsTo(Groups::class,'group_id');
  }
  public function groupType(){
      return Group::find($this->attributes['group_id'])->group_type;
  }
}
