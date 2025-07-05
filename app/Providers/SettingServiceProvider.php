<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Modules\Setting\App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingServiceProvider extends ServiceProvider
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
        if (!App::runningInConsole() && Schema::hasTable('settings')) {
            $settings = Cache::remember('app_settings', 3600, function () {
                return Setting::all()->pluck('option_value', 'option_key')->toArray();
            });

            $this->app->instance('settings', $settings);

            foreach ($settings as $key => $value) {
                Config::set('settings.' . $key, $value);
            }
        }
    }
}
