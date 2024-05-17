<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LocationController;

Route::view('/map', "map")->name('map');
Route::view('/', "login")->name('login');
Route::view('/login', "login")->name('login');
Route::view('/registro', "register")->name('registro');
Route::view('/index', "index")->middleware('auth')->name('index');
Route::view('/update', "update")->middleware('auth')->name('update');

Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/index', [LoginController::class, 'index'])->name('index');
Route::post('/update', [LoginController::class, 'update'])->name('update');
