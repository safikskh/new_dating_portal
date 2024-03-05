<?php

namespace App\Models;

use App\Models\PortalJoinUser;
use Illuminate\Database\Eloquent\Model;

class CoupleInfo extends Model
{
    protected $fillable = [
        'firstName','lastName','sex','dob','sexualOrientation','civilStatus','height','weight',
        'hairColor','eyeColor','searching','bodyType','tattoos','piercing','children','smoking',
        'profilePicture','portalJoinUser_id'
    ];
    // protected $primaryKey = 'portalJoinUser_id';
    
    public function portalJoinUser(){
        return $this->belongsTo(PortalJoinUser::class,'portalJoinUser_id');
    }
}
