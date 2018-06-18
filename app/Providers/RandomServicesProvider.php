<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\Example\Random;

class RandomServiceProvider extends ServiceProvider
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
        ## 還有instance、bind
        $this->app->singleton('Random', function () {
            return new Random();
        });
    }
}
