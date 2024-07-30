<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('v1')->group(function(){
    Route::get('/album/search', [AlbumController::class, 'search']);
    Route::get('/album', [AlbumController::class, 'index']);
    Route::post('/album', [AlbumController::class, 'create']);
    Route::get('/album/{id}', [AlbumController::class, 'show']);
    Route::put('/album/{id}', [AlbumController::class, 'update']);
    Route::delete('/album/{id}', [AlbumController::class, 'destroy']);

});

