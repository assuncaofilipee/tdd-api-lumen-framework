<?php

return [
    'debug'             => env('APP_DEBUG', false),
    'app_id'            => env('APP_ID', 0),
    'app_lang'          => env('APP_LANG', 'pt_BR'),
    'ms' => [
        'auth'          => [
            'uri'       => env('MS_AUTH_URL', ''),
            'headers'   => [
                'FC-Version' => env('MS_AUTH_VERSION','1.0')
            ]
        ],
        'client'        => [
            'uri'       => env('MS_CLIENT_URL', ''),
            'headers'   => [
                'FC-Version' => env('MS_CLIENT_VERSION','1.0')
            ]
        ],
        'sale'          => [
            'uri'       => env('MS_SALE_URL', ''),
            'headers'   => [
                'FC-Version' => env('MS_SALE_VERSION','1.0')
            ]
        ],
        'nfe'           => [
            'uri'       => env('MS_NFE_URL', ''),
            'headers'   => [
                'FC-Version' => env('MS_NFE_VERSION','1.0')
            ]
        ],
        'notification'  => [
            'uri'       => env('MS_NOTIFICATION_URL', ''),
            'headers'   => [
                'FC-Version' => env('MS_NOTIFICATION_VERSION','1.0')
            ]
        ],
        'log'           => [
            'uri'       => env('MS_LOG_URL', ''),
            'headers'   => [
                'FC-Version' => env('MS_LOG_VERSION','1.0')
            ]
        ],
        'integracao'           => [
            'uri'       => env('MS_INTEGRACAO_URL', ''),
            'headers'   => [
                'FC-Version' => env('MS_INTEGRACAO_VERSION','1.0')
            ]
        ],
        'api'           => [
            'uri'       => env('MS_API_URL', ''),
            'headers'   => [
                'FC-Version' => env('MS_API_VERSION','1.0')
            ]
        ],
        'distributor'           => [
            'uri'       => env('MS_DISTRIBUTOR_URL', ''),
            'headers'   => [
                'FC-Version' => env('MS_DISTRIBUTOR_VERSION','1.0')
            ]
        ],
        'ec'           => [
            'uri'       => env('MS_EC_URL', ''),
            'headers'   => [
                'FC-Version' => env('MS_EC_VERSION','1.0')
            ]
        ],
        'report'           => [
            'uri'       => env('MS_REPORT_URL', ''),
            'headers'   => [
                'FC-Version' => env('MS_REPORT_VERSION','1.0')
            ]
        ],
        'filter'           => [
            'uri'       => env('MS_FILTER_URL', ''),
            'headers'   => [
                'FC-Version' => env('MS_FILTER_VERSION','1.0')
            ]
        ]
    ],
    'stage'             => [
        'debug'         => env('STAGE_DEBUG', true),
    ],
    'middleware'        => [
        'versions'      => [
            'version'   => env('APP_VERSION', '1.0'),
            'name'      => env('APP_NAME', 'web'),
        ],
        'db'            => [
            'database'  => env('DB_DATABASE'),
            'host'      => env('DB_HOST'),
            'port'      => env('DB_PORT'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD'),
            'charset'   => env('DB_CHARSET'),
            'prefix'    => env('DB_PREFIX'),
            'schema'    => env('DB_SCHEMA'),
            'sslmode'   => env('DB_SSL_MODE'),
            'domain'    => env('NM_DOMAIN', 'fpay.me'),
        ]
    ]
];
