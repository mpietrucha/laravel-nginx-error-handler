<?php

namespace Mpietrucha\Nginx\Error\Assets;

use Mpietrucha\Nginx\Error\Factory\Asset;

class View extends Asset
{
    public function to(): string
    {
        return config('nginx.views');
    }

    public function from(): string
    {
        return 'views';
    }
}
