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
//Route::get('/voetballers', action: [MatchroundController::class, 'index'])->name('index');
//Route::get('/voetballers', action: [MatchroundController::class, 'show'])->name(name: 'show');

Route::get('/change_presence/{id}', action: [MatchroundController::class, 'change_presence']);
Route::get('/change_team/{id}', action: [MatchroundController::class, 'change_team']);


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

Route::post('/users', [UserController::class, 'store']);

Route::delete( '/users/{id}',  [UserController::class, 'destroy']);

Route::resource( 'users', UserController::class);


Route::get('/dates', function() {
    $dates= Date::all(); 

    return view('dates.index', compact('dates'));
})->name('dates.index');

/*
Route::get('/dates/create', function() {
return view('dates.create');
});
*/

Route::get ('/dates/{date}', [DateController::class, 'show'])
->name('dates.show');

Route::post('/dates/store', [DateController::class, 'store']);

Route::patch('/dates/{date}', [DateController::class, 'update']);

Route::delete('/dates/delete/{date}', [DateController::class, 'destroy']);


//Route::resource( 'dates', DateController::class);


//Route::resource('/teams', TeamController::class);

//Route::resource('/voetballers', MatchroundController::class) ->only(['index', 'show', 'edit', 'change_team']);
