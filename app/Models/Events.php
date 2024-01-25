<?php

namespace App\Models;

use Auth;
use App\User;
use DateTime;
use App\Models\Block;
use App\Models\Groups;
use App\Models\EventPost;
use App\Models\Categories;
use App\Models\EventJoinUser;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title','details','image',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function click(){
      return $this->hasOne(EventClickCount::class,'event_id')->orderBy('count','DESC');
  }

    public function eventJoinUser(){
        return $this->hasMany(EventJoinUser::class,'event_id','id');
    }

    public function eventPosts(){
        return $this->hasMany(EventPost::class);
    }

    public static function getPromotedProfile(){

      $blockAl = Block::where('block_by', Auth::id())
                ->orWhere('block_to', Auth::id())
                ->get();
        $blockAll = $blockAl->where('block_status', 0);
        $blockBy = $blockAll->pluck('block_by');
        $blockTo = $blockAll->pluck('block_to');
        $blocked = array_unique(array_merge($blockBy->toArray(), $blockTo->toArray()));
        
        $userBlocked = User::where('id', '!=', Auth::id())
                    ->whereIn('id', $blocked)
                    ->get();
        $arr = array();            
        foreach ($userBlocked as $ke => $block) {
            $ro = $block->id;
            array_push($arr,$ro);
        }
        

      $model = UserPromotation::where('portal_type',Auth::user()->getportal(Auth::user()->portalJoinUser_id))
            ->whereNotIn('user_id', $arr)
            ->orderByRaw('RAND()')
            ->get();
      $array = array();
      if(sizeof($model)>0){
        foreach ($model as $key => $value) {
          if($value->image != '' && Self::checkValidaty(date('Y-m-d',strtotime($value->updated_at)))){
            $row['user_id'] = $value->user_id;
            $row['promotationImage'] = $value->image;
            $row['promotionTitle'] = $value->promotionTitle;
            $row['age'] = Self::getAge(User::find($value->user_id)->dob,date('Y-m-d'));
            $row['username'] = User::find($value->user_id)->username;
            $row['location'] = Self::getLocation(User::find($value->user_id)->region_id);
            array_push($array,$row);
            if(sizeof($array) == 4){
              return $array;
            }
          }

        }
      }
      return $array;
    }
    public static function getLocation($region_id){
      $model = Region::where('id',$region_id)->first();
      if($model){
        return $model->region_name;
      }else{
        return '';
      }
    }
    private static function checkValidaty($date){
      $datetime1 = new DateTime($date);
      $datetime2 = new DateTime(date('Y-m-d'));
      $interval = $datetime1->diff($datetime2);
      $days =  $interval->format('%a');
      if($days<8){
        return true;
      }
      return false;
    }
    public static function getAge($dob,$condate){
            $birthdate = new DateTime(date("Y-m-d",  strtotime(implode('-', array_reverse(explode('/', $dob))))));
            $today= new DateTime(date("Y-m-d",  strtotime(implode('-', array_reverse(explode('/', $condate))))));
            $age = $birthdate->diff($today)->y;
            return $age;

    }
     public static function findUserByEvent($id){
      return User::find(Events::find($id)->user_id);
    }
}
