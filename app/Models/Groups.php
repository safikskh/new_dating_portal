<?php

namespace App\Models;

use App\User;
use App\Models\UserPostOnGroup;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title','details','image',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public static function getTotalRequest($user_id){
      $array = array();
      $group = Self::where('user_id',$user_id)->where('group_type',1)->get();
      if(sizeof($group)>0){
        foreach($group as $g){
          $totalJoin = GroupJoinUser::where('group_id',$g->id)->where('status',1)->get();
          if(sizeof($totalJoin)>0){
            foreach ($totalJoin as $key => $value) {
              $row['group_name'] = $g->title;
              $row['group_id'] = $g->id;
              $row['user_id'] = $value->user_id;
              $row['user_name'] = User::find($value->user_id)->firstName.' '.User::find($value->user_id)->lastName;
              array_push($array,$row);
            }
          }
        }
      }
      return $array;
    }
    public static function getTotalResponse($user_id){
      $array = array();
      $totalJoin = GroupJoinUser::where('user_id',$user_id)->where('status',0)->orderBy('id','DESC')->get();
      if(sizeof($totalJoin)>0){
        foreach ($totalJoin as $key => $value) {
          $row['group_name'] = Self::find($value->group_id)->title;
          $row['group_id'] = $g->id;
          $row['user_id'] = $value->user_id;
          $row['user_name'] = User::find($value->user_id)->firstName.' '.User::find($value->user_id)->lastName;
          array_push($array,$row);
        }
      }
      return $array;
    }
    public static function checkThisMemberAreInThisGroup($user_id,$group_id){
      $model = GroupJoinUser::where('user_id',$user_id)->where('group_id',$group_id)->where('status',0)->first();
      if($model){
        return true;
      }else{
        return false;
      }
    }
    public static function checkThisMemberAreInThisGroupPending($user_id,$group_id){
      $model = GroupJoinUser::where('user_id',$user_id)->where('group_id',$group_id)->where('status',1)->first();
      if($model){
        return true;
      }else{
        return false;
      }
    }
    public static function findUserByGroup($id){
      return User::find(Groups::find($id)->user_id);
    }
    public static function findUserByPost($id){
      return User::find(UserPostOnGroup::find($id)->user_id);
    }
}
