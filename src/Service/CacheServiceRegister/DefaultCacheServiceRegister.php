<?php

namespace Gianfriaur\FastCache\Service\CacheServiceRegister;

use Gianfriaur\FastCache\Service\CacheService\CacheServiceInterface;
use Gianfriaur\HyperController\Exception\BadServiceInterfaceException;
use Illuminate\Foundation\Application;

class DefaultCacheServiceRegister implements CacheServiceRegisterInterface
{

    public static function registerCacheService(Application $app,$interface, $class, $options, ?string $alias):bool{
        if ($class !== null) {
            if (!is_subclass_of($class, CacheServiceInterface::class)) {
                throw new \Exception($class." not implement ".CacheServiceInterface::class );
            }
            // register singleton
            $app->singleton($interface, function ($app) use ($class, $options) {
                return new $class($app, $options);
            });
            if ($alias){
                $app->alias($interface, $alias);
            }
            return true;
        }
        return false;
    }
}