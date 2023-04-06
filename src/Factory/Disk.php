<?php

namespace Mpietrucha\Nginx\Error\Factory;

use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;
use Mpietrucha\Nginx\Error\Contracts\BuilderInterface;
use Mpietrucha\Nginx\Error\Contracts\DiskInterface;
use Mpietrucha\Support\Condition;

abstract class Disk implements DiskInterface
{
    public function put(string $name, string $contents): void
    {
        $this->adapter()->put($name, $contents);
    }

    public function build(BuilderInterface $builder): void
    {
        $builder->resolver(fn (string $file) => $this->adapter()->path($file))
            ->collection()
            ->each(fn (string $contents, string $name) => $this->put($name, $contents));
    }

    protected function buildAdapter(string $root, bool $absolute = false): FilesystemAdapter
    {
        return Storage::build([
            'driver' => 'local',
            'root' => Condition::create($root)->add(fn () => base_path($root), ! $absolute)->resolve()
        ]);
    }

    protected function buildAbsoluteAdapter(string $root): FilesystemAdapter
    {
        return $this->buildAdapter($root, true);
    }
}
