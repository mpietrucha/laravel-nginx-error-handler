<?php

namespace Mpietrucha\Nginx\Error\Contracts;

interface AssetInterface
{
    public function from(): string;

    public function to(): string;
}
