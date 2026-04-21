<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return redirect()->route('login'); });
Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/registro', function () { return view('register'); })->name('register');
Route::get('/recuperar', function () { return view('recuperar'); })->name('recuperar');
Route::get('/home', function () { return view('home'); })->name('home');