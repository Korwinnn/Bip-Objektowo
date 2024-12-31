<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('*', function ($view) {
            $categories = cache()->remember('categories', 3600, function () {
                return Category::with('children')
                    ->whereNull('parent_id')
                    ->get();
            });
            $view->with('categories', $categories);
        });
    }
}