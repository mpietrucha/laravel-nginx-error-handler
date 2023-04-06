<?php

namespace Mpietrucha\Nginx\Error\Contracts;

use Illuminate\Filesystem\FilesystemAdapter;

interface DiskInterface
{
    public function adapter(): FilesystemAdapter;

    public function put(string $name, string $contents): void;

    public function build(BuilderInterface $builder): void;
}
