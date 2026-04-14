<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/registro', [AuthController::class, 'registro']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/olvidarContrasena', [AuthController::class, 'olvidarContrasena']);
Route::post('/actualizarContrasena', [AuthController::class, 'actualizarContrasena']);
