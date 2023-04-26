<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ClubController;
use App\Http\Controllers\API\PlayerController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register')->name('register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('current-user', 'currentUser');

});



Route::controller(PlayerController::class)->group(function () {
    Route::get('players', 'index');
    Route::post('player', 'store')->middleware('auth:api');
    Route::get('player/{player}', 'show');
    Route::post('player/{player}', 'update');
    Route::delete('player/{player}', 'destroy')->middleware('auth:api');
}); 

Route::controller(ClubController::class)->group(function () {
    Route::get('clubs', 'index');
    Route::post('club', 'store');//->middleware('auth:api');
    Route::get('club/{club}', 'show');
    Route::post('club/{club}', 'update');
    Route::delete('club/{club}', 'destroy');
}); 

// Route::apiResource("players", PlayerController::class);

// Route::apiResource("clubs", ClubController::class);
