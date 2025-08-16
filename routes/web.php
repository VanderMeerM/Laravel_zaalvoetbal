<?php

use App\Http\Controllers\MatchroundController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Date;
use App\Models\Matchround;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});

*/
  
Route::get('/voetballers', action: [MatchroundController::class, 'index'])->name('index');
Route::get('/voetballers', action: [MatchroundController::class, 'show'])->name(name: 'show');

Route::patch('/voetballers/{$id}/edit', action: [MatchroundController::class, 'edit'])->name(name: 'edit');

Route::patch('/voetballers/change_team/{$id}', action: [MatchroundController::class, 'change_team'])->name(name: 'change_team');


/*
Route::resource( '/dates', DateController::class); 

Route::post('/dates/create', function() {

 $new_date = Date::create([
        'date' => '2025-10-16' , // request('date'),
    ]);

   $users = User::all(); 

    foreach($users as $user) 

        Matchround::create([
            'user_id' => $user->id,
            'present' => 1,
            'team_id' => 1,
            'date_id' => $new_date->id
            
        ]);
        
})->name('create_date');
*/


Route::get('/users', function() {
    $users= User::all(); 

    return view('users.index', compact('users'));
});


Route::get('/users/create', function() {
return view('users.create');
});


Route::post( '/users', [UserController::class, 'store']);

Route::delete( '/users/delete', action: [UserController::class, 'destroy'])->name('delete_user');

Route::resource( 'users', UserController::class);

//Route::resource('/teams', TeamController::class);

//Route::resource('/voetballers', MatchroundController::class) ->only(['index', 'show', 'edit', 'change_team']);
