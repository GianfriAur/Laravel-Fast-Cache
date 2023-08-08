<?php

namespace Gianfriaur\FastCache;

use Gianfriaur\FastCache\ServiceProvider\ServicesProvider;
use Illuminate\Support\ServiceProvider;

class FastCacheServiceProvider extends ServiceProvider
{
    const CONFIG_NAMESPACE = "laravel_fast_cache";
    const CONFIG_FILE_NANE = "laravel_fast_cache.php";

    public function boot(): void
    {
        $this->bootConfig();
    }


    public function register(): void
    {
        $this->registerConfig();

        $this->app->register(ServicesProvider::class);
    }

    private function bootConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../config/' . self::CONFIG_FILE_NANE => config_path(self::CONFIG_FILE_NANE),
        ]);
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/' . self::CONFIG_FILE_NANE, self::CONFIG_NAMESPACE
        );
    }

}