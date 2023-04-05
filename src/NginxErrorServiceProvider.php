<?php

namespace Mpietrucha\Nginx\Error;

use Mpietrucha\Nginx\Error\Assets;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class NginxErrorServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes(Assets\View::publish(), 'views');

        $this->publishes(Assets\Resource::publish(), 'resources');

        $this->publishes(Assets\Output::publish(), 'output');

        $this->publishes([
            __DIR__.'/../config/nginx.php' => config_path('nginx.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'./../config/nginx.php', 'nginx');
    }
}
