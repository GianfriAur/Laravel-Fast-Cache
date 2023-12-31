<?php

namespace Gianfriaur\FastCache\Service\CacheService;

use Illuminate\Foundation\Application;

interface CacheServiceInterface
{
    public function __construct(Application $app, array $options);

    public function registerCacheStore();
}