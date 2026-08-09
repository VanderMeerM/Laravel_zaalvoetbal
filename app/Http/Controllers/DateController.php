<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Date;
use App\Models\Matchround;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DateController extends Controller

{
        public function index()
    {
         if (Auth::guest()) {
        return redirect('./login');
    }
         $current_season = Date::current_season();

        if (request()->input('selected_season') != '') {
            $selected_season = request()->input('selected_season');
        } else {
            $selected_season = $current_season;
        }

        $dates= Date::select()->where('season', '=', $selected_season)->orderByDesc('date')->get();

        $all_seasons= Date::select('season')->distinct()->get();

        return view('dates.index', 
        ['dates' => $dates, 
        'current_season' => $current_season,
        'all_seasons' => $all_seasons,
        'selected_season' => $current_season
       
        ]);
    }

 public function create()
    {     
         if (Auth::guest()) {
        return redirect('./login');
    }
    return to_route('create_date');
    }


  public function show($id)
    {
         if (Auth::guest()) {
        return redirect('./login');
    }

      $current_season = Date::current_season();

      $matchround_dates =

      Matchround::join('users', 'users.id', '=','matchrounds.user_id')->
      select('matchrounds.*', 'users.firstname')->where('matchrounds.date_id', '=', $id)->orderBy('users.firstname')->get();

      $num_present = $matchround_dates->where('present', '=', '1')->count();
      $num_absent = $matchround_dates->where('present', '=', '0')->count();
      $current_date_id = Date::findOrFail($id);
      $current_date = $current_date_id->date;
      $match_nr = $current_date_id->match_nr;
      $logged_in_user = Auth::user()->id;
      $date_create = date_create($current_date_id->date);
      $teams = Team::all();
      $users_with_ball = User::select('id')->where('hasBall', '=', 'on')->get();

       return view('show',  [
        'matchround' => $matchround_dates,
        'num_present' => $num_present,
        'num_absent' => $num_absent,
        'current_date_id' => $current_date_id,
        'current_date'=> $current_date,
        'current_season' => $current_season,
        'match_nr' => $match_nr,
        'date_create' => $date_create,
        'teams' => $teams,
        'users_with_ball' => $users_with_ball,
        'logged_in_user' => $logged_in_user

       ]);
      
    }

 public function copy($id)
    {
         if (Auth::guest()) {
        return redirect('./login');
    }

    $old_date = Date::find($id);

    //dd($old_date);

    
     $new_date = Date::create(   
     [
        'date' => request('current_date'),
        'season' => request('current_season'),
        'match_nr' => $old_date->match_nr + 1,
        'created_at' => now()
                      
    ]);

 $users = User::where('isactive','=','Y')->get(); 

 foreach ($users as $user) {

 $old_mr_values = Matchround::where('date_id', '=', $old_date->id)->where('user_id', '=', $user->id) ->first();

 //dd($old_mr_values);
  
 Matchround::create(
        [
            'date' => now(),
            'user_id' => $user->id,
            'date_id' => $new_date->id, 
            'season' => $new_date->season,
            'team_id' => $old_mr_values->team_id,
            'present' => $old_mr_values->present,
            'created_at' => now()
        ]
        );
     
    }
    return to_route('dates.show', ['date' => $new_date->id]);
          
    }



    public function change_season() {

         if (Auth::guest()) {
        return redirect('./login');
    }
        $selected_season = request()->input('selected_season');
        $dates= Date::select()->where('season', '=', $selected_season)->orderByDesc('date')->get();
        $current_season = Date::current_season();
        $all_seasons= Date::select('season')->distinct()->get();

        return view('dates.index', 
        ['dates' => $dates, 
        'current_season' => $current_season,
        'all_seasons' => $all_seasons,
        'selected_season' => $selected_season
       
        ]);
    
    }

    public function update($id) 
    {
         if (Auth::guest()) {
        return redirect('./login');
    }

        request()->validate([
        'goals_orange' => ['required'],
        'goals_yellow' => ['required'],

        ]);
        
        $date = Date::findOrFail($id);

        $date->result_orange = request('goals_orange');
        $date->result_yellow = request('goals_yellow');
        $date->save();
     
        $matchround_yellow = Matchround::where(
            'date_id','=', $date->id)->where(
            'present', '=', 1)->where(
            'team_id','=', 0)->get();

            
        $matchround_orange = Matchround::where(
            'date_id','=', $date->id)->where(
            'present', '=', 1)->where(
            'team_id','=', 1)->get();


        if ($date->result_yellow < $date->result_orange) {
           foreach ($matchround_orange as $mo)  
            { $mo->update([
                'result' => 'W']); } 
               

             foreach ($matchround_yellow as $my)  
             { $my->update([
                'result' => 'L']); } 

        }
          
        else if ($date->result_yellow > $date->result_orange) {
          
            foreach ($matchround_orange as $mo)  
            { $mo->update([
                'result' => 'L']); } 

             foreach ($matchround_yellow as $my)  
           { $my->update([
                'result' => 'W']); } 
        
        }

        else if ($date->result_yellow == $date->result_orange) {
             foreach ($matchround_orange as $mo)  
            { $mo->update([
                'result' => 'D']); } 

             foreach ($matchround_yellow as $my)  
           { $my->update([
                'result' => 'D']); } 
        
        }

     return to_route('dates.show', ['date' => $date->id]);
    }

 public function store()
    {
      if (Auth::guest()) {
      return redirect('./login');
    }
      request()->validate([
      'date' => ['required']          
    ]);

$new_date = Date::create(   
     [
        'date' => request('date'),
        'season' => request('current_season'),
        'match_nr' => 1,
        'created_at' => now()
                      
    ]);

 $users = User::where('isactive','=','Y')->get(); 

 foreach ($users as $user) {

    Matchround::create(
        [
            'date' => now(),
            'user_id' => $user->id,
            'team_id' => 1,
            'date_id' => $new_date->id, 
            'season' => $new_date->season,
            'present' => 1,
            'created_at' => now()
        ]
        );
    }
    
     return to_route('dates.index');
    }

     public function destroy($id)
    {
         if (Auth::guest()) {
        return redirect('./login');
    }

        $date = Date::findOrFail($id);
        
        $matchesdate = Matchround::select()->where('date_id', '=', $date->id)->get();
        
       foreach ($matchesdate as $md) {
       $md->delete();    
        }
        
        $date->delete();
        
          return redirect('/dates'); 
    }

};  