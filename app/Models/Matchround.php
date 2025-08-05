<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Matchround extends Model
{

protected $fillable = ['date_id','user_id', 'team_id', 'present'];
    

public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


public function date(): BelongsTo
    {
        return $this->belongsTo(Date::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

}