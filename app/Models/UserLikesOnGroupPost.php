<?php

namespace App\Models;

use Auth;
use App\User;
use App\Models\Groups;
use App\Models\UserPostOnGroup;
use Illuminate\Database\Eloquent\Model;

class UserLikesOnGroupPost extends Model
{
  protected $table = 'user_likes_on_group_posts';
  protected $primaryKey = 'id';
  protected $fillable = [
      'group_id','user_id','post_id'
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
  public static function check($group_id,$post_id){
    if(Auth::check()){
      $model = Self::where('user_id',Auth::user()->id)->where('group_id',$group_id)->where('post_id',$post_id)->first();
      if($model){
        if($model->is_like == 0){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

  public static function getTotalLikes($group_id,$post_id){
    $model = Self::where('group_id',$group_id)->where('post_id',$post_id)->where('is_like',0)->count();
    return $model;
  }
}
