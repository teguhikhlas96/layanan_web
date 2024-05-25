<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::resource('barangs', BarangController::class)->middleware(['auth']);

Route::get('/home', function () {
    return view('home');
})->name('home');


