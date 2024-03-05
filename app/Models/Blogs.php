<?php

namespace App\Models;

use App\User;
use App\Models\BlogComments;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = 'blogs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title','sub_title','details','image'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function category(){
        return $this->belongsTo(Categories::class,'category_id');
    }

    public function comments(){
        return $this->hasMany(BlogComments::class);
    }
    
    public static function findUserByBlog($id){
      return User::find(Blogs::find($id)->user_id);
    }
}
