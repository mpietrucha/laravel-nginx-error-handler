<?php

return [
    'directories' => [
        'views' => env('NGINX_ERROR_VIEWS_OUTPUT', 'resources/vendor/nginx/views'),

        'resources' => env('NGINX_ERROR_RESOURCES_OUTPUT', 'resources/vendor/nginx/resources'),

        'output' => env('NGINX_ERROR_RENDER_OUTPUT', 'resources/vendor/nginx/output'),
    ],

    'view' => [
        'default' => env('NGINX_ERROR_DEFAULT_FILE', 'error.html'),
        'handlers' => []
    ],

    'theme' => [
        'loading' => explode(',', env('NGINX_ERROR_LOADING_STATUSES', 502)),
        'favicon' => env('NGINX_ERROR_FAVICON'),
        'logo' => env('NGINX_ERROR_LOGO'),
    ],

    'request' => [
        'header' => env('NGINX_ERROR_REQUEST_ID_HEADER', 'X-Request-Id'),
    ]
];
