<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Date;
use App\Models\Matchround;
use App\Models\User;

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

        //$player = Player::select()->where('id', '=', $id)->get();
        $match = Matchround::where('date_id', '=', $id)->get();
       
              return view('/dates.show', [
                'match' => $match,
            ]);
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

        $matchesdate=Matchround::where('date_id', '=', $date->id);
        $matchesdate->delete();    
        
        $date->delete();
        
          return redirect('/dates'); 
    }

};  