<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dashboard $dashboard)
    {
        $dashboard->registerResource("scripts", "https://cdn.tiny.cloud/1/bftapw7mas3kz8jsnmb1wb2b4viqri1klxcqyp7utbfx3miv/tinymce/6/tinymce.min.js");
        $dashboard->registerResource("scripts", "/dashboard/js/dashboard.js");
    }
}
