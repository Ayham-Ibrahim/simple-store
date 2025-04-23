<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('partials.header', function ($view) {
            $categoriesLimit = 3;

            $allNavCategories = Category::select(['id', 'name'])
                ->get();

            $view->with('allNavCategories', $allNavCategories)
                ->with('navCategoryLimit', $categoriesLimit);
        });
    }
}
