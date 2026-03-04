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
        View::composer('*', function ($view) {

            $name = 'Guest';
            $role = 'Guest';
            $logoutRoute = null;

            $guards = [
                'admin' => [
                    'role' => 'Administrator',
                    'logout' => 'admin.logout',
                ],
                'employee' => [
                    'role' => 'Employee',
                    'logout' => 'employee.logout',
                ],
                'web' => [
                    'role' => 'User',
                    'logout' => null,
                ],
            ];

            foreach ($guards as $guard => $data) {
                if (Auth::guard($guard)->check()) {
                    $user = Auth::guard($guard)->user();

                    $name = $user->name ?? 'Guest';
                    $role = $data['role'];
                    $logoutRoute = $data['logout'];
                    break;
                }
            }

            $view->with([
                'adminName' => $name,
                'userRole' => $role,
                'logoutRoute' => $logoutRoute,
            ]);
        });
    }

    // Uncomment for https forcing in production
    // public function boot(UrlGenerator $url)
    // {
    //     if (env('APP_ENV') == 'production') {
    //         $url->forceScheme('https');
    //     }
    // }
}
