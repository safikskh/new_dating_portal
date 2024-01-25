<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvanceSearch extends Model
{
    protected $fillable = ['user_id', 'portal_id', 'criteria'];

    /**
     * Relationship with `users` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Relationship with `portals` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function portal()
    {
        return $this->belongsTo(Portal::class);
    }
}
