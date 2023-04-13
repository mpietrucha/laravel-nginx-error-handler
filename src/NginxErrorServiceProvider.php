<?php

namespace Mpietrucha\Nginx\Error;

use Illuminate\Support\ServiceProvider;
use Mpietrucha\Events\Component\Event;
use Illuminate\Support\Facades\Artisan;
use Mpietrucha\Nginx\Error\Console\Commands;

class NginxErrorServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/nginx.php' => config_path('nginx.php'),
        ], 'config');

        Event::composer()->packageContext()->call(function () {
            Artisan::call('cdn:clear');
            Artisan::call('cdn:install');
        });

        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Commands\InstallCommand::class,
        ]);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'./../config/nginx.php', 'nginx');
    }
}
