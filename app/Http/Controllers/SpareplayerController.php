<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Spareplayer;
use App\Models\Date;

class SpareplayerController extends Controller
{
    public function store($id) {

    $id = Date::find($id);
    $season = request('season');
    $player = request('spare_player');

    Spareplayer::create([
      'date' => now(), 
      'name' => $player,
      'user_id' => 0,
      'team_id' => 1,
      'date_id' => $id->id, 
      'present' => 1,
      'season' => $season,     
      'created_at' => now()
    ]);

      return to_route('dates.show', [
      'date' => $id->id
      ]); 

    }

    public function change_team($id) 
    {

    $spareplayer = Spareplayer::find($id);

    $current_team = $spareplayer->team_id;

           
     if ($current_team == 1) {

      $spareplayer->update([    
      'team_id' => 0
      ]);
    }
    else {
      $spareplayer->update([    
      'team_id' => 1
      ]);

    }

     return to_route('dates.show', [
      'date' => $spareplayer->date_id
      ]); 
   
    }

}
