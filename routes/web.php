<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class,'authenticate']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('submit.registrasi');