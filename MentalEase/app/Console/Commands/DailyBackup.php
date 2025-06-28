<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DailyBackup extends Command
{
    protected $signature = 'backup:daily';
    protected $description = 'Generate a daily backup of database tables as CSV files inside a ZIP archive';

    public function handle()
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
            $this->error("Failed to create ZIP file.");
            return 1;
        }

        // Clean up temp files
        array_map('unlink', glob("$backupDir/*.csv"));
        rmdir($backupDir);

        $this->info("Backup saved as backups/backup_$timestamp.zip");
    }
}
