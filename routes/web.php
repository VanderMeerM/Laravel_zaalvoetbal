<?php

use App\Http\Controllers\MatchroundController;
use App\Http\Controllers\PlayerController;
use App\Models\Player;
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


Route::post('/players', function() {
  Player::create([
        'name' => request('name'),
        'email' => request('email'),
        'password' => Hash::make(request('password'))
    ]);

 $players = Player::all();

    return view('players.index', compact('players'));
});
  
Route::resource('/players', PlayerController::class);

Route::resource('/voetballers', MatchroundController::class)
->only(['index', 'show', 'edit']);
