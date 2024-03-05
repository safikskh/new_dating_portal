<?php

namespace App\Models;

use App\Models\Events;
use App\Models\Groups;
use App\Models\Blogs;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'name'
    ];

    public function groups(){
        return $this->hasMany(Groups::class,'category_id','id');
    }
    public function events(){
        return $this->hasMany(Events::class,'category_id','id');
    }

    public function blogs(){
        return $this->hasMany(Blogs::class);
    }
}
