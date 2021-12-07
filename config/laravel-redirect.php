<?php

return [
    'web_middleware' => env('WEB_MIDDLEWARE', 'web'),
    'parameter'      => [
        'enabled'       => true,
        'name'          => env('REDIRECT_PARAMETER', 'redirect'),
        'regex'         => env('REDIRECT_REGEX'),
    ],
    'routes'         => [
        'login'   => env('LOGIN_ROUTE_NAME', 'login'),
        'logout'  => env('LOGOUT_ROUTE_NAME', 'logout'),
        'default' => env('DEFAULT_ROUTE_NAME', 'home'),
    ],
];
