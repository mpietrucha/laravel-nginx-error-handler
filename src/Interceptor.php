<?php

namespace Mpietrucha\Nginx\Error;

use Mpietrucha\Nginx\Error\Factory\Output;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\Response;

class Interceptor
{
    protected bool $canProcessDisable = false;

    public static function enable(Response $response): void
    {
        if (! $requestId = $response->headers->get(config('nginx.header'))) {
            return;
        }

        if (! $response = $response->getContent()) {
            return;
        }

        Output::create($requestId, $response)->enshure();

        self::$canProcessDisable = true;
    }

    public static function disable(): void
    {
        if (! self::$canProcessDisable) {
            return;
        }

        self::$canProcessDisable = false;

        Output::create()->clear();
    }
}
