<?php

use Symfony\Component\HttpFoundation\Response;

return [
    'handles' => [
        ...collect(Response::$statusTexts)->keys()->filter(fn (int $status) => $status >= 400),
    ],

    'disk' => [
        'interceptors' => env('NGINX_ERROR_DISK', 'app/nginx/interceptors'),
        'errors' => env('NGINX_ERROR_PAGES', 'app/nginx/errors'),
    ],

    'interceptors' => [
        'lifetime' => env('NGINX_ERROR_INTERCEPTOR_LIFETIME', 1),
    ],

    'request' => [
        'header' => env('NGINX_ERROR_REQUEST_ID_HEADER', 'X-Request-Id'),
    ],
];
