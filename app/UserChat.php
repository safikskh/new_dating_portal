<?php

namespace App;

use App\Models\Portal;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserChat extends Model
{
    protected $fillable = [
        'sender_id', 'user_id', 'detail','portal_id',
    ];



    protected $appends = ['humanTime'];

    public function reciver() {
        return $this->belongsTo(\App\User::class);
    }

    public function sender() {
        return $this->belongsTo(\App\User::class, 'sender_id');
    }

    public function getHumanTimeAttribute() {
       return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'])->format('d-m-Y H:i:s');
        
    }

    public function portal(){
        return $this->belongsTo(Portal::class,'portal_id');
    }
}
