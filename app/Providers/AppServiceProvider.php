<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }

    // Uncomment for https forcing in production
    // public function boot(UrlGenerator $url)
    // {
    //     if (env('APP_ENV') == 'production') {
    //         $url->forceScheme('https');
    //     }
    // }
}
