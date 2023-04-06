<?php

namespace Mpietrucha\Nginx\Error\Factory;

use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;
use Mpietrucha\Nginx\Error\Contracts\BuilderInterface;
use Mpietrucha\Nginx\Error\Contracts\DiskInterface;
use Mpietrucha\Support\Concerns\HasFactory;

abstract class Disk implements DiskInterface
{
    use HasFactory;

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

    protected function buildAbsoluteAdapter(string $root): FilesystemAdapter
    {
        return Storage::build([
            'driver' => 'local',
            'root' => $root
        ]);
    }

    protected function buildRelativeAdapter(string $root): FilesystemAdapter
    {
        return $this->buildAbsoluteAdapter(
            base_path($root)
        );
    }
}
