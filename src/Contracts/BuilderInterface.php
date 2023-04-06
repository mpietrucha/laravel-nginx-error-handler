<?php

namespace Mpietrucha\Nginx\Error\Contracts;

use Closure;
use Illuminate\Support\Collection;

interface BuilderInterface
{
    public function resolver(?Closure $resolver = null): self;

    public function collection(): Collection;
}
