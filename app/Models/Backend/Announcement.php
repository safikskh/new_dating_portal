<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'detail','portal_id'];
}
