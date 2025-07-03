<?php

use App\Http\Controllers\MatchroundController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});


Route::get('/voetballers',  function() {
    return view('index');
});

*/
  
Route::get('/voetballers', action: [MatchroundController::class, 'index'])-> name('index');
