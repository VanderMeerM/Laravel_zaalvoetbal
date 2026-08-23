<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
 protected $fillable = ['description','user_id', 'date_id', 'created_at', 'updated_at'];

public function date(): BelongsTo
    {
        return $this->belongsTo(Date::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

