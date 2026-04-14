<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::post('/registro', [AuthController::class, 'registro'])->name('registro.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/olvidarContrasena', [AuthController::class, 'olvidarContrasena'])->name('olvidar.post');
Route::post('/actualizarContrasena', [AuthController::class, 'actualizarContrasena'])->name('actualizar.post');