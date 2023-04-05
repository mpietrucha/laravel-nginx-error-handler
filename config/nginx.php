<?php

return [
    'disk' => [
        'interceptors' => env('NGINX_ERROR_DISK', 'app/nginx/interceptors'),
        'errors' => env('NGINX_ERROR_PAGES', 'app/nginx/errors')
    ],

    'interceptors' => [
        'lifetime' => env('NGINX_ERROR_INTERCEPTOR_LIFETIME', 10)
    ],

    'request' => [
        'header' => env('NGINX_ERROR_REQUEST_ID_HEADER', 'X-Request-Id')
    ]
];
