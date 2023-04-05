<?php

namespace Mpietrucha\Nginx\Error\Factory;

use Mpietrucha\Support\Condition;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mpietrucha\Support\Concerns\HasFactory;
use Mpietrucha\Support\Concerns\HasVendor;
use Illuminate\Filesystem\FilesystemAdapter;
use Mpietrucha\Nginx\Error\Contracts\AssetInterface;

abstract class Asset implements AssetInterface
{
    use HasVendor;
    use HasFactory;

    public static function publish(): array
    {
        $instance = static::create();

        return [$instance->internal() => $instance->external()];
    }

    public function internal(): string
    {
        return collect([$this->vendor()->path(), $this->from()])->toDirectory();
    }

    public function external(?string $file = null): string
    {
        return collect([base_path($this->to()), $file])->toDirectory();
    }

    public function resolve(): string
    {
        return Condition::create($external = $this->external())
            ->add($this->internal(), ! File::isDirectory($external))
            ->resolve();
    }

    public function disk(): FilesystemAdapter
    {
        return Storage::build([
            'driver' => 'local',
            'path' => $this->resolve()
        ]);
    }
}
