<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
}
