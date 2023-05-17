<?php

namespace Mpietrucha\Nginx\Error\Disk;

use Illuminate\Filesystem\FilesystemAdapter;

class Error extends Disk
{
    public function adapter(): FilesystemAdapter
    {
        return $this->buildRelativeAdapter(
            config('nginx.disk.errors')
        );
    }
}
