<?php

namespace Mpietrucha\Nginx\Error\Console\Commands;

use Illuminate\Console\Command;
use Mpietrucha\Nginx\Error\Disk\Nginx;
use Mpietrucha\Nginx\Error\Builder\Nginx as Builder;

class InstallCommand extends Command
{
    protected $signature = 'nginx:install';

    protected $description = 'Build nginx errors service.';

    public function handle(): void
    {
        $this->components->task('Building nginx configuration.', function () {
            Nginx::build(new Builder);

            return true;
        });
    }
}
