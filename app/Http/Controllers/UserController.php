<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Date;
use App\Models\Matchround;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
   public function index()
    {

    if (Auth::guest()) {
        return redirect('./login');
    }

       $users = User::orderBy('firstname')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
            
    if (Auth::guest()) {
        return redirect('./login');
    }

    return view('users.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {

    
    if (Auth::guest()) {
        return redirect('./login');
    }
         request()->validate([
        'firstname' => ['required'],
        'lastname' => ['required'],

    ]);

$new_user = User::create(   
     [
        'firstname' => request('firstname'),
        'lastname' => request('lastname'),
        'email' => request('email'),
        'password' => request('password'), //Hash::make(request('password')),
        'birthdate' => request('birthdate'),
        'isAdmin' => request('isAdmin'),
        'hasBall' => false
               
    ]);

 $dates = Date::select()->where('season', '==', request('current_season'))->get(); 

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

    
    if (Auth::guest()) {
        return redirect('./login');
    }
        //$player = Player::select()->where('id', '=', $id)->get();
        $user = User::findOrFail($id);
        $logged_in_user = Auth::user()->id;

              return view('/users.show', ['user' => $user, 'logged_in_user' => $logged_in_user]);
    }
       

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       //  
    }

     public function setActivity($id)
    {

      $user = User::findOrFail($id); 

      $user_activity = $user->isActive;

      if ($user_activity === 'Y') {

     $user->update([ 
      'isActive' => 'N'
      ]);
     } else {
        $user->update([
            'isActive'=>'Y'
        ]);
    }
       return view('users.index', ['users' => User::orderBy('firstname')->get()]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {

        if (Auth::guest()) {
        return redirect('./login');
    }

      $user = User::findOrFail($id);    

    /*  request()->validate([
        'password' => ['required', Password::min(6), 'confirmed']
      ]);
    */

      $new_firstname = $request->firstname;
      $logged_in_user = Auth::user()->id;
      $new_birthdate = $request->birthdate;

      $user['birthdate'] = $new_birthdate;
        
           $user->fill(
            ['firstname' => $new_firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'isAdmin' => $request->isAdmin

            //'password' => Hash::make($request->password), 
            // 'birthdate' => $new_birthdate
             ]) ->save(); // Hash::make('12345')])->save()

              return view('/users.show', ['user' => $user, 'logged_in_user' => $logged_in_user ]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    
    if (Auth::guest()) {
        return redirect('./login');
    }

        $user = User::findOrFail($id);

        $matchesuser=Matchround::where('user_id', '=', $user->id);
        $matchesuser->delete();    
        
        $user->delete();
        
          return redirect('/users'); 
    }
}
