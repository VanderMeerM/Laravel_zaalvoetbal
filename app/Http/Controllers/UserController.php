<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Date;
use App\Models\Matchround;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
   public function index()
    {

       $users = User::orderBy('firstname')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {     
    return view('users.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
         request()->validate([
        'firstname' => ['required'],
        'lastname' => ['required'],

    ]);

$new_user = User::create(   
     [
        'firstname' => request('firstname'),
        'lastname' => request('lastname'),
        'email' => request('email'),
        'password' => Hash::make(request('password')),
        'isAdmin' => request('isAdmin'),
        'hasBall' => false
               
    ]);

 $dates = Date::all(); 

 foreach ($dates as $date) {

    Matchround::create(
        [
            'date' => now(),
            'user_id' => $new_user->id,
            'team_id' => 1,
            'date_id' => $date->id, 
            'present' => 1,
            'created_at' => now()
        ]
        );
    }
    
     return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        //$player = Player::select()->where('id', '=', $id)->get();
        $user = User::findOrFail($id);
       
              return view('/users.show', ['user' => $user]);
    }
       

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       //  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
      $user = User::find($id); 
         
        $user->fill(
              ['password' => Hash::make(request('password'))])->save();

                 return view('/users.show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $matchesuser=Matchround::where('user_id', '=', $user->id);
        $matchesuser->delete();    
        
        $user->delete();
        
          return redirect('/users'); 
    }
}
