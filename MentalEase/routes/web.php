<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/chat', function () {
    $helpresponse = Http::withToken(config('services.openai.secret'))->post('https://api.openai.com/v1/chat/completions',
    [
        "model" => "gpt-4.1-mini",
        "messages" => [
            [
                "role" => "system",
                "content" => "You are a helpful emotional mental health assistant."
            ],
            [
                "role" => "user",
                "content" => "Write about making someone feel better mentally."
            ]
        ]
    ])->json('choices.0.message.content');

    return view('chat',['helpresponse' => $helpresponse]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
