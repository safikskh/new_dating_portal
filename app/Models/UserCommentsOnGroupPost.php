<?php

namespace App\Models;
use App\User;
use App\Models\Groups;
use App\Models\UserPostOnGroup;
use Illuminate\Database\Eloquent\Model;

class UserCommentsOnGroupPost extends Model
{
  protected $table = 'user_comments_on_group_posts';
  protected $primaryKey = 'id';
  protected $fillable = [
      'group_id','user_id','post_id','comment'
  ];

  public function post(){
      return $this->belongsTo(UserPostOnGroup::class,'post_id');
  }
  public function user(){
      return $this->belongsTo(User::class,'user_id');
  }
  public function group(){
      return $this->belongsTo(Groups::class,'group_id');
  }
  public static function getComments($group_id,$post_id){
    $model = Self::where('group_id',$group_id)->where('post_id',$post_id)->get();
    return $model;
  }
  public static function getTotalComments($group_id,$post_id){
    $model = Self::where('group_id',$group_id)->where('post_id',$post_id)->count();
    return $model;
  }
}
