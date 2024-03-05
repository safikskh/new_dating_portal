<?php

namespace App\Models;

use App\Enums\Sex;
use Carbon\Carbon;
use App\Models\Portal;
use App\Models\Region;
use App\Models\Status;
use App\Models\CoupleInfo;
use App\Models\Membership;
use App\Models\PortalJoinUser;
use Illuminate\Database\Eloquent\Model;

class PortalJoinUser extends Model
{
    protected $fillable = [
        'user_id','portal_id','username','firstName','lastName','sex','dob','profile_detail',
        'sexualOrientation','zipCode','civilStatus','height','weight','hairColor','eyeColor',
        'searching','bodyType','tattoos','piercing','children','smoking','matchWords',
        'nMatchWords','membership_id','region_id','profilePicture','membership_id','membership_ends_at',
        'profile_disable','isProfileComplete',
    ];

    protected $appends = ['userName','regionName','userNameColor','humanTime','commonMatchwords'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function portals(){
        return $this->belongsTo(Portal::class,'portal_id');
    }
    public function memberships(){
        return $this->belongsTo(Membership::class,'membership_id');
    }

    public function statuses(){
        return $this->hasMany(Status::class);
    }
    public function coupleInfos(){
        return $this->hasMany(CoupleInfo::class,'portalJoinUser_id');
    }

    public function coupleMale(){

        return CoupleInfo::where([['portalJoinUser_id',$this->attributes['id']]])->first();
    }

    public function coupleFemale(){
        return CoupleInfo::where([['portalJoinUser_id',$this->attributes['id']]])->orderBy('id', 'DESC')->first();
    }

    public function regions(){
        return $this->belongsTo(Region::class,'region_id');
    }

    public function getUserNameAttribute(){
        if(PortalJoinUser::where('user_id', $this->attributes['user_id'])->count() > 1){
            if($this->attributes['username'] == null){
                return PortalJoinUser::where([['user_id', $this->attributes['user_id']]])->first()->username;
            }
        }
        return $this->attributes['username'];
    }

    public function getHumanTimeAttribute()
    {
       if($this->attributes['dob'] != null){
            if($this->attributes['sex'] == Sex::getValue('Par')){
            return \Carbon\Carbon::now()
                ->diffInYears(
                    \Carbon\Carbon::parse(CoupleInfo::where('portalJoinUser_id',$this->attributes['id'])->first()->dob))
                . " og " . \Carbon\Carbon::now()
                ->diffInYears(\Carbon\Carbon::parse(CoupleInfo::where('portalJoinUser_id',$this->attributes['id'])->orderBy('id', 'DESC')->first()->dob));
            }else {
                return \Carbon\Carbon::now()
                ->diffInYears(\Carbon\Carbon::parse($this->attributes['dob']));
            }
        }
    }

    public function getRegionNameAttribute(){
        if($this->attributes['region_id'] != null){
            if(Region::where('id', $this->attributes['region_id'])->count() > 0){
                return Region::find($this->attributes['region_id'])->region_name;
            }
        }

    }

    public function getCommonMatchwordsAttribute(){
        // return $this->attributes['id'];
        if(auth()->check()){
            if(auth()->user()->portalInfo->matchWords == null || $this->attributes['matchWords'] == null){
                return '';
            }
            return array_intersect(json_decode(auth()->user()->portalInfo->matchWords),json_decode($this->attributes['matchWords']));
        }
    }

    public function getUserNameColorAttribute(){
        if ($this->attributes['sex'] ==  Sex::getValue('Mand')) {
           return "user-male";
        } elseif($this->attributes['sex'] == Sex::getValue('Kvinde')) {
            return "user-female";
        }elseif($this->attributes['sex'] == Sex::getValue('Par')) {
            return "user-par";
        }

    }


}
