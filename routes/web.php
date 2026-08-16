<?php

use App\Http\Controllers\MatchroundController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileImgController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\SessionController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
 return redirect()->route('auth.login');
});

Route::get('/login', [SessionController::class, 'create'])->name('auth.login');
Route::post('/login', [SessionController::class, 'store'])->name('auth.login');
Route::post('/logout', [SessionController::class, 'destroy'])->name('auth.logout');


Route::get('/change_presence/{id}', action: [MatchroundController::class, 'change_presence']);
Route::get('/change_team/{id}', action: [MatchroundController::class, 'change_team']);


Route::get('/users', function() {

    $users= User::all(); 

    return view('users.index', compact('users'));
});


Route::get('/users/create', function() {
return view('users.create');
});

Route::post('/users', [UserController::class, 'store']);
Route::post('/users/{id}', [UserController::class, 'update']);
Route::get('/setactivity/{id}', [UserController::class, 'setActivity']);
Route::post('/hasball/{id}', [UserController::class, 'hasball']) -> name('user.hasball');

Route::post('/upload_profile_img', [UserController::class, 'upload_profile_img'])-> name('upload.uploadprofileimg');

Route::resource('users', UserController::class)->except('destroy');

Route::get('/dates',  [DateController::class, 'index']) -> name('dates.index');

Route::post('/dates', [DateController::class, 'change_season']) -> name('dates.change_season');

Route::get ('/dates/{date}', [DateController::class, 'show'])-> name('dates.show');

Route::post('/dates/store', [DateController::class, 'store']);

Route::post('/dates/copy/{id}', [DateController::class, 'copy'])-> name('dates.copy');


Route::patch('/dates/{date}', [DateController::class, 'update']);

Route::delete('/dates/delete/{date}', [DateController::class, 'destroy'])
->name('dates.delete');

Route::get('/statistics', [StatisticController::class, 'index']);
Route::post('/statistics', [StatisticController::class, 'change_season'])->name('statistics.change_season'); 
