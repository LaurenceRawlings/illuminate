<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\GlobalSettings;
use App\Services\NewsRepository;
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
        $this->app->singleton(NewsRepository::class, function ($app) {
            return new NewsRepository(config('api.newsApiKey'));
        });

        $this->app->singleton(GlobalSettings::class, function ($app) {
            return new GlobalSettings(Setting::all());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
