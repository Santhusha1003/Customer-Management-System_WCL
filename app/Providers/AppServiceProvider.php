<?php

namespace App\Providers;

use App\Support\SampleNotifications;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $notifications = SampleNotifications::all();

            $view->with([
                'recentNotifications' => $notifications,
                'unreadNotificationsCount' => SampleNotifications::unreadCount(),
            ]);
        });
    }
}
