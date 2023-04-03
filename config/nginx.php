<?php

return [
    'views' => env('NGINX_VIEWS_OUTPUT', 'resources/vendor/nginx/views'),

    'resources' => env('NGINX_RESOURCES_OUTPUT', 'resources/vendor/nginx/resources'),

    'default' => env('NGINX_DEFAULT_FILE', 'error.html'),

    'loading' => explode(',', env('NGINX_LOADING_STATUSES', 502)),

    'theme' => [
        'favicon' => env('NGINX_ERROR_FAVICON'),
        'logo' => env('NGINX_ERROR_LOGO'),
    ],

    'handlers' => []
];
