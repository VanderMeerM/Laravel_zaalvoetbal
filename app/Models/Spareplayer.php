<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Spareplayer extends Model
{
 
protected $fillable = ['date','name', 'season', 'team_id', 'date_id', 'present'];

public function date(): BelongsTo
    {
        return $this->belongsTo(Date::class);
    }
}
