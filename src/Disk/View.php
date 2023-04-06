<?php

namespace Mpietrucha\Nginx\Error\Disk;

use Illuminate\Support\Facades\File;
use Mpietrucha\Nginx\Error\Factory\Disk;
use Illuminate\Filesystem\FilesystemAdapter;

class View extends Disk
{
    protected DIRECTORY = 'views/errors';

    public function adapter(): FilesystemAdapter
    {
        return $this->build(
            resource_path(self::DIRECTORY), true
        );
    }
}
