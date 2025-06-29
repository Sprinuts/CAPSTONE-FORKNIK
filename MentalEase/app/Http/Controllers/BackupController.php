<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use File;
use ZipArchive;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    public function viewbackups()
    {
        // $backupDir = storage_path('app/backups');

        // // Ensure the backup directory exists
        // if (!File::exists($backupDir)) {
        //     File::makeDirectory($backupDir, 0755, true);
        // }

        // Get all .zip files in the backup directory
        $files = Storage::files('backups');

        $backups = collect($files)->filter(function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) === 'zip';
        })->map(function ($file) {
            return [
                'name' => basename($file),
                'size' => Storage::size($file),
                'last_modified' => Storage::lastModified($file),
            ];
        });
        // Filter and map to just the filename
        // $zipFiles = collect($files)
        //     ->filter(fn($file) => $file->getExtension() === 'zip')
        //     ->map(fn($file) => $file->getFilename());

        return view('include/headeradmin')
            .view('include/navbaradmin')
            .view('backup/viewbackups', compact('backups'));
    }

    public function download($filename)
    {
        $path = Storage::path("backups/{$filename}");

        if (!file_exists($path)) {
            abort(404, 'Backup not found.');
        }

        return response()->download($path);
    }

    public function createbackup()
    {

        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
        $timestamp = now()->format('Y_m_d_His');
        $backupDir = Storage::path("backups/temp_$timestamp");

        // Create temporary folder
        if (!file_exists($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        // Generate CSVs
        foreach ($tables as $table) {
            $tableName = array_values((array)$table)[0];
            $records = DB::table($tableName)->get();

            if ($records->isEmpty()) continue;

            $csvData = '';
            $headers = array_keys((array)$records->first());
            $csvData .= implode(',', $headers) . "\n";

            foreach ($records as $record) {
                $row = array_map(function ($field) {
                    return '"' . str_replace('"', '""', $field) . '"';
                }, (array)$record);
                $csvData .= implode(',', $row) . "\n";
            }

            file_put_contents("$backupDir/{$tableName}.csv", $csvData);
        }

        // Create ZIP file
        $zipPath = Storage::path("backups/backup_$timestamp.zip");
        $zip = new ZipArchive;

        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            $files = scandir($backupDir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $zip->addFile("$backupDir/$file", $file);
                }
            }
            $zip->close();
        } else {
            return back()->with('error', 'Failed to create ZIP file.');
        }

        // Clean up temp files
        array_map('unlink', glob("$backupDir/*.csv"));
        rmdir($backupDir);

        return back()->with('success', "Backup saved as backup_$timestamp.zip");
    }
}
