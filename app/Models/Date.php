<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $fillable = ['date', 'season', 'match_nr'];

    public function scopeCurrent_season() {
    
    if (date('m') >= 8) {
    $current_season = date('Y'); 
    } else {
$current_season = (date('Y') - 1);
}
return $current_season;
    }
}
