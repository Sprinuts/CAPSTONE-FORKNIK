<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use File;

class BackupController extends Controller
{
    public function viewbackups()
    {
        $backupDir = storage_path('app/backups');
    
    // Get all .zip files in the backup directory
    $files = File::files($backupDir);

    // Filter and map to just the filename
    $zipFiles = collect($files)
        ->filter(fn($file) => $file->getExtension() === 'zip')
        ->map(fn($file) => $file->getFilename());

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('backup/viewbackups', ['files' => $zipFiles]);
    }

    public function download($filename)
    {
        $path = storage_path("app/backups/{$filename}");

        if (!file_exists($path)) {
            abort(404, 'Backup not found.');
        }

        return response()->download($path);
    }
}
