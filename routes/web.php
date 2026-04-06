<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\Dashboard_pasienController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index']);
Route::get('/dashboard_pasien', [Dashboard_pasienController::class, 'index']);
Route::get('/pasien', [PasienController::class, 'index']);
Route::view('/home', 'Homepage');
Route::view('/register', 'Registrasi');