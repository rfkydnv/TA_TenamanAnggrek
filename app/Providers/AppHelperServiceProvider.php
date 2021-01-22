<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $helpers = glob(__DIR__.'/../Helpers/*.php', GLOB_BRACE);
        foreach($helpers as $helper) {
            require_once($helper);
        }
//        require_once app_path() . '/Helpers/AppHelper.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
