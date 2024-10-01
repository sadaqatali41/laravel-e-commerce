<?php

namespace App\Providers;

use App\Models\Admin\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
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
        $seconds = Config::get('constants.CACHE_EXP');
        
        View::composer('includes.menu', function ($view) use ($seconds) {
            $categories = Cache::remember('categories_menu', $seconds, function () {
                return Category::with('subcategories')
                                ->where('status', 'A')
                                ->get();
            });            
            $view->with('categories', $categories);
        });
    }
}
