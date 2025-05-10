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
    $response = Http::post('https://api.openai.com/v1/chat/completions',
    [
        "model" => "gpt-4.1",
        "messages" => [
            [
                "role" => "system",
                "content" => "You are a helpful assistant."
            ],
            [
                "role" => "user",
                "content" => "Write a one-sentence bedtime story about a unicorn."
            ]
        ]
    ])->json();

    dd($response);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
