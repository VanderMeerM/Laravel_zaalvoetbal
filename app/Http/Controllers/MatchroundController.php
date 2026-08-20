<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Matchround;
use App\Models\Date;


class MatchroundController extends Controller
{
      public function index()
        {

     $dates = Date::orderByDesc('id')->get();

      return view('index', [
       'dates' => $dates
                       
        ]);
    }

    public function show($id) 
    {

    $matchround = Matchround::find($id);
     
       return view('dates.show',  [
              'date' => $matchround->date_id

       ]);
    }

    public function change_presence($id) 
    {

    $matchround = Matchround::find($id);

    $curr_presence = $matchround->present;

     $matchround->update([
      'present' => !$curr_presence
    ]);

    return to_route('dates.show', [
      'date' => $matchround->date_id
      ]); 
    } 

    public function change_team($id) 
    {

    $matchround = Matchround::find($id);

    $current_team = $matchround->team_id;

           
     if ($current_team == 1) {

      $matchround->update([    
      'team_id' => 0
      ]);
    }
    else {
      $matchround->update([    
      'team_id' => 1
      ]);

    }

     return to_route('dates.show', [
      'date' => $matchround->date_id
      ]); 
   
    }

    public function store($id) {

    $id = Date::find($id);
    $season = request('season');
    $player = request('spare_player');

    Matchround::create([
      'date' => now(),
      'user_id' => 0,
      'team_id' => 1,
      'date_id' => $id->id, 
      'season' => $season,
      'present' => 1,
      'spare_name' => $player,
      'created_at' => now()
    ]);

      return to_route('dates.show', [
      'date' => $id
      ]); 

    }
}
