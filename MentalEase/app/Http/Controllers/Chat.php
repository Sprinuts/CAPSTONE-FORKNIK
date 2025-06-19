<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;
class Chat extends Controller
{

    /**
     * @param Request $request
     * @return string
     */
    public function __invoke(Request $request): string
{
    try {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . env('OPENAI_API_KEY')
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => $request->post('model', 'gpt-3.5-turbo'), // default fallback
            "messages" => [
                [
                    "role" => "system",
                    "content" => "You are an emotional support chatbot. You are here to help the user with their mental health issues. You are not a psychologist, but you can provide emotional support and guidance. You can also suggest resources for further help. You also can understand filipino language, but if the user talks in english respond in english also. And answer only in a paragraph form. Also if the user asks for information about the chatbot, respond with 'I am an emotional support chatbot designed to assist with mental health issues. I can provide guidance and resources, but I am not a licensed psychologist.'. And if the user asks outside the scope of being a emotional support chatbot, politely inform them that you can only assist with mental health-related queries. And when the user chat intensity is high, please respond with introducting the clinic named 'Sanda Diagnostic Center', which you can refer to for further assistance. You can also suggest that the user visit the clinic for more personalized help.",
                ],
                [
                    "role" => "user",
                    "content" => $request->post('content')
                ]
            ],
            "temperature" => 0.7,
            "max_tokens" => 2048
        ]);

        $data = $response->json(); // Properly decode response to array

        return $data['choices'][0]['message']['content'] ?? 'No response generated.';
    } catch (Throwable $e) {
        // Optional: log the error for debugging
        \Log::error('OpenAI error: ' . $e->getMessage());

        return "ChatGPT error: " . $e->getMessage(); // Better feedback for now
    }
}

    public function chatbot()
    {
        return view('include/header')
            .view('include/navbar')
            .view('chatbot')
            .view('include/footer');
    }
}
