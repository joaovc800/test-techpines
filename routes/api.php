<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('v1')->group(function(){
    Route::get('/album/search', [AlbumController::class, 'search']);

    Route::get('/track/search', [TrackController::class, 'search']);

    //Route::middleware('auth:sanctum')->group(function(){

        Route::resource('/album', AlbumController::class);

        Route::resource('/track', TrackController::class);

    //});

});

