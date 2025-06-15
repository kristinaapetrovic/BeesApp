<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AktivnostController;
use App\Http\Controllers\DrustvoController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\KosnicaController;
use App\Http\Controllers\NotifikacijaController;
use App\Http\Controllers\PcelinjakController;
use App\Http\Controllers\SugestijaController;
use App\Http\Controllers\UserController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('aktivnosti', AktivnostController::class);
    Route::apiResource('drustva', DrustvoController::class);
    Route::apiResource('komentari', KomentarController::class);
    Route::apiResource('kosnice', KosnicaController::class);
    Route::apiResource('pcelinjaci', PcelinjakController::class);
    Route::apiResource('sugestije', SugestijaController::class);
    Route::apiResource('user', UserController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/notifikacije/{id}', [NotifikacijaController::class, 'read']);
    Route::get('/notifikacije', [NotifikacijaController::class, 'showAll']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
