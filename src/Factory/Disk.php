<?php

namespace Mpietrucha\Nginx\Error\Factory;

use Mpietrucha\Nginx\Error\Contracts\DiskInterface;
use Symfony\Component\Finder\SplFileInfo;
use Mpietrucha\Support\Concerns\HasFactory;
use Mpietrucha\Minify\Minify;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;

abstract class Disk implements DiskInterface
{
    use HasFactory;

    public function adapter(): FilesystemAdapter
    {
        return Storage::build([
            'driver' => 'local',
            'root' => storage_path($this->path())
        ]);
    }

    public function before(SplFileInfo $file): string
    {
        return Minify::create($file)->minify();
    }
}
