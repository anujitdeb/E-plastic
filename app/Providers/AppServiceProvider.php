<?php

namespace App\Providers;

use App\Models\GlobalSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('*', function ($view) {
//            $setting = GlobalSetting::first();
//            $view->with('setting', $setting);

            //cache the setting

            $setting = cache()->remember('setting', 60 * 60 * 24, function () {
                return GlobalSetting::first();
            });
            $view->with('setting', $setting);
        });
    }
}
