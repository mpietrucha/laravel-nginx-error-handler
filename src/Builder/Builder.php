<?php

namespace Mpietrucha\Nginx\Error\Builder;

use Closure;
use Mpietrucha\Nginx\Error\Contracts\BuilderInterface;

abstract class Builder implements BuilderInterface
{
    protected ?Closure $resolver = null;

    public function resolver(?Closure $resolver = null): self
    {
        $this->resolver = $resolver;

        return $this;
    }

    public function resolve(string ...$files): string
    {
        return collect($files)->map(fn (string $file) => value($this->resolver, $file))->toWords()->finish(';');
    }
}
