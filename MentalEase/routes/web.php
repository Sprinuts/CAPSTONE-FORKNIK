<?php

use App\Http\Controllers\Index;
use App\Http\Controllers\Chat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// login route
Route::get('/login', [Index::class, 'login'])->name('login');
Route::post('/login', [Index::class, 'login'])->name('login');

// register route
Route::post('/register', [Index::class, 'register'])->name('register');

// welcome route for patient
route::get('/welcomepatient', [Index::class, 'welcomepatient'])->name('welcomepatient');

// logout
Route::get('/logout', [Index::class, 'logout'])->name('logout');

// chatbot
Route::get('/chatbot', [Chat::class, 'chatbot'])->name('chatbot');
Route::post('/chatbot', 'App\Http\Controllers\Chat');

// about
Route::get('/about', [Index::class, 'about'])->name('about');

// appointment
Route::get('/appointment', [Index::class, 'appointment'])->name('appointment');