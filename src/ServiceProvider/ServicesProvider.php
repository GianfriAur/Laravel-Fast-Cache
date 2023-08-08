<?php

namespace Gianfriaur\FastCache\ServiceProvider;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ServicesProvider  extends ServiceProvider implements DeferrableProvider
{

    const CONFIG_NAMESPACE = "laravel_fast_cache";
    const CONFIG_FILE_NANE = "laravel_fast_cache.php";

}