<?php

use App\Http\Controllers\MatchroundController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\DateController;
use App\Models\Player;
use App\Models\Date;
use App\Models\Matchround;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});


Route::get('/voetballers',  function() {
    return view('index');
});


Route::get('/voetballers', action: [MatchroundController::class, 'index'])-> name('index');

Route::get('/voetballers', action: [MatchroundController::class, 'show']) -> name('show');
*/
  
Route::get('/voetballers', action: [MatchroundController::class, 'index'])->name('index');
Route::get('/voetballers', action: [MatchroundController::class, 'show'])->name(name: 'show');

Route::patch('/voetballers/{$id}/edit', action: [MatchroundController::class, 'edit'])->name(name: 'edit');

Route::resource( '/dates', DateController::class); 

Route::post('/dates/create', function() {

 $new_date = Date::create([
        'date' => '2025-10-09',  // request('date'),
    ]);

   $players = Player::all(); 

    foreach($players as $player) 

        Matchround::create([
            'player_id' => $player->id,
            'present' => 1,
            'team_id' => 1,
            'date_id' => $new_date->id
            
        ]);
        
})->name('create_date');

Route::resource( '/players', PlayerController::class);

Route::post('/players', function() {

 Player::create([
        'firstname' => request('firstname'),
        'lastname' => request('lastname'),
        'email' => request('email'),
        'password' => Hash::make(request('password'))
       
    ]);
    
    $players= Player::orderBy('firstname')->get();

    return view('players.index', compact('players'));
    
});
  

Route::resource('/teams', TeamController::class);

Route::resource('/voetballers', MatchroundController::class)
->only(['index', 'show', 'edit']);
