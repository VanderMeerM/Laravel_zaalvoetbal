<?php

use App\Http\Controllers\MatchroundController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\SessionController;
use App\Models\User;
use App\Models\Date;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
 return redirect()->route('auth.login');
});

Route::get('/login', [SessionController::class, 'create'])->name('auth.login');
Route::post('/login', [SessionController::class, 'store'])->name('auth.login');

Route::post('/logout', [SessionController::class, 'destroy'])->name('auth.logout');


Route::get('/change_presence/{id}', action: [MatchroundController::class, 'change_presence']);
Route::get('/change_team/{id}', action: [MatchroundController::class, 'change_team']);

Route::get('/setactivity/{id}', action: [UserController::class, 'setActivity']);



Route::get('/users', function() {

    $users= User::all(); 

    return view('users.index', compact('users'));
});


Route::get('/users/create', function() {
return view('users.create');
});

Route::post('/users', [UserController::class, 'store']);

Route::post('/users/{id}', [UserController::class, 'update']);

Route::delete( '/users/{id}',  [UserController::class, 'destroy']);

Route::resource('users', UserController::class);


Route::get('/dates',  [DateController::class, 'index'])
 //   $dates= Date::orderByDesc('date')->get(); 

    
  //  return view('dates.index', compact('dates'));
->name('dates.index');


Route::get ('/dates/{date}', [DateController::class, 'show'])
->name('dates.show');

Route::post('/dates/store', [DateController::class, 'store']);

Route::patch('/dates/{date}', [DateController::class, 'update']);

Route::delete('/dates/delete/{date}', [DateController::class, 'destroy'])
->name('dates.delete');

Route::resource( '/statistics', StatisticController::class)
->only('index');

