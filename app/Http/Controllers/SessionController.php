<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create() {
        return view('auth.login');
}

  public function store(Request $request) {

            $credentials = $request->validate([
            'email' => ['required', 'email'], 
            'password' => ['required']
        ]);

       //$pass_id = $request->input('pass_id');

        
        if (!Auth::attempt($credentials, true)) {

            throw ValidationException::withMessages([
                'error' => 'Onjuiste gegevens'
            ]);

        }

         $request->session()->regenerate();
                   
         return to_route('dates.index',
         //['all'=> $pass_id]
         );

       }

  public function destroy() {

    Auth::logout();

    return back();
 }
}
