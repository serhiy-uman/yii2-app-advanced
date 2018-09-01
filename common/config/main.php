<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    'log' => [
        'targets' => [
            'file' => [
                'class' => 'yii\log\FileTarget',
                'categories' => ['yii\web\HttpException:404'],
                'levels' => ['error', 'warning'],
                'logFile' => '@runtime/logs/404.log',
//                'exportInterval' => 1,
            ],
//            'email' => [
//                'class' => 'yii\log\EmailTarget',
//                'except' => ['yii\web\HttpException:404'],
//                'levels' => ['error', 'warning'],
//                'message' => ['from' => 'robot@example.com', 'to' => 'admin@example.com'],
//            ],
        ],
    ],
    ],
];



