<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $table = 'file_uploads';
    protected $primaryKey = 'id';
    protected $fillable = ['file'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
