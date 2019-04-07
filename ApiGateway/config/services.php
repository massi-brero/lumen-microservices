<?php

return [
    'authors' => [
        'base_uri' => env('AUTHORS_SERVICE_BASE_URI'),
        'prefix' => env('AUTHORS_MICROSERVICE_URI_PREFIX')
    ],
    'books' => [
        'base_uri' => env('BOOKS_SERVICE_BASE_URI'),
        'prefix' => env('BOOKS_MICROSERVICE_URI_PREFIX')
    ]
];