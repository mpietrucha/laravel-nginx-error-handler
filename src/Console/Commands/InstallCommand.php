<?php

namespace Mpietrucha\Nginx\Error\Console\Commands;

use Illuminate\Console\Command;
use Mpietrucha\Nginx\Error\Disk\Nginx;
use Mpietrucha\Nginx\Error\Disk\Error;
use Mpietrucha\Nginx\Error\Builder\Nginx as NginxBuilder;
use Mpietrucha\Nginx\Error\Builder\Error as ErrorBuilder;

class InstallCommand extends Command
{
    protected $signature = 'nginx:install';

    protected $description = 'Build nginx errors service.';

    public function handle(): void
    {
        $this->components->task('Building nginx configuration.', function () {
            Nginx::create()->build(new NginxBuilder);

            return true;
        });

        $this->components->task('Generating default errors files.', function () {
            Error::create()->build(new ErrorBuilder);

            return true;
        });
    }
}
