<?php

return [

    'slug' => 'testings',

    'websockets-preset' => [

        'model' => \App\Models\User::class,

        'model_title_attribute' => 'name',

    ],

    'env-preset' => [

        'keys' => [

            'APP_NAME' => env('APP_NAME'),
            'APP_ENV' => env('APP_ENV'),
            'APP_DEBUG' => env('APP_DEBUG'),
            'APP_TIMEZONE' => env('APP_TIMEZONE'),
            'APP_CURRENCY' => env('APP_CURRENCY'),
            'APP_URL' => env('APP_URL'),
            'APP_LOCALE' => env('APP_LOCALE'),

            'APP_MAINTENANCE_DRIVER' => env('APP_MAINTENANCE_DRIVER'),
            'APP_MAINTENANCE_STORE' => env('APP_MAINTENANCE_STORE'),

            'SESSION_DRIVER' => env('SESSION_DRIVER'),
            'BROADCAST_CONNECTION' => env('BROADCAST_CONNECTION'),
            'QUEUE_CONNECTION' => env('QUEUE_CONNECTION'),

            'MAIL_MAILER' => env('MAIL_MAILER'),
            'MAIL_HOST' => env('MAIL_HOST'),
            'MAIL_PORT' => env('MAIL_PORT'),
            'MAIL_USERNAME' => env('MAIL_USERNAME'),
            'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
            'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
            'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),

        ],

    ],

];
