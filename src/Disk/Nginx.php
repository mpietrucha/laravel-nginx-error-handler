<?php

namespace Mpietrucha\Nginx\Error\Disk;

use Illuminate\Support\Facades\File;
use Mpietrucha\Nginx\Error\Factory\Disk;
use Illuminate\Filesystem\FilesystemAdapter;
use Mpietrucha\Support\Concerns\HasVendor;

class Nginx extends Disk
{
    use HasVendor;

    protected const DIRECTORY = 'nginx';

    public function adapter(): FilesystemAdapter
    {
        return $this->buildAbsoluteAdapter(
            collect([$this->vendor()->path(), self::DIRECTORY])->toDirectory()
        );
    }
}
