<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::post('/registro', [AuthController::class, 'registrar']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/olvide-password', [AuthController::class, 'olvidePassword']);
    Route::post('/actualizar-password', [AuthController::class, 'actualizarPassword']);

    Route::get('/auth/google', [AuthController::class, 'redireccionarGoogle']);
    Route::get('/auth/google/callback', [AuthController::class, 'callbackGoogle']);
});

