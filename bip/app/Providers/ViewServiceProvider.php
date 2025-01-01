<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('partials.sidebar', function ($view) {
            $categories = Category::with('children')
                ->whereNull('parent_id')
                ->get();
            $view->with('categories', $categories);
        });
    }
}