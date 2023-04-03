<?php

namespace Mpietrucha\Nginx\Error;

use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\Response;

class Interceptor
{
    protected bool $canProcessDisable = false;

    public static function enable(Response $response): void
    {
        if (! $requestId = $response->headers->get('X-Request-Id')) {
            return;
        }

        Output::create($requestId, $response->getContent());

        self::$canProcessDisable = true;
    }

    public static function disable(): void
    {
        if (! self::$canProcessDisable) {
            return;
        }

        self::$canProcessDisable = false;
    }
}
