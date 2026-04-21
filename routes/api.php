<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/registro', [AuthController::class, 'registrar']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/olvidar-password', [AuthController::class, 'olvidarPassword']);
Route::post('/actualizar-password', [AuthController::class, 'actualizarPassword']);

Route::get('/auth/google', [AuthController::class, 'redireccionarGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'callbackGoogle']);