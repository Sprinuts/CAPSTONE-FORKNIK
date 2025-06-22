<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function getToken(Request $request)
    {

        return response()->json([
        'TOKEN' => env('VIDEOSDK_TOKEN')
        ]);
    }
}
