<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VideoSDKController extends Controller
{
    public function createmeeting(Request $request)
    {
        $apiKey = env('VIDEOSDK_API_KEY');
        $secret = env('VIDEOSDK_SECRET');

        $token = base64_encode(hash_hmac('sha256', $apiKey, $secret, true));

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.videosdk.live/v2/rooms');

        return response()->json([
            'apiKey' => $apiKey,
            'data' => $response->json(),
        ]);
    }
}
