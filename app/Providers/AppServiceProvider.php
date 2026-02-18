<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Category;

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
        // 1. Use Bootstrap 5 for pagination styles
        Paginator::useBootstrapFive();

        // 2. Share categories with ALL views for the Navbar
        // We use 'navCategories' to avoid conflict with admin pages
        try {
            View::composer('*', function ($view) {
                $view->with('navCategories', Category::all());
            });
        } catch (\Exception $e) {
            // Ignored to prevent crashes during migration
        }
    }
}