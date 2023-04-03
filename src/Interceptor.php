<?php

namespace Mpietrucha\Nginx\Error;

use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\Response;

class Interceptor
{
    public static function enable(Response $response): void
    {
        if (! $requestId = $response->headers->get('X-Request-Id')) {
            return;
        }

        Output::create($requestId, $response->getContent());
    }

    public static function disable(): void
    {

    }
}
