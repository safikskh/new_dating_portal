<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusReport extends Model
{
    protected $fillable = ['user_id', 'status_id', 'description', 'notify'];

    /**
     * Relationship with `users` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }

    /**
     * Relationship with `statuses` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
