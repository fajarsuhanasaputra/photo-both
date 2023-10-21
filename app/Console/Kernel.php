<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    protected function schedule(Schedule $schedule) {
// $schedule->command('inspire')->hourly();

        $schedule->command('posts:delete-photo')->everyMinute();
        $schedule->command('backup:database')->everyMinute();

//                $schedule->call(function () {
//            DB::posts('created_at', '>', Carbon::now())->delete();
//        })->daily();
//        $schedule->call(function () {
//            DB::post('created_at', '>', Carbon::now())->delete();
//        })->daily();
//        $schedule->command('posts:delete-photo')
//                ->everyMinute()
//                ->runInBackground();
    }

    protected function commands() {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }

}
