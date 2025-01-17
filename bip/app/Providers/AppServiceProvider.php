<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Announcement;

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
    public function boot()
    {
        view()->composer('layouts.app', function($view) {
            $announcements = Announcement::query()
                ->active()
                ->latest()
                ->take(5)
                ->get();
            
            $view->with('announcements', $announcements);
        });
    }
}
