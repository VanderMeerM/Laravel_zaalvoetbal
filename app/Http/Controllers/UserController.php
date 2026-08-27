<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Date;
use App\Models\Matchround;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;


use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
   public function index()
    {

    if (Auth::guest()) {
        return redirect('./login');
    }

       $users = User::orderBy('firstname')->get();

      $players_with_ball = User::where('hasball', '=', 'on')->count();

        return view('users.index', [
            'users' => $users, 
            'players_with_ball' => $players_with_ball
            ]);
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
        'password' => ['required', Password::min(6)->letters()->numbers()]
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

     public function upload_profile_img(Request $request): RedirectResponse
    {
         $request->validate([
            'file' => 'required|mimes:jpg,JPG,png,PNG|max:2048',
        ]);
        
       $old_img_profile = User::find($request->input('user_id'))->image; 

       if ( $old_img_profile != '' ) {
            File::delete(public_path('spelers/'.$old_img_profile));
       }

       $profile_img_user = User::find($request->input('user_id'))->id . '_' . User::find($request->input('user_id'))->firstname. '_' . strtotime(now()) . '.' .$request->file->extension();
         
       $request->file->move(public_path('spelers'), $profile_img_user);
          
       User::where('id', '=',$request->input('user_id'))->update(['image' => $profile_img_user]);
    
       return back();
      
    }
    
     public function hasball($id)
    {

     $user = User::findOrFail($id);
 
      $user_hasball = $user->hasBall;

      if ($user_hasball === 'on') {

     $user->update([ 
      'hasBall' => null
      ]);
     } else {
        $user->update([
            'hasBall'=>'on'
        ]);

    }
        return redirect()->route('users.index', [
            'users' => User::orderBy('firstname')->get(),
            ]);
        
    }

       public function setActivity($id)
    {

      $user = User::findOrFail($id); 

      $user_activity = $user->isActive;

      if ($user_activity === 'Y') {

     $user->update([
        'isActive' => 'N',
         'isAdmin' => null, 
         'hasBall' => null
      ]);
     } else {
        $user->update([
            'isActive'=>'Y'
        ]);
    }
       return redirect()->route('users.index', ['users' => User::orderBy('firstname')->get()]);

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

       request()->validate([
        'firstname' => ['filled'],
        'lastname' => ['filled'],
        'email' => ['filled', 'email','max:254'],
       
      ]);

      if ($request->password != '') {

        request()->validate([
         'password' => ['required', Password::min(6)->letters()->numbers(), 'confirmed']
        ]);
      }
      
    
      $new_firstname = $request->firstname;
      $logged_in_user = Auth::user()->id;
      $new_birthdate = $request->birthdate;

      $user['birthdate'] = $new_birthdate;
        
           $user->fill(
            ['firstname' => $new_firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'isAdmin' => $request->isAdmin,
             'birthdate' => $new_birthdate
             ]) ->save(); // Hash::make('12345')])->save()

             if ($request->password != '') {
                $user->fill(
                    ['password' => $request->password]
                )->save();
             }

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
/*
    <form id="delete_user" method="post" action='/users/{{ $user->id }}' class="hidden">
@csrf
@method('DELETE')

</form>
*/
}
