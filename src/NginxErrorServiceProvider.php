<?php

namespace Mpietrucha\Nginx\Error;

use Mpietrucha\Macros\Bootstrapper;
use Illuminate\Support\ServiceProvider;

class NginxErrorServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Bootstrapper::handle();

        $this->publishes([
            __DIR__.'/../config/nginx.php' => config_path('nginx.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'./../config/nginx.php', 'nginx');
    }
}
