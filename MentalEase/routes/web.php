<?php

use App\Http\Controllers\Index;
use App\Http\Controllers\Chat;
use App\Http\Controllers\Assessment;
use App\Http\Controllers\Users;
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

Route::get('/activate', [Users::class, 'activate'])->name('activate');
Route::post('/activate', [Users::class, 'activate'])->name('activate');

Route::get('/email/activationcode', [Users::class, 'email/activationcode'])->name('email.activationcode');

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

// assessments
Route::get('/assessment/stress', [Assessment::class, 'stress'])->name('assessment.stress');
Route::get('/assessment/stress/takeassessment', [Assessment::class, 'stressassessment'])->name('assessment.stress.take');

Route::get('/assessment/emotional', [Assessment::class, 'emotional'])->name('assessment.emotional');
Route::get('/assessment/emotional/takeassessment', [Assessment::class, 'emotionalassessment'])->name('assessment.emotional.take');
