<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Matchround extends Model
{

protected $fillable = [ 'present'];
    

public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }


public function date(): BelongsTo
    {
        return $this->belongsTo(Dates::class);
    }

}