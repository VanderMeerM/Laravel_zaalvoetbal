<?php

namespace App\Models;

use App\Http\Controllers\MatchroundController;
use App\Http\Controllers\PlayerController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
     public function matchround(): HasOne 
    {
        return $this->hasOne(MatchroundController::class);
    }

}
