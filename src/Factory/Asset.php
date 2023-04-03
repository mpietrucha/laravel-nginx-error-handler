<?php

namespace Mpietrucha\Nginx\Error\Factory;

use Mpietrucha\Support\Condition;
use Illuminate\Support\Facades\File;
use Mpietrucha\Support\Concerns\HasFactory;
use Mpietrucha\Support\Concerns\HasVendor;
use Mpietrucha\Nginx\Error\Contracts\AssetInterface;

abstract class Asset implements AssetInterface
{
    use HasVendor;
    use HasFactory;

    public function default(): string
    {
        return $this->vendor()->path() . DIRECTORY_SEPARATOR . $this->from();
    }

    public function path(?string $file = null): string
    {
        $path = Condition::create($source = base_path($this->to()))
            ->add($this->default(), ! File::isDirectory($source))
            ->resolve();

        return rtrim($path . DIRECTORY_SEPARATOR . $file, DIRECTORY_SEPARATOR);
    }
}
