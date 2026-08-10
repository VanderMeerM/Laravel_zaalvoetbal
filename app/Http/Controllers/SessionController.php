<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Date;

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

         $upcoming_date = Date::where('date', '>=', date('Y-m-d H:i:s'))->orderby('date', 'asc')->first();

         if (is_null($upcoming_date)) {

          return to_route('dates.index');

         } else {
                   
          return to_route('dates.show', ['date' => $upcoming_date->id]);
         }
         
       }

  public function destroy() {

    Auth::logout();

    return redirect('/login'); // back();
 }
}
