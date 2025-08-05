<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Matchround;
use App\Models\Team;
use App\Models\Date;


use Illuminate\Http\Request;

class MatchroundController extends Controller
{
      public function index()
        {

     $dates = Date::all();

      return view('index', [
       'dates' => $dates
                       
        ]);
    }

    public function show($id) 
    {

      $matchround_dates = Matchround::select()->where('date_id', '=', $id)->get();
      $num_present = $matchround_dates->where('present', '=', '1')->count();
      $num_absent = $matchround_dates->where('present', '=', '0')->count();

      $teams = Team::all();

       return view('show',  [
        'matchround' => $matchround_dates,
        'num_present' => $num_present,
        'num_absent' => $num_absent,
        'teams' => $teams
       ]);
    }

    public function edit($id) 
    {

    $matchround = Matchround::find($id);

    $curr_presence = $matchround->present;
  
    $matchround->update([
      'present' => !$curr_presence
    ]);

    return to_route('voetballers.show', [
        'voetballer' => $matchround->date_id
    ]);
  }

      public function change_team($id) 
    {

    $matchround = Matchround::find($id);

    $current_team = $matchround->team_id;
  
     if ($current_team == 1) {

      $matchround->update([    
      'team_id' => 2
      ]);
    }
    else {
      $matchround->update([    
      'team_id' => 1
      ]);

    }

    return to_route('voetballers.show', [
        'voetballer' => $matchround->date_id
    ]);
   
    }
}
