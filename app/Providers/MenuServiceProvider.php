<?php

namespace App\Providers;

use App\Models\Admin\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('includes.menu', function ($view) {
            $categories = Cache::remember('categories_menu', 60 * 60, function () {
                return Category::with('subcategories')
                                ->where('status', 'A')
                                ->get();
            });
            $view->with('menus', $categories);
        });
    }
}
