<?php
return [
    'output' => env('SWAGGER_OUTPUT', 'public'),
    'api' => [
        'title' => 'My API',
    ],
    'routes' => [
        'docs' => 'docs',
        'oauth2_callback' => 'api/oauth2-callback',
        'middleware' => [
            'docs' => [],
            'oauth2_callback' => [],
        ],
    ],
    'paths' => [
        'docs' => storage_path('api-docs'),
    ],
];
