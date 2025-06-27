<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DailyBackup extends Command
{
    protected $signature = 'backup:daily';
    protected $description = 'Generate a daily backup of database tables as CSV files';

    public function handle()
    {
        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
        $timestamp = now()->format('Y_m_d_His');

        foreach ($tables as $table) {
            $tableName = array_values((array)$table)[0];
            $records = DB::table($tableName)->get();

            // Skip empty tables
            if ($records->isEmpty()) continue;

            // Convert to CSV
            $csvData = '';
            $headers = array_keys((array)$records->first());
            $csvData .= implode(',', $headers) . "\n";

            foreach ($records as $record) {
                $row = array_map(function ($field) {
                    // Escape quotes
                    return '"' . str_replace('"', '""', $field) . '"';
                }, (array)$record);

                $csvData .= implode(',', $row) . "\n";
            }

            $filename = "backups/{$tableName}_{$timestamp}.csv";
            Storage::put($filename, $csvData);
            $this->info("Saved CSV: $filename");
        }

        $this->info("Daily backup completed successfully.");
    }
}

