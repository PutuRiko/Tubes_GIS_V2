<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetRuasJalanController;


Route::get('/', function () {
    return view('index');
});

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/layout', [UserController::class, 'showLayout'])->name('layout');

Route::get('/api/ruasjalan', [GetRuasJalanController::class, 'getRuasJalan'])->name('ruasjalan.get');
