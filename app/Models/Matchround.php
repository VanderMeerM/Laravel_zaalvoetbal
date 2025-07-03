<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Player;


class Matchround extends Model
{
    

public function player() 
    {
        return $this->belongsTo(Player::class);
    }
}