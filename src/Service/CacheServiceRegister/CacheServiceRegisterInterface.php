<?php

namespace Gianfriaur\FastCache\Service\CacheServiceRegister;

use Illuminate\Foundation\Application;

interface CacheServiceRegisterInterface
{
    public static function registerCacheService(Application $app, $interface, $class, $options, ?string $alias):bool;
}