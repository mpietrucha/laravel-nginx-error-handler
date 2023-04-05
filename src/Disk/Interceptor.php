<?php

namespace Mpietrucha\Nginx\Error\Disk;

use Mpietrucha\Nginx\Error\Factory\Disk;

class Interceptor extends Disk
{
    public function path(): string
    {
        return config('nginx.disk.interceptors');
    }
}
