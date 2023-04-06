<?php

namespace Mpietrucha\Nginx\Error;

use Illuminate\Support\ServiceProvider;
use Mpietrucha\Composer\Composer;
use Illuminate\Support\Facades\Artisan;
use Mpietrucha\Nginx\Error\Console\Commands;

class NginxErrorServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/nginx.php' => config_path('nginx.php'),
        ], 'config');

        Composer::after(function () {
            Artisan::call('nginx:install');
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
