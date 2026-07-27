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

               
        if (!Auth::attempt($credentials, false)) {

           throw ValidationException::withMessages([
                'error' => 'Onjuiste gegevens'
            ]);

        }

         $request->session()->regenerate();
                   
         return to_route('dates.index');

         
       }

  public function destroy() {

    Auth::logout();

    return redirect('/login'); // back();
 }
}
