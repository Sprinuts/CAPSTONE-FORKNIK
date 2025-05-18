<?php

use App\Http\Controllers\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [Index::class, 'login'])->name('login');
Route::post('/login', [Index::class, 'login'])->name('login');

Route::post('/register', [Index::class, 'register'])->name('register');