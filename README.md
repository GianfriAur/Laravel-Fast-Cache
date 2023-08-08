
<h1 align="center">Laravel Fast Cache</h1>



## ⚽️ Goal

this library allows you to quickly create new driver caches for your packages with just a few lines of configuration

----
## ✨ Features


* driver self-registration service
* New cache store FileArrayStore

----
## 🤙🏼 Quickstart



#### 1) Install The package
> composer require gianfriaur/laravel-fast-cache


currently the library does not include additional configurations


## How to use

#### 1) Create your service driver interface

```PHP
use Gianfriaur\FastCache\Service\CacheService\CacheServiceInterface;

interface MyLibraryCacheServiceInterface extends CacheServiceInterface {}
```

#### 2) register your driver

```PHP
use Gianfriaur\FastCache\Service\CacheServiceRegister\DefaultCacheServiceRegister;
use Gianfriaur\FastCache\Service\CacheService\DefaultCacheService;
use Gianfriaur\FastCache\Cache\Stores\FileArrayStore;

class ServicesProvider extends ServiceProvider
{
    public function register(): void
    {
        DefaultCacheServiceRegister::registerCacheService(
            $this->app,
            MyLibraryCacheServiceInterface::class,
            DefaultCacheService::class
            [
                'cache_file' => 'cache/my_library_cache.php',
                'file_env_override' => 'MY_LIBRARY_CACHE_FILE',
                'store' => FileArrayStore::class,
                'driver_name' => 'my-library-cache'
            ],
            'my_library.cache_service',
        );
    }
}
```

#### 3) use your cache

The cache interfaces like any laravel cache, [read the official laravel guide](https://laravel.com/docs/10.x/cache)


```PHP
// if true remember only for debug else remember forever
$is_volatile_memory = (app()->hasDebugModeEnabled() || !App::isProduction()) === true;

$my_data = $is_volatile_memory
    ? Cache::store('my-library-cache')->remember('key_name', 1,fn() => 'key_value')
    : Cache::store('my-library-cache')->rememberForever( 'key_name', fn() => 'key_value')
```
#### 4) see your cache
> a new file was added '**bootstrap/cache/my_library_cache.php**'

----
## 📝 Next releases

- Add the ability to dynamically configure services


---- 
## 🎉 License

The Laravel Hyper Controller package is licensed under the terms of the MIT license and is available for free.
