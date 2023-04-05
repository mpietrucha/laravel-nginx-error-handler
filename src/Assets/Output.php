<?php

namespace Mpietrucha\Nginx\Error\Assets;

use Mpietrucha\Nginx\Error\Factory\Asset;

class Output extends Asset
{
    public function to(): string
    {
        return config('nginx.directories.output');
    }

    public function from(): string
    {
        return 'output';
    }
}
