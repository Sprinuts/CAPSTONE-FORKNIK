<?php

use App\AI\Chat;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
});


// AI CHAT
Route::get('/chat', function () {

    $chat = new Chat();

    $helpresponse = $chat->systemMessage('You are a helpful emotional mental health assistant.')
        ->send("Write about making someone feel better mentally.");

    $helpresponse2 = $chat->reply("Make it in paragraph.");

    return view('chat',['helpresponse' => $helpresponse2]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
