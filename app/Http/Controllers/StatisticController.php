<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Date;
use App\Models\Matchround;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
     public function index()
    {

        if (Auth::guest()) {
        return redirect('./login');
    }

    $current_season = Date::current_season();

    $all_seasons= Date::select('season')->distinct()->get();
    
    if (request()->input('selected_season') != '') {
            $selected_season = request()->input('selected_season');
        } else {
            $selected_season = $current_season;
        }

      
    $numgames = Date::where('season','=',$selected_season)->count(); 
    $dates = Date::where('season','=',$selected_season)->orderByDesc('date')->get();
    $users = User::all();
    $array_present = [];
    $array_player_won = [];
    $array_player_orange = [];
    $array_values_player =[];
    $array_most_valuable_player = [];

   $presence_on_date = [];

   foreach ($dates as $date) {

   $create_date = date_create($date->date);
   $formatted_date = date_format ($create_date, 'd-m-Y');
 
     $presence_on_date += 
    [$formatted_date => Matchround::where('date_id', '=', $date->id)->where('present', '=', '1')->count()]; 
      }

   
   $matches_with_min_10_players = Matchround::select(DB::raw('count(`present`) as Aanwezigen'))->
   where('present', '=', 1)->where('season', '=',$selected_season)->groupby('date_id')-> having('Aanwezigen', '>=', 10)->count(); 

    foreach ($users as $user) {

    $num_present = Matchround::select()->where('user_id','=',$user['id'])->where('season','=',$selected_season)->where('present','=',1)->count();

    $num_player_won = Matchround::select()->where('user_id','=',$user['id'])->where('season','=',$selected_season)->where('present','=',1)->where('result','=','W')->count();

    $num_player_orange = Matchround::select()->where('user_id','=',$user['id'])->where('season','=',$selected_season)->where('present','=',1)->where('team_id','=', 1)->count();


    //   Aanwezigheid spelers.. 
    
    if ($num_present > 0) {
    $array_present += 
    [$user['firstname'] => round(($num_present/$numgames) * 100, 0)];
    }
    
    // Winstpartijen per speler..

    if ( ($num_player_won != 0) || ($num_present !=0) ) {
    $array_player_won += 
    [$user['firstname'] => round(($num_player_won/$num_present) * 100, 0)];

    // Aantal keer dat speler in oranje speelde..
    $array_player_orange += 
     [$user['firstname'] => round(($num_player_orange/$num_present) * 100, 0)];

     // Meest waardevolle speler..
     $array_values_player = array_merge_recursive($array_present, $array_player_won);
    }
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
    arsort($array_present);
    arsort($array_player_won);
    ksort($array_player_orange);

    arsort($array_most_valuable_player);
    array_pop($array_most_valuable_player);
  
      return view('statistic.index', [
        'all_seasons' => $all_seasons,
        'dates' => $dates,
        'presence_on_date' => $presence_on_date,
        'numgames'=> $numgames, 
        'users'=> $users,
        'matches_with_min_10_players' => $matches_with_min_10_players,
       'array_present' => $array_present, 
       'array_player_won' => $array_player_won,
       'array_player_orange' => $array_player_orange,
       'num_team_orange_won'=> $num_team_orange_won,
       'num_team_yellow_won' => $num_team_yellow_won, 
       'num_draw' => $num_draw, 
       'array_most_valuable_player' => $array_most_valuable_player,
       'selected_season' => $selected_season
        ]);
    }
 

}