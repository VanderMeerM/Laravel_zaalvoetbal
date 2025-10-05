<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Date;
use App\Models\Matchround;
use App\Models\User;
use App\Models\Team;

use Illuminate\Http\Request;

class DateController extends Controller
{

     public function index()
    {

        $dates= Date::orderBy('date')->get();

        return view('dates.index', compact('dates'));
    }

 public function create()
    {     
    return to_route('create_date');
    }


  public function show($id)
    {

      $matchround_dates = Matchround::select()->where('date_id', '=', $id)->get();
      $num_present = $matchround_dates->where('present', '=', '1')->count();
      $num_absent = $matchround_dates->where('present', '=', '0')->count();
      $current_date = Date::find($id);
      $teams = Team::all();

       return view('show',  [
        'matchround' => $matchround_dates,
        'num_present' => $num_present,
        'num_absent' => $num_absent,
        'current_date' => $current_date,
        'teams' => $teams
       ]);

        //$player = Player::select()->where('id', '=', $id)->get();
        //$match = Matchround::where('date_id', '=', $id)->get();
       
          /*    return view('/dates.show', [
                'match' => $match,
            ]);
            */
    }

    public function update($id) 
    {
        request()->validate([
        'goals_orange' => ['required'],
        'goals_yellow' => ['required'],

        ]);
        
        $date = Date::findOrFail($id);

        $date->result_orange = request('goals_orange');
        $date->result_yellow = request('goals_yellow');
        $date->save();
     
        $matchround_yellow = Matchround::select()->where(
            'date_id','=', $date->id)->where(
            'present', '=', 1)->where(
            'team_id','=', 2)->get();

            
        $matchround_orange = Matchround::select()->where(
            'date_id','=', $date->id)->where(
            'present', '=', 1)->where(
            'team_id','=', 1)->get();


        if (request('goals_yellow') < request('goals_orange')) {
           $matchround_orange->result === 'W'; 
           $matchround_yellow->result === 'L';
        }

        else if (request('goals_yellow') > request('goals_orange')) {
           $matchround_orange->result === 'L'; 
           $matchround_yellow->result === 'W';
        
        }

        else {
            $matchround_orange->result === 'D'; 
            $matchround_yellow->result === 'D';
        }

        $matchround_yellow->save();
        $matchround_orange->save();
        

     return to_route('dates.show', ['date' => $date->id]);
    }

 public function store()
    {
         request()->validate([
        'date' => ['required'],
       
    ]);

$new_date = Date::create(   
     [
        'date' => request('date'),
        'created_at' => now()
                      
    ]);

 $users = User::all(); 

 foreach ($users as $user) {

    Matchround::create(
        [
            'date' => now(),
            'user_id' => $user->id,
            'team_id' => 1,
            'date_id' => $new_date->id, 
            'present' => 1,
            'created_at' => now()
        ]
        );
    }
    
     return to_route('dates.index');
    }

     public function destroy($id)
    {
        $date = Date::findOrFail($id);

        $matchesdate=Matchround::where('date_id', '=', $date)->get();
        $matchesdate->delete();    
        
        $date->delete();
        
          return redirect('/dates'); 
    }

};  