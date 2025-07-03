<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Player extends Model

{

     public function matchround(): HasOne 
    {
        return $this->hasOne(Matchround::class);
    }

}
