<?php

namespace App\Providers;

use App\Observers\TaskObserver;
use App\Services\EnrollmentFormService;
use Illuminate\Support\ServiceProvider;
use App\Services\Pixabay;
use App\Task;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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

        Task::observe(TaskObserver::class);

        /**
         * Paginate a standard Laravel Collection.
         *
         * @param Carbon|string $date A Carbon object or string which will be used for the date
         * @param Carbon|string $time A Carbon object or string which will be used for the time
         * @return Carbon
         */
        Carbon::macro('createFromDateAndTime', function ($date, $time) {
            if (gettype($date) == "string") {
                return Carbon::create($date)->setTimeFrom($time);
            } else {
                return $date->setTimeFrom($time);
            }
        });

        /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
}