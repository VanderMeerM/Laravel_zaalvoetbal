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

        $dates= Date::all();

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
      $current_date_id = Date::findOrFail($id);
      $date_create = date_create($current_date_id->date);
      $teams = Team::all();
      $users_with_ball = User::select('id')->where('hasBall', '=', 'on')->get();

       return view('show',  [
        'matchround' => $matchround_dates,
        'num_present' => $num_present,
        'num_absent' => $num_absent,
        'current_date_id' => $current_date_id,
        'date_create' => $date_create,
        'teams' => $teams,
        'users_with_ball' => $users_with_ball
       ]);
      
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
     
        $matchround_yellow = Matchround::where(
            'date_id','=', $date->id)->where(
            'present', '=', 1)->where(
            'team_id','=', 0)->get();

            
        $matchround_orange = Matchround::where(
            'date_id','=', $date->id)->where(
            'present', '=', 1)->where(
            'team_id','=', 1)->get();


        if ($date->result_yellow < $date->result_orange) {
//dd($matchround_yellow);
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

       // $matchround_yellow->save();
       // $matchround_orange->save();


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
        
        $matchesdate = Matchround::select()->where('date_id', '=', $date->id)->get();
        
       foreach ($matchesdate as $md) {
       $md->delete();    
        }
        
        $date->delete();
        
          return redirect('/dates'); 
    }

};  