<?php

namespace Gianfriaur\FastCache\Service\CacheService;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class DefaultCacheService implements CacheServiceInterface
{
    public function __construct(protected Application $app, protected array $options)
    {
    }

    public function getCacheFilePath(): string
    {
        $options = $this->options;

        /* bypass private protection
         * ref https://stackoverflow.com/questions/70004276/php-closure-security-problem-can-modify-private-property-outside-of-class-is
         */

        /** @noinspection PhpUnnecessaryLocalVariableInspection */
        $absolute_path_cache_file = (function () use ($options) {
            /** @var Application $this */
            return $this->normalizeCachePath($options['file_env_override'], $options['cache_file']);
        })->call($this->app);

        return $absolute_path_cache_file;
    }

    public function registerCacheStore()
    {
        $selfServiceProvider = $this;
        $options = $this->options;

        Config::set('cache.stores.'.$options['driver_name'], ['driver' =>$options['driver_name']]);

        Cache::extend($options['driver_name'], function (Application $app) use ($selfServiceProvider,$options) {
            return Cache::repository(new $options['store'](new Filesystem(), $selfServiceProvider->getCacheFilePath(), false));
        });

    }
}