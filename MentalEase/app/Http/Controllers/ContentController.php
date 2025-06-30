<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function contentmanagement()
    {

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('content/contentmanagement');
    }


    public function apkupdate()
    {

    }
    public function download($filename)
    {
        $path = public_path("apk/{$filename}");

        if (!file_exists($path)) {
            abort(404, 'APK file not found.');
        }

        return response()->download($path);
    }

    public function  contentwelcome()
    {
        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('content/contentwelcome');
    }
}


