<?php

return [
    'views' => env('NGINX_VIEWS_OUTPUT', 'resources/vendor/nginx/views'),

    'resources' => env('NGINX_RESOURCES_OUTPUT', 'resources/vendor/nginx/resources'),

    'output' => env('NGINX_RENDER_OUTPUT', 'resources/vendor/nginx/output'),

    'default' => env('NGINX_DEFAULT_FILE', 'error.html'),

    'loading' => explode(',', env('NGINX_LOADING_STATUSES', 502)),

    'theme' => [
        'favicon' => env('NGINX_ERROR_FAVICON'),
        'logo' => env('NGINX_ERROR_LOGO'),
    ],

    'header' => env('NGINX_ERROR_REQUEST_ID_HEADER', 'X-Request-Id'),

    'handlers' => []
];
