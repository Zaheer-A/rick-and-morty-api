<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RickAndMortyService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RickAndMortyService::class, function ($app) {
            return new RickAndMortyService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
