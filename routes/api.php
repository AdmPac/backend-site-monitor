<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sites', [SiteController::class, 'create']);
    Route::get('/sites', [SiteController::class, 'all']);
    Route::get('/sites/{site}/get', [SiteController::class, 'get']);
    Route::get('/sites/{site}/info', [SiteController::class, 'info']);
});