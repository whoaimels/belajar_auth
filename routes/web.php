<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class,'authenticate']);

Route::get('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('submit.registrasi');

Route::get('/admin/index', [ArticleController::class, 'index'])->middleware('auth')->name('admin.dashboard');
Route::get('/create', [ArticleController::class, 'create'])->middleware('auth')->name('create');
Route::post('/store', [ArticleController::class, 'store'])->middleware('auth')->name('store');
Route::delete('/destroy/{id}', [ArticleController::class, 'destroy'])->middleware('auth')->name('destroy');
Route::get('/edit/{id}', [ArticleController::class, 'edit'])->middleware('auth')->name('edit');
Route::put('/update/{id}', [ArticleController::class, 'update'])->middleware('auth')->name('update');
Route::get('/read/{id}', [ArticleController::class, 'read'])->name('read');



