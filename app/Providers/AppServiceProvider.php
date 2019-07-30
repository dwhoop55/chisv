<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Pixabay;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("App\Services\Pixabay", function () {
            return new Pixabay(env('PIXABAY_KEY', ""));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['request']->server->set('HTTPS', $this->app->environment() != 'local');
    }
}