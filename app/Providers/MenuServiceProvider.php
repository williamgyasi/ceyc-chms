<?php

namespace App\Providers;

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
        // get all data from menu.json file
        $menuJson = file_get_contents(base_path('resources/json/menu.json'));
        $menuData = json_decode($menuJson);

        // Share all menuData to all the views
        \View::share('menuData', $menuData);
    }
}
