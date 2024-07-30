<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function(){
    Route::get('/album', [AlbumController::class, 'index']);
    Route::post('/album', [AlbumController::class, 'create']);
    Route::get('/album/{id}', [AlbumController::class, 'show']);
    Route::put('/album/{id}', [AlbumController::class, 'update']);
});

