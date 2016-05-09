<?php

return [
    'app' => [
        'url' => 'http://localhost:8000/',
        'hash' => [
            'algo' => PASSWORD_BCRYPT,
            'cost' => 10
        ],
    ],

    'db' => [
        'driver' => 'mysql',
        'host'   => 'localhost',
        'database' => 'tuchao',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
    ],

    'auth' => [
        'session' => 'user_id',
        'remember' => 'user_r'
    ],

    'csrf' => [
        'key' => 'csrf_token'
    ]
];
