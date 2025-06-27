<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Storage;

class DailyBackup extends Command
{
    protected $signature = 'backup:daily';
    protected $description = 'Generate a daily backup of database tables as a PDF';

    public function handle()
    {
        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
        $data = [];

        foreach ($tables as $table) {
            $tableName = array_values((array)$table)[0];
            $records = DB::table($tableName)->get();
            $data[$tableName] = $records;
        }

        $pdf = PDF::loadView('backup.backuppdf', ['data' => $data]);
        $filename = 'backup_' . now()->format('Y_m_d_His') . '.pdf';

        Storage::put("backups/$filename", $pdf->output());

        $this->info("Backup saved as backups/$filename");
    }
}

