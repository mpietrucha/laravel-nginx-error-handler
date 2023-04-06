<?php

namespace Mpietrucha\Nginx\Error\Disk;

use Mpietrucha\Nginx\Error\Factory\Disk;
use Illuminate\Filesystem\FilesystemAdapter;

class Interceptor extends Disk
{
    public function adapter(): FilesystemAdapter
    {
        return $this->buildRelativeAdapter(
            config('nginx.disk.interceptors')
        );
    }
}
