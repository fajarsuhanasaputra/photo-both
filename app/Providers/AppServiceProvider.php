<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Models\SettingDefault;
use App\Models\Booth;

class AppServiceProvider extends ServiceProvider {


    public function register() {
        Blade::directive('currency', function ($expression) {
            return "IDR <?php echo number_format($expression,0,',','.'); ?>";
        });
    }

    public function boot() {
        // $prov_setting = SettingDefault::findOrFail(1);
        $prov_setting = Booth::findOrFail(1);
        View::share('prov_setting', $prov_setting);
    }

}
