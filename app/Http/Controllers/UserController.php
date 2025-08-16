<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
   public function index()
    {

       $users = User::get();

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

User::create(   
     [
        'firstname' => request('firstname'),
        'lastname' => request('lastname'),
        'email' => request('email'),
        'password' => Hash::make(request('password')),
        'isAdmin' => request('isAdmin'),
               
    ]);
    
     return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        //$player = Player::select()->where('id', '=', $id)->get();
        $user = User::find($id);
       
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        User::destroy($user);
        
          return view('users.index'); 
    }
}
