<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Matchround;
use App\Models\Team;
use App\Models\Dates;


use Illuminate\Http\Request;

class MatchroundController extends Controller
{
      public function index()
        {


     //$players = Player::all();

     $dates = Dates::all();

      return view('index', [
       'dates' => $dates
                       
        ]);
    }

    public function show($id) 
    {

      $matchround_dates = Matchround::select()->where('date_id', '=', $id)->get();
      $teams = Team::all();

       return view('show',  [
        'matchround' => $matchround_dates,
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
}
