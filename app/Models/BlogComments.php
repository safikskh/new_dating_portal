<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BlogComments extends Model
{
    protected $fillable = ['user_id', 'blog_id', 'comment'];

    public function blog(){
        return $this->belongsTo(Blogs::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
