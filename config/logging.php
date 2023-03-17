<?php

    use Monolog\Handler\StreamHandler;
    use Monolog\Handler\SyslogUdpHandler;

    return [

        /*
        |--------------------------------------------------------------------------
        | Default Log Channel
        |--------------------------------------------------------------------------
        |
        | This option defines the default log channel that gets used when writing
        | messages to the logs. The name specified in this option should match
        | one of the channels defined in the "channels" configuration array.
        |
        */

        'default' => env('LOG_CHANNEL', 'stack'),

        /*
        |--------------------------------------------------------------------------
        | Log Channels
        |--------------------------------------------------------------------------
        |
        | Here you may configure the log channels for your application. Out of
        | the box, Laravel uses the Monolog PHP logging library. This gives
        | you a variety of powerful log handlers / formatters to utilize.
        |
        | Available Drivers: "single", "daily", "slack", "syslog",
        |                    "errorlog", "monolog",
        |                    "custom", "stack"
        |
        */

        'channels' => [

            'docker' => [
                'driver' => 'single',
                'path'   => 'php://stdout',
                'level'  => 'debug',
            ],

            'stack'  => [
                'driver'   => 'stack',
                'channels' => ['daily'],
            ],

            'single' => [
                'driver' => 'single',
                'path'   => storage_path('logs/laravel.log'),
                'level'  => 'debug',
            ],

            'daily' => [
                'driver' => 'daily',
                'path'   => storage_path('logs/laravel.log'),
                'level'  => 'info',
                'days'   => 14,
            ],

            'slack' => [
                'driver'   => 'slack',
                'url'      => env('LOG_SLACK_WEBHOOK_URL'),
                'username' => 'Laravel Log',
                'emoji'    => ':boom:',
                'level'    => 'critical',
            ],

            'papertrail' => [
                'driver'       => 'monolog',
                'level'        => 'debug',
                'handler'      => SyslogUdpHandler::class,
                'handler_with' => [
                    'host' => env('PAPERTRAIL_URL'),
                    'port' => env('PAPERTRAIL_PORT'),
                ],
            ],

            'stderr' => [
                'driver'  => 'monolog',
                'handler' => StreamHandler::class,
                'with'    => [
                    'stream' => 'php://stderr',
                ],
            ],

            'syslog' => [
                'driver' => 'syslog',
                'level'  => 'debug',
            ],

            'errorlog' => [
                'driver' => 'errorlog',
                'level'  => 'debug',
            ],

            'liqpay' => [
                'driver' => 'single',
                'path'   => storage_path('logs/liqpay.log'),
                'level'  => 'debug',
            ],

            'paypal' => [
                'driver' => 'single',
                'path'   => storage_path('logs/paypal.log'),
                'level'  => 'debug',
            ],

            'privatPay' => [
                'driver' => 'single',
                'path'   => storage_path('logs/privatPay.log'),
                'level'  => 'debug',
            ],

            'payparts' => [
                'driver' => 'single',
                'path'   => storage_path('logs/payparts.log'),
                'level'  => 'debug',
            ],

        ],

    ];
