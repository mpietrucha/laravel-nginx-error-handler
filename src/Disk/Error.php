<?php

namespace Mpietrucha\Nginx\Error\Disk;

use Mpietrucha\Nginx\Error\Factory\Disk;
use Illuminate\Filesystem\FilesystemAdapter;

class Error extends Disk
{
    public function adapter(): FilesystemAdapter
    {
        return $this->buildAdapter(
            config('nginx.disk.errors')
        );
    }
}
