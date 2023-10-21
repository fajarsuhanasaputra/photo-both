<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class BackupDBCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Melakukan Backup Database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
//        return Command::SUCCESS;
        $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".zip";
        $command = "mysqldump --user=" . env('DB_USERNAME', 'root') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE', 'larashop') . "  | gzip > " . storage_path() . "/app/backup/" . $filename;
        $return = NULL;
        $output = NULL;
        exec($command, $output, $return);
    }

}
