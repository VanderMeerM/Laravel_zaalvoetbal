<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Date;
use App\Models\Matchround;

use Illuminate\Http\Request;


class StatisticController extends Controller
{
     public function index()
    {

    $numgames = DB::table('dates')->count(); 
    $dates = Date::all();
    $users = User::all();
    $array_present = [];
    $array_player_won = [];
    $array_player_orange = [];
    $array_values_player =[];
    $array_most_valuable_player = [];

    foreach ($users as $user) {

    $num_present = Matchround::select()->where('user_id','=',$user['id'])->where('present','=',1)->count();

    $num_player_won = Matchround::select()->where('user_id','=',$user['id'])->where('present','=',1)->where('result','=','W')->count();

    $num_player_orange = Matchround::select()->where('user_id','=',$user['id'])->where('present','=',1)->where('team_id','=', 1)->count();


    //   Aanwezigheid spelers.. 
    $array_present += 
    [$user['firstname'] => round(($num_present/$numgames) * 100, 0)];
    
    // Winstpartijen per speler..
    $array_player_won += 
    [$user['firstname'] => round(($num_player_won/$num_present) * 100, 0)];

    // Aantal keer dat speler in oranje speelde..
    $array_player_orange += 
     [$user['firstname'] => round(($num_player_orange/$num_present) * 100, 0)];

     // Meest waardevolle speler..
     $array_values_player = array_merge_recursive($array_present, $array_player_won);
     // [$user['firstname'] => 5];

    }

    foreach ($array_values_player as $name=> $values) {
    $array_most_valuable_player += 
    [$name => round($values[0] * $values[1]) / 100, 1];
    }

    $num_team_orange_won = 0;
    $num_team_yellow_won = 0;
    $num_draw = 0;

  foreach ($dates as $date)

    if ($date['result_orange'] > $date['result_yellow']) {
    $num_team_orange_won ++;
    }

    elseif ($date['result_yellow'] > $date['result_orange']) {
    $num_team_yellow_won ++;
    }

    elseif ( ($date['result_yellow'] == $date['result_orange']) && 
    ($date['result_orange'] !=null || $date['result_yellow'] !=null) )
    {
    $num_draw ++;
    }

    //$num_team_orange_won = Date::select()->where('result_orange', '>', 'result_yellow')->count();
    //$num_team_yellow_won = Date::select()->where('result_yellow', '>', 'result_orange')->count();
    
    arsort($array_present);
    arsort($array_player_won);
    ksort($array_player_orange);

    arsort($array_most_valuable_player);
    array_pop($array_most_valuable_player);
  
      return view('statistic.index', [
        'numgames'=> $numgames, 
        'users'=> $users,
       'array_present' => $array_present, 
       'array_player_won' => $array_player_won,
       'array_player_orange' => $array_player_orange,
       'num_team_orange_won'=> $num_team_orange_won,
       'num_team_yellow_won' => $num_team_yellow_won, 
       'num_draw' => $num_draw, 
       'array_most_valuable_player' => $array_most_valuable_player
        ]);
    }

}
