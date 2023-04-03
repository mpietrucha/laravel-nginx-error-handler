<?php

namespace Mpietrucha\Nginx\Error;

use Mpietrucha\Nginx\Error\Assets;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class NginxErrorServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../views' => Assets\View::create()->default()
        ], 'views');

        $this->publishes([
            __DIR__.'/../resources' => Assets\Resource::create()->default()
        ], 'resources');

        $this->publishes([
            __DIR__.'/../config/nginx.php' => config_path('nginx.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'./../config/nginx.php', 'nginx');

        $this->app->before(fn () => Interceptor::disable());
    }
}
