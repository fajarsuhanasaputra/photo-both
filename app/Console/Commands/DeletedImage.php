<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;

class DeletedImage extends Command {

    protected $signature = 'posts:delete-photo';
    protected $description = 'Menghapus photo yang sudah lebih dari 2 bulan';

//    public function __construct() {
//        parent::__construct();
//    }

    public function handle() {
//        return Command::SUCCESS;
        Post::whereDate('deleted_at', '>=', Carbon::now())->each(function ($item) {
            $item->delete();
        });
        $this->info('Data Terhapuskan');
    }

}
