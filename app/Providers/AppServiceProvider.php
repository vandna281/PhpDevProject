<?php

namespace App\Providers;

use App\Service\DBService;
use App\Service\ExportService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Service\ExportService', function ($app) {
          return new ExportService();
        });
        $this->app->bind('App\Service\DBService', function ($app) {
          return new DBService();
        });
    }
}
