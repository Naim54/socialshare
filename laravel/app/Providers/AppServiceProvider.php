<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\WelcomeController;

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
        // Use custom pagination view
        \Illuminate\Pagination\Paginator::defaultView('components.pagination');
        \Illuminate\Pagination\Paginator::defaultSimpleView('components.pagination');

        // Share distinct categories with all views
        View::composer('*', function ($view) {
            $categories = WelcomeController::getDistinctCategories();
            $view->with('categories', $categories);
        });
    }
}
