<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Matchround;

use Illuminate\Http\Request;

class MatchroundController extends Controller
{
      public function index()
        {


     $players = Player::all();

     $matchr_player = Matchround::all();
     
        return view('index', [
        'players' => $players,
        'matchround' => $matchr_player
               
        ]);
    }
}
