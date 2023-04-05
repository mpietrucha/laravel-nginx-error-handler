<?php

namespace Mpietrucha\Nginx\Error\Contracts;

use Illuminate\Filesystem\FilesystemAdapter;
use Symfony\Component\Finder\SplFileInfo;

interface DiskInterface
{
    public function path(): string;

    public function before(SplFileInfo $file): string;
}
