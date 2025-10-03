<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        Paginator::useBootstrap();

        // Start check Locale language
        $locale = config('locales.fallback_locale');
        App::setLocale($locale);
        Lang::setLocale($locale);
        Session::put('locale', $locale);
        Carbon::setLocale($locale);
        // End check locale language

         // Check if the 'site_settings' table exists
        if (Schema::hasTable('site_settings')) {
            // Site setting calling to cache in 5 hours refresh
            $siteSettings = Cache()->remember(
                'siteSettings',
                3600,
                fn() => SiteSetting::all()->keyBy('key')
            );
            View::share('siteSettings', $siteSettings);
        }

    }
}
