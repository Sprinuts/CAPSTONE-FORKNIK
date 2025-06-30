<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apklocation;

class ContentController extends Controller
{
    public function contentmanagement()
    {

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('content/contentmanagement');
    }


    public function contentwelcomeapk()
    {
        $latestApk = Apklocation::orderBy('created_at', 'desc')->first();
        $apkPath = $latestApk ? $latestApk->apk_path : null;

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('content/contentwelcomeapk', ['apkPath' => $apkPath]);
    }

    public function updateapk()
    {
        // Ensure PHP upload limits are sufficient for large files
        ini_set('upload_max_filesize', '100M');
        ini_set('post_max_size', '100M');
        ini_set('max_execution_time', '300');
        ini_set('max_input_time', '300');

        $request = request();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $supabaseUrl = env('SUPABASE_URL');
            $supabaseKey = env('SUPABASE_SERVICE_KEY');
            $bucket = 'apk';

            // Get all files matching the pattern mentalease-v* from Supabase
            $client = new \GuzzleHttp\Client([
                'base_uri' => "{$supabaseUrl}/storage/v1/",
                'headers' => [
                    'Authorization' => "Bearer {$supabaseKey}",
                    'apikey' => $supabaseKey,
                ]
            ]);

            $response = $client->get("object/list/{$bucket}?prefix=");
            $files = json_decode($response->getBody(), true);

            $latestVersion = 0;
            foreach ($files as $existingFile) {
                if (isset($existingFile['name']) && preg_match('/mentalease-v(\d+)/', $existingFile['name'], $matches)) {
                    $version = intval($matches[1]);
                    if ($version > $latestVersion) {
                        $latestVersion = $version;
                    }
                }
            }

            // Increment version
            $newVersion = $latestVersion + 1;
            $filename = "mentalease-v{$newVersion}";

            // Upload to Supabase bucket
            $uploadResponse = $client->post("object/{$bucket}/{$filename}", [
                'headers' => [
                    'Content-Type' => $file->getMimeType(),
                    'Authorization' => "Bearer {$supabaseKey}",
                    'apikey' => $supabaseKey,
                ],
                'body' => fopen($file->getRealPath(), 'r'),
            ]);

            if ($uploadResponse->getStatusCode() === 200) {
                // Save path in Apklocation model
                Apklocation::create([
                    'apk_path' => "{$bucket}/{$filename}",
                ]);
                return back()->with('success', "APK uploaded successfully as {$filename}");
            } else {
                return back()->with('error', 'Failed to upload to Supabase.');
            }
        }

        return back()->with('error', 'No file selected.');
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


