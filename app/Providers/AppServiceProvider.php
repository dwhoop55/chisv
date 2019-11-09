<?php

namespace App\Providers;

use App\Job;
use App\Services\EnrollmentFormService;
use Illuminate\Support\ServiceProvider;
use App\Services\Pixabay;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("App\Services\PixabayService", function () {
            return new Pixabay(env('PIXABAY_KEY', ""));
        });

        $this->app->singleton("App\Services\EnrollmentFormService", function () {
            return new EnrollmentFormService();
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