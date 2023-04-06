<?php

namespace Mpietrucha\Nginx\Error\Factory;

use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;
use Mpietrucha\Nginx\Error\Contracts\BuilderInterface;
use Mpietrucha\Support\Condition;

abstract class Disk implements DiskInterface
{
    protected function build(string $root, bool $absolute = false): FilesystemAdapter
    {
        return Storage::build([
            'driver' => 'local',
            'root' => Condition::create($root)->add(fn () => base_path($root), ! $absolute)->resolve()
        ]);
    }

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
}
